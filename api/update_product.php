<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hienthisp";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    
    // Check if new image was uploaded
    if(isset($_POST['image_url'])) {
        $image_url = $_POST['image_url'];
        
        // Get old image path to delete
        $stmt = $conn->prepare("SELECT image_url FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $old_image = $stmt->fetch(PDO::FETCH_ASSOC)['image_url'];
        
        // Delete old image if exists
        if($old_image && file_exists('../' . $old_image)) {
            unlink('../' . $old_image);
        }
        
        // Update with new image
        $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image_url = ? WHERE id = ?");
        $stmt->execute([$name, $price, $image_url, $id]);
    } else {
        // Update without changing image
        $stmt = $conn->prepare("UPDATE products SET name = ?, price = ? WHERE id = ?");
        $stmt->execute([$name, $price, $id]);
    }
    
    echo json_encode([
        'success' => true,
        'message' => 'Cập nhật sản phẩm thành công'
    ]);
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Lỗi: ' . $e->getMessage()
    ]);
} 