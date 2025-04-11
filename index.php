<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop.CO - Products</title>
    <link href="https://fonts.googleapis.com/css2?family=Satoshi:wght@400;500;700&family=Integral+CF:wght@700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Satoshi', sans-serif;
        }

        body {
            background: white;
            color: black;
        }

        .header {
            width: 100%;
            height: 38px;
            background: black;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 14px;
        }

        .header a {
            color: white;
            text-decoration: underline;
            font-weight: 500;
        }

        .main-nav {
            width: 1240px;
            margin: 24px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Integral CF', sans-serif;
            font-size: 32px;
            font-weight: 700;
        }

        .nav-links {
            display: flex;
            gap: 24px;
        }

        .nav-links a {
            color: black;
            text-decoration: none;
            font-size: 16px;
        }

        .search-bar {
            flex: 1;
            margin: 0 40px;
            padding: 12px 16px;
            background: #F0F0F0;
            border-radius: 62px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-bar input {
            border: none;
            background: none;
            width: 100%;
            color: rgba(0, 0, 0, 0.40);
            font-size: 16px;
        }

        .search-bar input:focus {
            outline: none;
        }

        .icons {
            display: flex;
            gap: 14px;
        }

        .breadcrumb {
            margin: 0 auto;
            width: 1240px;
            padding: 12px 0;
            display: flex;
            gap: 12px;
            color: rgba(0, 0, 0, 0.60);
        }

        .breadcrumb a {
            color: rgba(0, 0, 0, 0.60);
            text-decoration: none;
        }

        .content {
            width: 1240px;
            margin: 0 auto;
            display: flex;
            gap: 40px;
        }

        .filters {
            width: 295px;
            padding: 20px 24px;
            border-radius: 20px;
            border: 1px solid rgba(0, 0, 0, 0.10);
        }

        .filter-section {
            margin-bottom: 24px;
        }

        .filter-section h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .filter-options {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .products-grid {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .product-info {
            padding: 16px;
        }

        .product-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .product-price {
            font-size: 18px;
            font-weight: 700;
            color: #000;
        }

        .pagination {
            margin: 40px auto;
            width: 1240px;
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .pagination button {
            padding: 8px 16px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: white;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pagination button:hover {
            background: #F0F0F0;
        }

        .pagination button.active {
            background: black;
            color: white;
        }

        .loading {
            text-align: center;
            padding: 40px;
            font-size: 18px;
            color: rgba(0, 0, 0, 0.6);
        }

        .footer {
            background: #F0F0F0;
            padding: 60px 0 20px;
            margin-top: 60px;
        }

        .footer-content {
            max-width: 1240px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr repeat(4, 1fr);
            gap: 40px;
            padding: 0 20px;
        }

        .footer-section h3 {
            font-family: 'Integral CF', sans-serif;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .footer-section h4 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .footer-section p {
            color: rgba(0, 0, 0, 0.6);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 12px;
        }

        .footer-section ul li a {
            color: rgba(0, 0, 0, 0.6);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: #000;
        }

        .social-icons {
            display: flex;
            gap: 16px;
        }

        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .social-icons a:hover {
            transform: translateY(-3px);
        }

        .social-icons img {
            width: 20px;
            height: 20px;
        }

        .footer-bottom {
            max-width: 1240px;
            margin: 40px auto 0;
            padding: 20px;
            text-align: center;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            color: rgba(0, 0, 0, 0.6);
        }

        @media (max-width: 1024px) {
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .social-icons {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <span>Sign up and get 20% off to your first order. <a href="#">Sign Up Now</a></span>
    </div>

    <nav class="main-nav">
        <div class="logo">SHOP.CO</div>
        <div class="nav-links">
            <a href="#">Shop</a>
            <a href="#">On Sale</a>
            <a href="#">New Arrivals</a>
            <a href="#">Brands</a>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search for products...">
        </div>
        <div class="icons">
            <img src="assets/cart.svg" alt="Cart">
            <img src="assets/user.svg" alt="User">
        </div>
    </nav>

    <div class="breadcrumb">
        <a href="#">Home</a>
        <span>›</span>
        <span>Casual</span>
    </div>

    <div class="content">
        <div class="filters">
            <div class="filter-section">
                <h3>Categories</h3>
                <div class="filter-options">
                    <label><input type="checkbox"> T-shirts</label>
                    <label><input type="checkbox"> Shorts</label>
                    <label><input type="checkbox"> Shirts</label>
                    <label><input type="checkbox"> Hoodie</label>
                    <label><input type="checkbox"> Jeans</label>
                </div>
            </div>
            <div class="filter-section">
                <h3>Price</h3>
                <input type="range" min="0" max="200" value="50">
                <div class="price-range">
                    <span>$50</span>
                    <span>$200</span>
                </div>
            </div>
            <div class="filter-section">
                <h3>Colors</h3>
                <div class="color-options">
                    <div class="color" style="background: #00C12B"></div>
                    <div class="color" style="background: #F50606"></div>
                    <div class="color" style="background: #F5DD06"></div>
                    <div class="color" style="background: #F57906"></div>
                    <div class="color" style="background: #06CAF5"></div>
                </div>
            </div>
        </div>

        <div class="products-container">
            <div class="products-grid" id="products-grid">
                <!-- Products will be loaded here via AJAX -->
            </div>
            <div class="pagination" id="pagination">
                <!-- Pagination will be loaded here via AJAX -->
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>SHOP.CO</h3>
                <p>We have clothes that suits your style and which you're proud to wear. From women to men.</p>
                <div class="social-icons">
                    <a href="#"><img src="assets/facebook.svg" alt="Facebook"></a>
                    <a href="#"><img src="assets/instagram.svg" alt="Instagram"></a>
                    <a href="#"><img src="assets/twitter.svg" alt="Twitter"></a>
                    <a href="#"><img src="assets/youtube.svg" alt="YouTube"></a>
                </div>
            </div>
            <div class="footer-section">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Features</a></li>
                    <li><a href="#">Works</a></li>
                    <li><a href="#">Career</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Help</h4>
                <ul>
                    <li><a href="#">Customer Support</a></li>
                    <li><a href="#">Delivery Details</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>FAQ</h4>
                <ul>
                    <li><a href="#">Account</a></li>
                    <li><a href="#">Manage Deliveries</a></li>
                    <li><a href="#">Orders</a></li>
                    <li><a href="#">Payments</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Resources</h4>
                <ul>
                    <li><a href="#">Free eBooks</a></li>
                    <li><a href="#">Development Tutorial</a></li>
                    <li><a href="#">How to - Blog</a></li>
                    <li><a href="#">Youtube Playlist</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Shop.co © 2000-2023, All Rights Reserved</p>
        </div>
    </div>

    <script>
        let currentPage = 1;
        const perPage = 9;

        function loadProducts(page) {
            const productsGrid = document.getElementById('products-grid');
            const pagination = document.getElementById('pagination');
            
            // Show loading state
            productsGrid.innerHTML = '<div class="loading">Loading products...</div>';
            
            fetch(`api/get_products.php?page=${page}&per_page=${perPage}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const { products, pagination: paginationData } = data.data;
                        
                        // Render products
                        productsGrid.innerHTML = products.map(product => `
                            <div class="product-card">
                                <img src="${product.image_url}" alt="${product.name}" class="product-image">
                                <div class="product-info">
                                    <h3 class="product-title">${product.name}</h3>
                                    <p class="product-price">$${product.price}</p>
                                </div>
                            </div>
                        `).join('');

                        // Render pagination
                        let paginationHTML = '';
                        if (paginationData.total_pages > 1) {
                            if (page > 1) {
                                paginationHTML += `<button onclick="loadProducts(${page - 1})">Previous</button>`;
                            }
                            
                            for (let i = 1; i <= paginationData.total_pages; i++) {
                                paginationHTML += `<button class="${i === page ? 'active' : ''}" onclick="loadProducts(${i})">${i}</button>`;
                            }
                            
                            if (page < paginationData.total_pages) {
                                paginationHTML += `<button onclick="loadProducts(${page + 1})">Next</button>`;
                            }
                        }
                        pagination.innerHTML = paginationHTML;
                    } else {
                        productsGrid.innerHTML = '<div class="error">Error loading products</div>';
                    }
                })
                .catch(error => {
                    productsGrid.innerHTML = '<div class="error">Error loading products</div>';
                    console.error('Error:', error);
                });
        }

        // Load initial products
        loadProducts(currentPage);
    </script>
</body>
</html>
