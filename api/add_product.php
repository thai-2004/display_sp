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
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'] ?? null;
    
    // Insert into database
    $stmt = $conn->prepare("INSERT INTO products (name, price, image_url) VALUES (?, ?, ?)");
    $stmt->execute([$name, $price, $image_url]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Thêm sản phẩm thành công',
        'product_id' => $conn->lastInsertId()
    ]);
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Lỗi: ' . $e->getMessage()
    ]);
} 