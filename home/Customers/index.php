<?php
session_start();

if(!isset($_SESSION['user_email'])) {
    header("Location: ../index.php");
    exit;
}

include("config.php");
extract($_SESSION); 

// Get user information
$stmt_user = $DB_con->prepare('SELECT * FROM users WHERE user_email = :user_email');
$stmt_user->execute(array(':user_email' => $user_email));
$user_data = $stmt_user->fetch(PDO::FETCH_ASSOC);
extract($user_data);

// Get total order amount
$stmt_total = $DB_con->prepare("SELECT SUM(order_total) as total FROM orderdetails WHERE user_id = :user_id AND order_status = 'Ordered'");
$stmt_total->execute(array(':user_id' => $user_id));
$total_data = $stmt_total->fetch(PDO::FETCH_ASSOC);
$total = isset($total_data['total']) ? $total_data['total'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herath Tile Show Room</title>
    <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon" />
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #0f2453;
            --secondary-color: #375295;
            --accent-color: #f8f9fa;
            --text-color: #333;
            --success-color: #28a745;
            --danger-color: #dc3545;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: var(--text-color);
        }
        
        /* Sidebar styling */
        .sidebar {
            background-color: var(--primary-color);
            min-height: 100vh;
            position: fixed;
            z-index: 100;
            padding: 0;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        
        .sidebar .navbar-brand {
            padding: 15px 15px;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 0;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover {
            background-color: var(--secondary-color);
            color: white;
            padding-left: 25px;
        }
        
        .sidebar .nav-link.active {
            background-color: var(--secondary-color);
            color: white;
            border-left: 4px solid white;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        /* Main content area */
        .main-content {
            margin-left: 250px;
            padding: 0;
            transition: all 0.3s;
        }
        
        /* Topbar styling */
        .topbar {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            padding: 10px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .topbar .user-dropdown .dropdown-toggle {
            background: none;
            border: none;
            color: var(--text-color);
            font-weight: 500;
        }
        
        .topbar .user-dropdown .dropdown-toggle:focus {
            box-shadow: none;
        }
        
        /* Carousel styling */
        .carousel {
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .carousel-item img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }
        
        .carousel-caption {
            background-color: rgba(0,0,0,0.6);
            border-radius: 8px;
            padding: 15px;
            max-width: 60%;
            margin: 0 auto;
        }
        
        /* Modal styling */
        .modal-content {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .form-control {
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-success {
            background-color: var(--success-color);
        }
        
        .btn-danger {
            background-color: var(--danger-color);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                text-align: center;
                padding: 0;
            }
            
            .sidebar .navbar-brand {
                display: none;
            }
            
            .sidebar .nav-link span {
                display: none;
            }
            
            .sidebar .nav-link i {
                margin-right: 0;
                font-size: 1.2rem;
            }
            
            .main-content {
                margin-left: 80px;
            }
            
            .carousel-item img {
                height: 350px;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -80px;
            }
            
            .sidebar.show {
                margin-left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .carousel-item img {
                height: 250px;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar col-md-3 col-lg-2 d-md-block" id="sidebar">
            <div class="navbar-brand d-flex align-items-center">
                Herath Tiles
            </div>
            
            <ul class="nav flex-column mt-3">
            <li class="nav-item">
  <a class="nav-link text-success fw-bold" href="../Customers/index.php">
    <i class="fas fa-home"></i> Home
  </a>
</li>
                <li class="nav-item">
                    <a class="nav-link" href="shop.php?id=1">
                        <i class="fas fa-shopping-cart"></i> <span>Shop Now</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart_items.php">
                        <i class="fas fa-cart-plus"></i> <span>Shopping Cart</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">
                        <i class="fas fa-list-alt"></i> <span>My Orders</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_purchased.php">
                        <i class="fas fa-history"></i> <span>Previous Orders</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#accountSettingsModal">
                        <i class="fas fa-cog"></i> <span>Account Settings</span>
                    </a>
                </li>
                <li class="nav-item">
    <a class="nav-link text-danger fw-bold" href="logout.php">
        <i class="fas fa-sign-out-alt"></i> <span class="fw-bold">Logout</span>
    </a>
</li>


            </ul>
        </nav>
        
        <!-- Main Content -->
        <div class="main-content col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Topbar -->
            <div class="topbar mb-4">
                <div class="d-flex align-items-center">
                    <button class="btn d-md-none me-2" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="date-display d-none d-md-block">
                        <i class="far fa-calendar-alt me-2"></i>
                        <?php echo date('l, F d, Y'); ?>
                    </div>
                </div>
                
                <div class="d-flex">
                    <div class="cart-total me-4 d-none d-md-block">
                        <i class="fas fa-shopping-cart me-2"></i>
                        <span>Total: LKR <?php echo number_format($total, 2); ?></span>
                    </div>
                    
                    <div class="user-dropdown dropdown">
                        <button class="dropdown-toggle d-flex align-items-center" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="avatar bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px;">
                                <?php echo substr($user_firstname, 0, 1); ?>
                            </div>
                            <span class="d-none d-md-block"><?php echo $user_firstname; ?></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                        <li>
                        <a class="dropdown-item text-success fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#accountSettingsModal">
    <i class="fas fa-cog me-2"></i> Settings
</a>


                            <li><hr class="dropdown-divider"></li>
                            <li>
                            <a class="dropdown-item text-danger fw-bold" href="logout.php">
    <i class="fas fa-sign-out-alt me-2"></i> Logout
</a>


                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Carousel -->
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
                </div>
                
                <div class="carousel-inner rounded">
                    <div class="carousel-item active">
                        <img src="../images/2aba38b5-796a-4181-a40d-d42a78dd1ccb.png" class="d-block w-100" alt="Luxury Tiles">
                        <div class="carousel-caption">
                            <h2>Elegant Design Solutions</h2>
                            <p>Transform your space with our premium tile collections</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../images/60X120-Grey-Marble-Kitchen-Full-Polished-Glossy-Glazed-Porcelain-Floor-Tiles.webp" class="d-block w-100" alt="Grey Marble Tiles">
                        <div class="carousel-caption">
                            <h2>Premium Marble Collection</h2>
                            <p>Exquisite grey marble finishes for your kitchen</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../images/91f970bf-eb5e-4fb0-87b5-bde20c748c2d.png" class="d-block w-100" alt="Luxury Bathroom Tiles">
                        <div class="carousel-caption">
                            <h2>Bathroom Excellence</h2>
                            <p>Waterproof solutions with timeless elegance</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../images/1200-2600mm-Grey-Large-Format-Wall-Floor-Tiles-Porcelain-Slab-Indoor-Design.webp" class="d-block w-100" alt="Large Format Tiles">
                        <div class="carousel-caption">
                            <h2>Large Format Designs</h2>
                            <p>Create seamless spaces with our oversized tiles</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../images/727dfdf7-150e-497a-8437-36848f5a8229.png" class="d-block w-100" alt="Outdoor Tiles">
                        <div class="carousel-caption">
                            <h2>Outdoor Solutions</h2>
                            <p>Weather-resistant tiles for your garden and patio</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../images/4052c2cb-2b2a-4fa5-9879-3915274c09b7.png" class="d-block w-100" alt="Modern Design Tiles">
                        <div class="carousel-caption">
                            <h2>Modern Living</h2>
                            <p>Contemporary designs for the modern home</p>
                        </div>
                    </div>
                </div>
                
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            
            <!-- Featured Products Section (optional) -->
            <div class="container my-5">
                <h2 class="text-center mb-4">Featured Collections</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="badge bg-danger position-absolute end-0 m-3">New</div>
                            <img src="../images/60X120-Grey-Marble-Kitchen-Full-Polished-Glossy-Glazed-Porcelain-Floor-Tiles.webp" class="card-img-top" alt="Marble Collection" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">Marble Collection</h5>
                                <p class="card-text">Luxurious marble-effect tiles perfect for creating an elegant atmosphere in your home.</p>
                                <a href="shop.php?id=1&category=marble" class="btn btn-primary">View Collection</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="badge bg-success position-absolute end-0 m-3">Popular</div>
                            <img src="../images/91f970bf-eb5e-4fb0-87b5-bde20c748c2d.png" class="card-img-top" alt="Bathroom Tiles" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">Bathroom Series</h5>
                                <p class="card-text">Waterproof and stylish tiles specifically designed for bathroom environments.</p>
                                <a href="shop.php?id=1&category=bathroom" class="btn btn-primary">View Collection</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="badge bg-primary position-absolute end-0 m-3">Sale</div>
                            <img src="../images/727dfdf7-150e-497a-8437-36848f5a8229.png" class="card-img-top" alt="Outdoor Tiles" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">Outdoor Collection</h5>
                                <p class="card-text">Durable and weather-resistant tiles perfect for gardens, patios and outdoor spaces.</p>
                                <a href="shop.php?id=1&category=outdoor" class="btn btn-primary">View Collection</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <footer class="bg-light text-center text-lg-start mt-5">
                <div class="container p-4">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                            <h5 class="text-uppercase">Herath Tile Show Room</h5>
                            <p>
                                Providing high-quality tiles and exceptional service since 2010. Your one-stop destination for all your tiling needs.
                            </p>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                            <h5 class="text-uppercase">Quick Links</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><a href="../homepage/index.php" class="text-dark text-decoration-none">Home</a></li>
                                <li class="mb-2"><a href="shop.php?id=1" class="text-dark text-decoration-none">Shop</a></li>
                                <li class="mb-2"><a href="cart_items.php" class="text-dark text-decoration-none">Cart</a></li>
                                <li class="mb-2"><a href="orders.php" class="text-dark text-decoration-none">Orders</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
    <h5 class="text-uppercase">Contact Us</h5>
    <ul class="list-unstyled mb-0">
        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Kandy Road,Walapane, Central Province,Sri Lanka</li>
        <li class="mb-2"><i class="fas fa-phone me-2"></i> +94 77 6981105</li>
        <li class="mb-2"><i class="fas fa-envelope me-2"></i> herathtilesshowroom@gmail.com</li>
        <li class="mb-2">
            <div class="d-flex justify-content-center justify-content-lg-start mt-2">
                <a href="https://www.facebook.com/herathtilesshowroom" class="me-3" style="color: #4267B2;"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="https://www.instagram.com/herathtilesshowroom" class="me-3" style="color: #E1306C;"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="https://twitter.com/herathtilesshowroom" class="me-3" style="color: #1DA1F2;"><i class="fab fa-twitter fa-lg"></i></a>
                <a href="https://www.youtube.com/herathtilesshowroom" class="me-3" style="color: #FF0000;"><i class="fab fa-youtube fa-lg"></i></a>
                <a href="https://wa.me/94776981105" style="color: #25D366;"><i class="fab fa-whatsapp fa-lg"></i></a>
            </div>
        </li>
    </ul>
</div>
                    </div>
                </div>
                <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
                    © 2025 Herath Tile Show Room. All rights reserved.
                </div>
            </footer>
        </div>
    </div>
    
    <!-- Account Settings Modal -->
    <div class="modal fade" id="accountSettingsModal" tabindex="-1" aria-labelledby="accountSettingsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountSettingsModalLabel">Account Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="settings.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="user_firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="user_firstname" name="user_firstname" value="<?php echo $user_firstname; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="user_lastname" name="user_lastname" value="<?php echo $user_lastname; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="user_address" name="user_address" value="<?php echo $user_address; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="user_password" name="user_password" value="<?php echo $user_password; ?>" required>
                        </div>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success" name="user_save">Save Changes</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery, Popper.js, Bootstrap 5 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
        
        // Number input validation
        function isNumber(evt, element) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            
            if ((charCode != 45 || $(element).val().indexOf('-') != -1) && 
                (charCode != 46 || $(element).val().indexOf('.') != -1) && 
                (charCode < 48 || charCode > 57))
                return false;
                
            return true;
        }
        
        $(document).ready(function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Number input validation
            $('#priceinput').keypress(function (event) {
                return isNumber(event, this);
            });
        });
    </script>
</body>
</html>