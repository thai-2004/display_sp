<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hienthisp";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()]);
    exit;
}

// Get pagination parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
$offset = ($page - 1) * $per_page;

try {
    // Get total count
    $count_query = "SELECT COUNT(*) as total FROM products";
    $count_stmt = $conn->prepare($count_query);
    $count_stmt->execute();
    $total = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Get products for current page
    $query = "SELECT * FROM products LIMIT :offset, :per_page";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':per_page', $per_page, PDO::PARAM_INT);
    $stmt->execute();
    
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Calculate total pages
    $total_pages = ceil($total / $per_page);
    
    echo json_encode([
        'success' => true,
        'data' => [
            'products' => $products,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $per_page,
                'total' => $total,
                'total_pages' => $total_pages
            ]
        ]
    ]);
} catch(PDOException $e) {
    echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
} 