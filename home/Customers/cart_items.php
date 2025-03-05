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
 require_once 'config.php';
	
 if(isset($_GET['delete_id']))
 {	
    $stmt_delete = $DB_con->prepare('DELETE FROM orderdetails WHERE order_id =:order_id');
    $stmt_delete->bindParam(':order_id',$_GET['delete_id']);
    $stmt_delete->execute();
    
    header("Location: cart_items.php");
 }
?>

<?php
 require_once 'config.php';
	
 if(isset($_GET['update_id']))
 {
    $stmt_delete = $DB_con->prepare('update orderdetails set order_status="Ordered" WHERE order_status="Pending" and user_id =:user_id');
    $stmt_delete->bindParam(':user_id',$_GET['update_id']);
    $stmt_delete->execute();
    echo "<script>alert('Item/s successfully ordered!')</script>";	
    
    header("Location: orders.php");
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herath Tile Showroom</title>
    <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            padding-top: 70px;
            transition: all 0.3s ease;
        }
        
        #wrapper {
            padding-left: 225px;
            transition: all 0.5s ease;
        }
        
        .navbar-inverse {
            background: linear-gradient(135deg, #142d69 0%, #0f2453 100%);
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-inverse .navbar-brand {
            color: #ffffff;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 15px;
            font-size: 22px;
            transition: all 0.3s ease;
        }
        
        .navbar-inverse .navbar-brand:hover {
            color: #ff9800;
            transform: scale(1.05);
        }
        
        .side-nav {
            position: fixed;
            top: 51px;
            left: 225px;
            width: 225px;
            margin-left: -225px;
            border: none;
            border-radius: 0;
            overflow-y: auto;
            background: linear-gradient(180deg, #152c62 0%, #0a1733 100%);
            bottom: 0;
            overflow-x: hidden;
            padding-bottom: 40px;
            transition: all 0.4s ease;
        }
        
        .side-nav li {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .side-nav li:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        
        /* Home button - green color */
        .side-nav li:nth-child(1) a {
            color: #28a745;
            transition: all 0.3s ease;
            padding: 15px;
            font-weight: 600;
        }
        
        .side-nav li:nth-child(1) a:hover {
            color: #2ecc71;
        }
        
        /* Settings button - green color */
        .side-nav li:nth-child(6) a {
            color: #28a745;
            transition: all 0.3s ease;
            padding: 15px;
            font-weight: 600;
        }
        
        .side-nav li:nth-child(6) a:hover {
            color: #2ecc71;
        }
        
        /* Logout button - red color */
        .side-nav li:nth-child(7) a {
            color: #dc3545;
            transition: all 0.3s ease;
            padding: 15px;
            font-weight: 600;
        }
        
        .side-nav li:nth-child(7) a:hover {
            color: #ff0000;
        }
        
        /* Other nav items */
        .side-nav li:not(:nth-child(1)):not(:nth-child(6)):not(:nth-child(7)) a {
            color: #e0e0e0;
            transition: all 0.3s ease;
            padding: 15px;
        }
        
        .side-nav li:not(:nth-child(1)):not(:nth-child(6)):not(:nth-child(7)) a:hover, 
        .side-nav li:not(:nth-child(1)):not(:nth-child(6)):not(:nth-child(7)) a:focus {
            outline: none;
            color: #ffffff;
            background-color: transparent;
        }
        
        .side-nav li.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-left: 4px solid #ff9800;
        }
        
        .side-nav li.active a {
            color: #ffffff;
            font-weight: 600;
        }
        
        .navbar-user {
            box-shadow: none;
        }
        
        .navbar-user li a {
            color: #ffffff;
            transition: all 0.3s ease;
        }
        
        .navbar-user li a:hover {
            color: #ff9800;
        }
        
        .dropdown-menu {
            background-color: #152c62;
            border: none;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .dropdown-menu li a {
            color: #ffffff;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }
        
        .dropdown-menu li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ff9800;
        }
        
        /* Settings button in dropdown - green color */
        .dropdown-menu li:nth-child(1) a {
            color: #28a745;
        }
        
        .dropdown-menu li:nth-child(1) a:hover {
            color: #2ecc71;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        /* Logout button in dropdown - red color */
        .dropdown-menu li:nth-child(3) a {
            color: #dc3545;
        }
        
        .dropdown-menu li:nth-child(3) a:hover {
            color: #ff0000;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .dropdown-menu .divider {
            background-color: rgba(255, 255, 255, 0.1);
            margin: 5px 0;
        }
        
        #page-wrapper {
            padding: 20px;
            width: 100%;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            min-height: calc(100vh - 70px);
            transition: all 0.5s ease;
        }
        
        .alert-default {
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #142d69 0%, #0f2453 100%);
            padding: 15px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15, 36, 83, 0.2);
            animation: fadeInDown 0.5s;
        }
        
        .table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.8s;
        }
        
        .table thead th {
            background-color: #152c62;
            color: white;
            font-weight: 500;
            border: none;
            padding: 15px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            background-color: #f5f8ff;
            transform: scale(1.01);
        }
        
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: #eef2f7;
        }
        
        .btn {
            border-radius: 6px;
            padding: 10px 15px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.3);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }
        
        .btn:hover:after {
            animation: ripple 1s ease-out;
        }
        
        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }
        
        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            border: none;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.2);
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
            box-shadow: 0 6px 15px rgba(40, 167, 69, 0.3);
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.2);
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
            box-shadow: 0 6px 15px rgba(220, 53, 69, 0.3);
            transform: translateY(-2px);
        }
        
        .modal-content {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
        }
        
        .modal-header {
            background: linear-gradient(135deg, #142d69 0%, #0f2453 100%);
            padding: 20px;
            border-bottom: none;
        }
        
        .modal-body {
            padding: 25px;
        }
        
        .modal-footer {
            border-top: none;
            padding: 15px 25px 25px;
        }
        
        .form-control {
            height: 45px;
            border-radius: 6px;
            border: 1px solid #dce7f1;
            box-shadow: none;
            padding: 10px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #0f2453;
            box-shadow: 0 0 0 3px rgba(15, 36, 83, 0.1);
        }
        
        .alert-warning {
            background-color: #fff8e1;
            color: #ff9800;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(255, 152, 0, 0.1);
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 152, 0, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(255, 152, 0, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 152, 0, 0);
            }
        }
        
        /* Footer styling */
        .footer {
            background: linear-gradient(135deg, #142d69 0%, #0f2453 100%);
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-top: 25px;
            box-shadow: 0 -4px 15px rgba(15, 36, 83, 0.1);
        }
        
        /* Animation classes */
        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }
        
        .fadeIn {
            animation-name: fadeIn;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        .fadeInDown {
            animation-name: fadeInDown;
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate3d(0, -20px, 0);
            }
            to {
                opacity: 1;
                transform: none;
            }
        }
        
        /* Responsive tweaks */
        @media (max-width: 768px) {
            #wrapper {
                padding-left: 0;
            }
            #page-wrapper {
                width: 100%;
                padding: 10px;
            }
            .side-nav {
                left: 0;
            }
        }
    </style>
</head>
<body>
<div id="wrapper" class="animate__animated animate__fadeIn">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><i class="fa fa-building"></i> Herath Tile Showroom</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="../Customers/index.php"> &nbsp; <span class='glyphicon glyphicon-home'></span> Home</a></li>
                    <li><a href="shop.php?id=1"> &nbsp; <span class='glyphicon glyphicon-shopping-cart'></span> Shop Now</a></li>
                    <li class="active"><a href="cart_items.php"> &nbsp; <span class='fa fa-cart-plus'></span> Shopping Cart Lists</a></li>
                    <li><a href="orders.php"> &nbsp; <span class='glyphicon glyphicon-list-alt'></span> My Ordered Items</a></li>
                    <li><a href="view_purchased.php"> &nbsp; <span class='glyphicon glyphicon-eye-open'></span> Previous Items Ordered</a></li>
                    <li><a data-toggle="modal" data-target="#setAccount"> &nbsp; <span class='fa fa-gear'></span> Account Settings</a></li>
                    <li><a href="logout.php"> &nbsp; <span class='glyphicon glyphicon-off'></span> Logout</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#"><i class="fa fa-calendar"></i> <?php
                            $Today=date('y:m:d');
                            $new=date('l, F d, Y',strtotime($Today));
                            echo $new; ?></a>
                    </li>
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-shopping-cart'></span> Total Price Ordered: LKR <?php echo $total; ?> </b></a>
                    </li>
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_email; ?><b class="caret"></b></a>
                        
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="alert alert-default animate__animated animate__fadeInDown" style="color:white;background-color:#0f2453">
                <center><h3><span class="fa fa-cart-plus fa-lg"></span> Shopping Cart Lists</h3></center>
            </div>
            
            <br />
                          
            <div class="table-responsive animate__animated animate__fadeIn">
                <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    include("config.php");
                    
                    $stmt = $DB_con->prepare("SELECT * FROM orderdetails where order_status='Pending' and user_id='$user_id'");
                    $stmt->execute();
                    
                    if($stmt->rowCount() > 0)
                    {
                        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                        {
                            extract($row);
                            
                            ?>
                            <tr>
                                <td><?php echo $order_name; ?></td>
                                <td>LKR <?php echo $order_price; ?></td>
                                <td><?php echo $order_quantity; ?></td>
                                <td>LKR <?php echo $order_total; ?></td>
                                <td>                                                                                 
                                    <a class="btn btn-block btn-danger" href="?delete_id=<?php echo $row['order_id']; ?>" title="click for delete" onclick="return confirm('Are you sure to remove this item?')">
                                        <span class='glyphicon glyphicon-trash'></span> Remove Item
                                    </a>
                                </td>
                            </tr>              
                            <?php
                        }
                        include("config.php");
                        $stmt_edit = $DB_con->prepare("select sum(order_total) as totalx from orderdetails where user_id=:user_id and order_status='Pending'");
                        $stmt_edit->execute(array(':user_id'=>$user_id));
                        $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
                        extract($edit_row);
                        
                        echo "<tr class='info'>";
                        echo "<td colspan='3' align='right'><strong>Total Price:</strong>";
                        echo "</td>";
                        
                        echo "<td><strong>LKR ".$totalx."</strong>";
                        echo "</td>";
                        
                        echo "<td>";
                        echo "<a class='btn btn-block btn-success' href='?update_id=".$user_id."'><span class='glyphicon glyphicon-shopping-cart'></span> Order Now!</a>";
                        echo "</td>";
                        
                        echo "</tr>";
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "<br />";
                        echo '<div class="footer">
                            <p>
                                &copy; 2025 HERATH TILE SHOW ROOM | All Rights Reserved | Design by : Dinitha
                            </p>
                        </div>';
                        
                        echo "</div>";
                    }
                    else
                    {
                        ?>
                        <div class="col-xs-12">
                            <div class="alert alert-warning animate__animated animate__pulse">
                                <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Item Found in Your Cart
                            </div>
                            <div class="text-center">
                                <a href="shop.php?id=1" class="btn btn-primary btn-lg">
                                    <i class="fa fa-shopping-cart"></i> Continue Shopping
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>                                                        
                </div>
            </div>                    
        </div>                      
    </div>
    <!-- /#wrapper -->   
    <!-- Mediul Modal -->
    <div class="modal fade" id="setAccount" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
        <div class="modal-dialog modal-sm">
            <div style="color:white;background-color:#0f2453" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 style="color:white" class="modal-title" id="myModalLabel">Account Settings</h2>
                </div>
                <div class="modal-body">                                         
                    <form enctype="multipart/form-data" method="post" action="settings.php">
                        <fieldset>
                            <p>Firstname:</p>
                            <div class="form-group">
                                <input class="form-control" placeholder="Firstname" name="user_firstname" type="text" value="<?php echo $user_firstname; ?>" required>
                            </div>
                                                        
                            <p>Lastname:</p>
                            <div class="form-group">
                                <input class="form-control" placeholder="Lastname" name="user_lastname" type="text" value="<?php echo $user_lastname; ?>" required>
                            </div>
                            
                            <p>Address:</p>
                            <div class="form-group">
                                <input class="form-control" placeholder="Address" name="user_address" type="text" value="<?php echo $user_address; ?>" required>
                            </div>
                            
                            <p>Password:</p>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="user_password" type="password" value="<?php echo $user_password; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <input class="form-control hide" name="user_id" type="text" value="<?php echo $user_id; ?>" required>
                            </div>
                        </fieldset>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-block btn-success btn-md" name="user_save">Save</button>
                    <button type="button" class="btn btn-block btn-danger btn-md" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#priceinput').keypress(function (event) {
                return isNumber(event, this)
            });

            // Add animations
            $('.side-nav li').each(function(index) {
                $(this).css('animation-delay', (index * 0.1) + 's');
                $(this).addClass('animate__animated animate__fadeInLeft');
            });
        });
      
        function isNumber(evt, element) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (
                (charCode != 45 || $(element).val().indexOf('-') != -1) &&      
                (charCode != 46 || $(element).val().indexOf('.') != -1) &&      
                (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
</body>
</html>