<?php
// Kiểm tra nếu đang sửa sản phẩm
$isEditing = isset($_GET['id']);
$product = null;

if($isEditing) {
    // Lấy thông tin sản phẩm từ database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hienthisp";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isEditing ? 'Sửa sản phẩm' : 'Thêm sản phẩm mới'; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .image-preview {
            max-width: 200px;
            margin-top: 10px;
        }

        button {
            padding: 10px 20px;
            background: #000;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #333;
        }

        .error {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $isEditing ? 'Sửa sản phẩm' : 'Thêm sản phẩm mới'; ?></h1>
        
        <form id="productForm" onsubmit="submitForm(event)">
            <?php if($isEditing): ?>
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" required 
                    value="<?php echo $isEditing ? $product['name'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" id="price" name="price" step="0.01" required
                    value="<?php echo $isEditing ? $product['price'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="image">Hình ảnh:</label>
                <input type="file" id="image" name="image" accept="image/*" <?php echo $isEditing ? '' : 'required'; ?>>
                <?php if($isEditing && $product['image_url']): ?>
                    <img src="../<?php echo $product['image_url']; ?>" class="image-preview" id="currentImage">
                <?php endif; ?>
                <img id="imagePreview" class="image-preview" style="display: none;">
            </div>

            <button type="submit"><?php echo $isEditing ? 'Cập nhật' : 'Thêm mới'; ?></button>
        </form>
    </div>

    <script>
        // Preview ảnh trước khi upload
        document.getElementById('image').onchange = function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    
                    // Ẩn ảnh hiện tại nếu đang trong chế độ sửa
                    const currentImage = document.getElementById('currentImage');
                    if(currentImage) {
                        currentImage.style.display = 'none';
                    }
                }
                reader.readAsDataURL(file);
            }
        };

        // Xử lý submit form
        function submitForm(e) {
            e.preventDefault();
            
            const formData = new FormData(document.getElementById('productForm'));
            const isEditing = formData.has('id');
            
            // Upload ảnh trước nếu có file mới
            const imageFile = document.getElementById('image').files[0];
            if (imageFile) {
                const imageFormData = new FormData();
                imageFormData.append('image', imageFile);
                
                fetch('../api/upload_image.php', {
                    method: 'POST',
                    body: imageFormData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        formData.append('image_url', data.file_path);
                        saveProduct(formData);
                    } else {
                        alert('Lỗi upload ảnh: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi upload ảnh');
                });
            } else {
                // Nếu không có ảnh mới, tiến hành lưu sản phẩm
                saveProduct(formData);
            }
        }

        function saveProduct(formData) {
            const isEditing = formData.has('id');
            fetch('../api/' + (isEditing ? 'update_product.php' : 'add_product.php'), {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(isEditing ? 'Cập nhật sản phẩm thành công!' : 'Thêm sản phẩm thành công!');
                    window.location.href = 'products.php'; // Chuyển về trang danh sách
                } else {
                    alert('Lỗi: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi lưu sản phẩm');
            });
        }
    </script>
</body>
</html> 