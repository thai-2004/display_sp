<?php
header('Content-Type: application/json');

// Kiểm tra nếu có file được upload
if(isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    
    // Lấy phần mở rộng của file
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    // Các định dạng file cho phép
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    
    if(in_array($fileExt, $allowed)) {
        if($fileError === 0) {
            if($fileSize < 5000000) { // Giới hạn 5MB
                // Tạo tên file mới để tránh trùng lặp
                $fileNameNew = uniqid('', true) . "." . $fileExt;
                $fileDestination = '../uploads/products/' . $fileNameNew;
                
                if(move_uploaded_file($fileTmpName, $fileDestination)) {
                    echo json_encode([
                        'success' => true,
                        'file_path' => 'uploads/products/' . $fileNameNew
                    ]);
                    exit();
                } else {
                    echo json_encode([
                        'success' => false,
                        'error' => 'Có lỗi khi lưu file'
                    ]);
                    exit();
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'error' => 'File quá lớn (giới hạn 5MB)'
                ]);
                exit();
            }
        } else {
            echo json_encode([
                'success' => false,
                'error' => 'Có lỗi khi upload file'
            ]);
            exit();
        }
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Định dạng file không được hỗ trợ (chỉ chấp nhận jpg, jpeg, png, gif)'
        ]);
        exit();
    }
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Không tìm thấy file upload'
    ]);
    exit();
} 