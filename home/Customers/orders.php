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

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>   
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        #wrapper {
            padding-left: 225px;
            transition: all 0.4s ease 0s;
        }
        
        #page-wrapper {
            padding: 20px;
            min-height: calc(100vh - 51px);
            background-color: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .navbar-inverse {
            background: linear-gradient(90deg, #0f2453 0%, #152c62 100%);
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-inverse .navbar-brand {
            color: white;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 15px 25px;
            transition: all 0.3s ease;
        }
        
        .navbar-inverse .navbar-brand:hover {
            color: #ffcc00;
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
        
        /* Page header styles */
        .alert-default {
            color: white;
            background: linear-gradient(90deg, #0f2453 0%, #1a3a7a 100%);
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(15, 36, 83, 0.2);
            padding: 15px;
            margin-bottom: 25px;
        }
        
        .alert-default h3 {
            margin: 5px 0;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        /* Table styles */
        .table-responsive {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 10px;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
            border-bottom: 2px solid #0f2453;
        }
        
        .table-bordered {
            border: 1px solid #e7eaf3;
        }
        
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #e7eaf3;
            padding: 12px 15px;
            vertical-align: middle;
        }
        
        /* Button styles */
        .btn-success {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);
            padding: 8px 20px;
            transition: all 0.3s ease;
        }
        
        .btn-success:hover {
            background: linear-gradient(45deg, #20c997, #28a745);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(40, 167, 69, 0.4);
        }
        
        /* Modal styles */
        .modal-content {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .modal-header {
            background: linear-gradient(90deg, #0f2453 0%, #1a3a7a 100%);
            border-bottom: none;
            padding: 15px 20px;
        }
        
        .modal-header h2 {
            font-weight: 600;
            margin: 0;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .modal-footer {
            border-top: none;
            padding: 15px 20px;
        }
        
        .form-control {
            height: auto;
            padding: 10px 15px;
            border-radius: 6px;
            border: 1px solid #dbe0e5;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #0f2453;
            box-shadow: 0 0 0 3px rgba(15, 36, 83, 0.1);
        }
        
        /* Footer styles */
        .footer {
            background: linear-gradient(90deg, #0f2453 0%, #1a3a7a 100%);
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-top: 25px;
            box-shadow: 0 4px 15px rgba(15, 36, 83, 0.2);
        }
        
        /* Navbar user dropdown */
        .navbar-user li a {
            color: #e0e0e0;
            transition: all 0.3s ease;
        }
        
        .navbar-user li a:hover {
            color: white;
        }
        
        .navbar-user .dropdown-menu {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: none;
            padding: 8px 0;
        }
        
        .navbar-user .dropdown-menu li a {
            color: #333;
            padding: 8px 20px;
        }
        
        .navbar-user .dropdown-menu li a:hover {
            background-color: #f8f9fa;
            color: #0f2453;
        }
        
        /* Alert styles */
        .alert-warning {
            border-radius: 8px;
            background-color: #fff3cd;
            color: #856404;
            border-color: #ffeeba;
            padding: 15px;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Herath Tile Showroom</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="../Customers/index.php"> &nbsp; <span class='glyphicon glyphicon-home'></span> Home</a></li>
					<li><a href="shop.php?id=1"> &nbsp; <span class='glyphicon glyphicon-shopping-cart'></span> Shop Now</a></li>
					<li><a href="cart_items.php"> &nbsp; <span class='fa fa-cart-plus'></span> Shopping Cart Lists</a></li>
					<li class="active"><a href="orders.php"> &nbsp; <span class='glyphicon glyphicon-list-alt'></span> My Ordered Items</a></li>
					<li><a href="view_purchased.php"> &nbsp; <span class='glyphicon glyphicon-eye-open'></span> Previous Items Ordered</a></li>
					<li><a data-toggle="modal" data-target="#setAccount"> &nbsp; <span class='fa fa-gear'></span> Account Settings</a></li>
					<li><a href="logout.php"> &nbsp; <span class='glyphicon glyphicon-off'></span> Logout</a></li>
					                   
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#"><i class="fa fa-calendar"></i>  <?php
                            $Today=date('y:m:d');
                            $new=date('l, F d, Y',strtotime($Today));
                            echo $new; ?></a>
                        
                    </li>
					<li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-shopping-cart'></span> Total Price Ordered: LKR <?php echo $total; ?> </b></a>
                       
                    </li>
										
                     <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_email; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
    <li><a data-toggle="modal" data-target="#setAccount" style="color: green;"><i class="fa fa-gear"></i> Settings</a></li>
    <li class="divider"></li>
    <li><a href="logout.php" style="color: red;"><i class="fa fa-power-off"></i> Log Out</a></li>
</ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            
			
			<div class="alert alert-default" style="color:white;background-color:#0f2453">
         <center><h3> <span class="glyphicon glyphicon-list-alt"></span> My Ordered Items</h3></center>
        </div>
			
			<br />
						  
						  <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Price</th>
				  <th>Quantity</th>
				  <th>Total</th>
                  
                 
                </tr>
              </thead>
              <tbody>
			  <?php
include("config.php");
 
	$stmt = $DB_con->prepare("SELECT * FROM orderdetails where  user_id='$user_id'");
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			
			
			?>
                <tr>
                  
                 <td><?php echo $order_name; ?></td>
				 <td>LKR <?php echo $order_price; ?> </td>
				 <td><?php echo $order_quantity; ?></td>
				 <td>LKR <?php echo $order_total; ?> </td>
				 
				 
                </tr>

               
              <?php
		}
		 include("config.php");
		  $stmt_edit = $DB_con->prepare("select sum(order_total) as totalx from orderdetails where user_id=:user_id and order_status='Ordered'");
		$stmt_edit->execute(array(':user_id'=>$user_id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		
		echo "<tr>";
		echo "<td colspan='3' align='right'>Total Price Ordered:";
		echo "</td>";
		
		echo "<td>LKR ".$totalx;
		echo "</td>";
		
		
		
		echo "</tr>";
        echo "<tr>";
        echo "<td colspan='4' align='right'>
        <a href='../homepage/admin/print.php?pid=" . $user_id . "' class='btn btn-success' id='print-link'>
            <i class='fa fa-print'></i> Print
        </a>
      </td>";
		echo "</tbody>";
		echo "</table>";
        
		echo "</div>";
		echo "<br />";
		echo '<div class="alert alert-default" style="background-color:#0f2453;">
                       <p style="color:white;text-align:center;">
                       &copy 2025 HERATH TILE SHOW ROOM | All Rights Reserved |  Design by : Dinitha

						</p>
                        
                    </div>
	</div>';
	
		echo "</div>";
	}
	else
	{
		?>
       <script>
    document.getElementById('print-link').addEventListener('click', function (event) {
        event.preventDefault();
        
        var printWindow = window.open(this.href, '_blank');

        if (printWindow) {
            printWindow.onload = function () {
                printWindow.print();
                printWindow.onafterprint = function () {
                    printWindow.close();
                };
            };
        } else {
            alert('Please allow pop-ups for this site to print the page.');
        }
    });
</script>


		
			
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Item Found ...
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
							
                                <input class="form-control" placeholder="Firstname" name="user_firstname" type="text" value="<?php  echo $user_firstname; ?>" required>
                           
							 
							</div>
														
							<p>Lastname:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Lastname" name="user_lastname" type="text" value="<?php  echo $user_lastname; ?>" required>
                           							 
							</div>
							
							<p>Address:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Address" name="user_address" type="text" value="<?php  echo $user_address; ?>" required>
                           							 
							</div>
							
							<p>Password:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Password" name="user_password" type="password" value="<?php  echo $user_password; ?>" required>
                           						 
							</div>
							
							<div class="form-group">
							
                                <input class="form-control hide" name="user_id" type="text" value="<?php  echo $user_id; ?>" required>
                           							 
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