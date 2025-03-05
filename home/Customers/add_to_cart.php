<?php
session_start();

if(!$_SESSION['user_email'])
{

    header("Location: ../index.php");
}

?>

<?php
 include("config.php");
 extract($_SESSION); 
		  $stmt_edit = $DB_con->prepare('SELECT * FROM users WHERE user_email =:user_email');
		$stmt_edit->execute(array(':user_email'=>$user_email));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		
		?>
		<?php
 include("config.php");
		  $stmt_edit = $DB_con->prepare("select sum(order_total) as total from orderdetails where user_id=:user_id and order_status='Ordered'");
		$stmt_edit->execute(array(':user_id'=>$user_id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		
		?>
		
		
		<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'config.php';
	
	if(isset($_GET['cart']) && !empty($_GET['cart']))
	{
		$id = $_GET['cart'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM items WHERE item_id =:item_id');
		$stmt_edit->execute(array(':item_id'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: shop.php");
	}
	
	
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herath Tile Showroom</title>
    <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --background-light: #f4f6f7;
            --text-color: #2c3e50;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-light);
            color: var(--text-color);
            line-height: 1.6;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background-color: var(--primary-color);
            color: white;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .sidebar-logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: var(--secondary-color);
            color: white;
        }

        .sidebar-menu a .material-icons {
            margin-right: 15px;
            font-size: 20px;
        }

        .main-content {
            margin-left: 280px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .order-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 20px;
        }

        .product-image {
            max-height: 400px;
            width: 100%;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.05);
        }

        .btn-custom {
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .top-bar {
            background-color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <h2 class="text-white">Herath Tile</h2>
        </div>
        <div class="sidebar-menu">
            <a href="index.php" class="active">
                <span class="material-icons">home</span> Dashboard
            </a>
            <a href="shop.php?id=1">
                <span class="material-icons">shopping_cart</span> Shop Now
            </a>
            <a href="cart_items.php">
                <span class="material-icons">add_shopping_cart</span> Cart
            </a>
            <a href="orders.php">
                <span class="material-icons">list_alt</span> My Orders
            </a>
            <a href="view_purchased.php">
                <span class="material-icons">visibility</span> Previous Orders
            </a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#setAccount">
                <span class="material-icons">settings</span> Account Settings
            </a>
            <a href="logout.php">
                <span class="material-icons">logout</span> Logout
            </a>
        </div>
    </div>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="date">
            <span class="material-icons">calendar_today</span>
            <?php
            $Today = date('y:m:d');
            $new = date('l, F d, Y', strtotime($Today));
            echo $new; 
            ?>
        </div>
        <div class="user-info">
            <span class="material-icons">account_circle</span>
            <span><?php echo $user_email; ?></span>
            <span class="badge bg-secondary">Total: LKR <?php echo $total; ?></span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="order-card">
                <h2 class="mb-4 text-center">Order Details</h2>
                
                <form role="form" method="post" action="save_order.php">
                    <!-- Hidden inputs -->
                    <input type="hidden" name="order_name" value="<?php echo $item_name; ?>" />
                    <input type="hidden" name="order_price" value="<?php echo $item_price; ?>" />
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />

                    <div class="row">
                        <div class="col-md-6">
                            <img src="../../admin/admin/itempic/<?php echo $item_image; ?>" 
                                 alt="Product Image" 
                                 class="product-image mb-3">
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Item Name</label>
                                <input type="text" class="form-control" value="<?php echo $item_name; ?>" disabled>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" value="<?php echo $item_price; ?>" disabled>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <?php 
                                if (isset($qty) && $qty == 0):  
                                ?>
                                    <div class="text-danger">Out of Stock</div>
                                <?php 
                                elseif (isset($qty)): 
                                ?>
                                    <input class="form-control" type="text" placeholder="Quantity" 
                                           name="order_quantity" value="1" 
                                           onkeypress="return isNumber(event)" 
                                           onpaste="return false" required />
                                <?php 
                                else: 
                                ?>
                                    <div class="text-danger">Error: Item quantity not available</div>
                                <?php 
                                endif;
                                ?>
                            </div>
                            
                            <div class="d-flex gap-3">
                                <button type="submit" name="order_save" class="btn btn-primary btn-custom flex-grow-1">
                                    <span class="material-icons">shopping_cart</span> Confirm Order
                                </button>
                                <a href="shop.php?id=1" class="btn btn-danger btn-custom flex-grow-1">
                                    <span class="material-icons">cancel</span> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Account Settings Modal -->
    <div class="modal fade" id="setAccount" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Account Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="settings.php">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input class="form-control" name="user_firstname" 
                                       value="<?php echo $user_firstname; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input class="form-control" name="user_lastname" 
                                       value="<?php echo $user_lastname; ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <input class="form-control" name="user_address" 
                                       value="<?php echo $user_address; ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="user_password" 
                                       value="<?php echo $user_password; ?>" required>
                            </div>
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="user_save" class="btn btn-primary">Save Changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    </script>
</body>
</html>