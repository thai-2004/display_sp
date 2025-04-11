-- Tạo cơ sở dữ liệu
CREATE DATABASE IF NOT EXISTS hienthisp;
USE hienthisp;

-- Tạo bảng products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Thêm một số dữ liệu mẫu
INSERT INTO products (name, price, image_url) VALUES
('Gradient Graphic T-shirt', 199000, 'uploads/products/product1.jpg'),
('Polo with Tipping Details', 399000, 'uploads/products/product2.jpg'),
('Black Striped T-shirt', 599000, 'uploads/products/product3.jpg'),
('SKINNY FIT JEANS', 299000, 'uploads/products/product4.jpg'),
('CHECKERED SHIRT', 499000, 'uploads/products/product5.jpg'); 