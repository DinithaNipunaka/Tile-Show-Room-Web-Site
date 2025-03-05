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

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

   <style>
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
					<li><a href="orders.php"> &nbsp; <span class='glyphicon glyphicon-list-alt'></span> My Ordered Items</a></li>
					<li class="active"><a href="view_purchased.php"> &nbsp; <span class='glyphicon glyphicon-eye-open'></span> Previous Items Ordered</a></li>
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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-shopping-cart'></span> Total Price Ordered:LKR  <?php echo $total; ?> </b></a>
                       
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
         <center><h3> <span class="glyphicon glyphicon-eye-open"></span> Previous Items Ordered</h3></center>
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
 
	$stmt = $DB_con->prepare("SELECT * FROM orderdetails where order_status='Ordered_Finished' and user_id='$user_id'");
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			
			
			?>
                <tr>
                  
                 <td><?php echo $order_name; ?></td>
				 <td><?php echo $order_price; ?> </td>
				 <td><?php echo $order_quantity; ?></td>
				 <td><?php echo $order_total; ?> </td>
				 
				 
                </tr>

               
              <?php
		}
		
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "<br />";
		echo '<div class="alert alert-default" style="background-color:#0f2453;">
                       <p style="color:white;text-align:center;">
                       &copy 2023 HERATH TILE SHOW ROOM | All Rights Reserved |  Design by : Webwired Team

						</p>
                        
                    </div>
	</div>';
	
		echo "</div>";
	}
	else
	{
		?>
		
			
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
