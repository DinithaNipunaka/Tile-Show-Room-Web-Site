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
	<title>Herath Tile Show Room</title>
	<link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="jquery.fancybox.css?v=2.1.5" media="screen" />
	<link rel="stylesheet" type="text/css" href="jquery.fancybox-buttons.css?v=1.0.5" />
	<link rel="stylesheet" type="text/css" href="jquery.fancybox-thumbs.css?v=1.0.7" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	
	<style>
		:root {
			--primary-color: #0f2453;
			--secondary-color:rgb(26, 75, 188);
			--accent-color: #e74c3c;
			--light-color: #ecf0f1;
			--dark-color: #2c3e50;
		}
		
		body {
			font-family: 'Poppins', sans-serif;
			background-color: #f8f9fa;
			padding-top: 56px;
		}
		
		#wrapper {
			display: flex;
			min-height: 100vh;
		}
		
		/* Sidebar styles */
		.sidebar {
			background: var(--primary-color);
			min-width: 250px;
			transition: all 0.4s;
			height: 100vh;
			position: fixed;
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
			z-index: 1000;
		}
		
		.sidebar .logo-container {
			padding: 20px 15px;
			background: var(--dark-color);
		}
		
		.sidebar .logo-container h3 {
			color: white;
			margin: 0;
			font-weight: 700;
		}
		
		.sidebar .nav-link {
			color: rgba(255, 255, 255, 0.8);
			padding: 15px 20px;
			margin: 4px 0;
			border-radius: 0 30px 30px 0;
			transition: all 0.3s;
		}
		
		.sidebar .nav-link:hover, .sidebar .nav-link.active {
			background: var(--secondary-color);
			color: white;
			transform: translateX(5px);
		}
		
		.sidebar .nav-link i {
			margin-right: 10px;
			width: 25px;
			text-align: center;
		}
		
		/* Main content wrapper */
		#page-wrapper {
			width: calc(100% - 250px);
			margin-left: 250px;
			padding: 20px;
			transition: all 0.4s;
		}
		
		/* Header */
		.top-navbar {
			background: var(--primary-color);
			padding: 0.5rem 1rem;
			position: fixed;
			width: 100%;
			top: 0;
			z-index: 1030;
		}
		
		.top-navbar .navbar-brand {
			color: white;
			font-weight: 700;
		}
		
		.top-navbar .navbar-nav .nav-link {
			color: rgba(255, 255, 255, 0.8);
			padding: 0.5rem 1rem;
			transition: all 0.3s;
		}
		
		.top-navbar .navbar-nav .nav-link:hover {
			color: var(--secondary-color);
		}
		
		/* Card styling */
		.product-card {
			border: none;
			transition: all 0.3s ease;
			border-radius: 10px;
			overflow: hidden;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
			margin-bottom: 25px;
			height: 100%;
		}
		
		.product-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
		}
		
		.product-card .card-header {
			background: var(--primary-color);
			color: white;
			padding: 15px;
			text-align: center;
			border-bottom: none;
		}
		
		.product-card .card-body {
			padding: 20px;
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		
		.product-card .card-title {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			width: 100%;
			background-color: white;
			border: none;
			color: var(--primary-color);
			font-weight: 600;
			text-align: center;
			resize: none;
		}
		
		.product-card .product-image {
			width: 100%;
			height: 180px;
			object-fit: cover;
			border-radius: 5px;
			margin-bottom: 15px;
			transition: all 0.3s ease;
		}
		
		.product-card .product-image:hover {
			transform: scale(1.03);
		}
		
		.product-card .price {
			font-size: 1.2rem;
			color: var(--accent-color);
			font-weight: 700;
			margin: 10px 0;
		}
		
		.product-card .btn-cart {
			background: var(--primary-color);
			color: white;
			border: none;
			width: 100%;
			padding: 10px;
			border-radius: 5px;
			font-weight: 600;
			transition: all 0.3s;
		}
		
		.product-card .btn-cart:hover {
			background: var(--secondary-color);
			transform: translateY(-2px);
		}
		
		.product-card .btn-cart i {
			margin-right: 8px;
		}
		
		/* Pagination */
		.pagination {
			margin-top: 30px;
			justify-content: center;
		}
		
		.pagination .page-item .page-link {
			color: var(--primary-color);
			padding: 10px 18px;
			margin: 0 5px;
			border-radius: 5px;
			transition: all 0.3s;
		}
		
		.pagination .page-item.active .page-link {
			background-color: var(--primary-color);
			border-color: var(--primary-color);
		}
		
		.pagination .page-item .page-link:hover {
			background-color: var(--primary-color);
			color: white;
		}
		
		.pager .btn-pager {
			background: var(--primary-color);
			color: white;
			padding: 8px 20px;
			border-radius: 30px;
			transition: all 0.3s;
		}
		
		.pager .btn-pager:hover {
			background: var(--secondary-color);
			transform: translateY(-2px);
		}
		
		/* Modal */
		.modal-content {
			border-radius: 10px;
			overflow: hidden;
		}
		
		.modal-header {
			background: var(--primary-color);
			color: white;
			border-bottom: none;
		}
		
		.modal-footer {
			border-top: none;
			padding: 20px;
		}
		
		.btn-success {
			background: var(--secondary-color);
			border: none;
			transition: all 0.3s;
		}
		
		.btn-success:hover {
			background: #16a085;
			transform: translateY(-2px);
		}
		
		.btn-danger {
			background: var(--accent-color);
			border: none;
			transition: all 0.3s;
		}
		
		.btn-danger:hover {
			background: #c0392b;
			transform: translateY(-2px);
		}
		
		.form-control {
			padding: 12px;
			border-radius: 5px;
			margin-bottom: 15px;
		}
		
		.form-control:focus {
			border-color: var(--secondary-color);
			box-shadow: 0 0 0 0.25rem rgba(26, 188, 156, 0.25);
		}
		
		/* Footer */
		.footer {
			background: var(--primary-color);
			color: white;
			text-align: center;
			padding: 20px;
			margin-top: 30px;
			border-radius: 10px;
		}
		
		/* Animations */
		.fadeIn {
			animation: fadeIn 0.5s ease-in-out;
		}
		
		@keyframes fadeIn {
			from {
				opacity: 0;
				transform: translateY(10px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
		
		.page-title {
			position: relative;
			padding-bottom: 10px;
			margin-bottom: 30px;
			text-align: center;
			color: var(--primary-color);
		}
		
		.page-title:after {
			content: '';
			position: absolute;
			width: 50px;
			height: 3px;
			background: var(--secondary-color);
			bottom: 0;
			left: 50%;
			transform: translateX(-50%);
		}
	</style>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="jquery.fancybox.js?v=2.1.5"></script>
	<script type="text/javascript" src="jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="jquery.fancybox-media.js?v=1.0.6"></script>

	<script type="text/javascript">
		$(document).ready(function () {
			// Fancybox initialization
			$('.fancybox').fancybox({
				openEffect: 'elastic',
				closeEffect: 'elastic',
				padding: 0
			});

			// Effects
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title: {
						type: 'outside'
					},
					overlay: {
						speedOut: 0
					}
				}
			});

			$(".fancybox-effects-b").fancybox({
				openEffect: 'none',
				closeEffect: 'none',
				helpers: {
					title: {
						type: 'over'
					}
				}
			});

			$(".fancybox-effects-c").fancybox({
				wrapCSS: 'fancybox-custom',
				closeClick: true,
				openEffect: 'none',
				helpers: {
					title: {
						type: 'inside'
					},
					overlay: {
						css: {
							'background': 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			$(".fancybox-effects-d").fancybox({
				padding: 0,
				openEffect: 'elastic',
				openSpeed: 150,
				closeEffect: 'elastic',
				closeSpeed: 150,
				closeClick: true,
			});

			$('.fancybox-buttons').fancybox({
				openEffect: 'none',
				closeEffect: 'none',
				prevEffect: 'none',
				nextEffect: 'none',
				closeBtn: false,
				helpers: {
					title: {
						type: 'inside'
					},
					buttons: {}
				},
				afterLoad: function () {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});

			$('.fancybox-thumbs').fancybox({
				prevEffect: 'none',
				nextEffect: 'none',
				closeBtn: false,
				arrows: false,
				nextClick: true,
				helpers: {
					thumbs: {
						width: 50,
						height: 50
					}
				}
			});

			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect: 'none',
					closeEffect: 'none',
					prevEffect: 'none',
					nextEffect: 'none',
					arrows: false,
					helpers: {
						media: {},
						buttons: {}
					}
				});

			// Animation on scroll
			$(window).scroll(function() {
				$('.product-card').each(function() {
					const position = $(this).offset().top;
					const scroll = $(window).scrollTop();
					const windowHeight = $(window).height();
					if (scroll > position - windowHeight + 100) {
						$(this).addClass('animate__animated animate__fadeInUp');
					}
				});
			});
			
			// Initially trigger scroll for items in view
			$(window).trigger('scroll');
		});
	</script>
</head>

<body>
	<div id="wrapper">
		<!-- Top Navbar -->
		<nav class="navbar navbar-expand-lg top-navbar">
			<div class="container-fluid">
				<a class="navbar-brand d-lg-none" href="#">Herath Tile Show Room</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item">
							<a class="nav-link" href="#">
								<i class="fa fa-calendar"></i>
								<?php
                                $Today=date('y:m:d');
                                $new=date('l, F d, Y',strtotime($Today));
                                echo $new; ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">
								<i class="fa fa-shopping-cart"></i> Total: LKR <?php echo $total; ?>
							</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
								<i class="fa fa-user-circle"></i> <?php echo $user_email; ?>
							</a>
							<ul class="dropdown-menu dropdown-menu-end">
							<li>
  <a class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#setAccount">
    <i class="fa fa-gear"></i> Settings
  </a>
</li>
								<li><hr class="dropdown-divider"></li>
								<li>
  <a class="dropdown-item text-danger" href="logout.php">
    <i class="fa fa-sign-out-alt"></i> Log Out
  </a>
</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Sidebar -->
		<nav class="sidebar d-none d-lg-block">
			<div class="logo-container">
				<h3 class="text-center">Herath Tile</h3>
			</div>
			<ul class="nav flex-column mt-3">
				<li class="nav-item">
  <a class="nav-link text-success fw-bold" href="../Customers/index.php">
    <i class="fas fa-home"></i> Home
  </a>
</li>

				<li class="nav-item">
					<a class="nav-link active" href="shop.php?id=1">
						<i class="fas fa-shopping-cart"></i> Shop Now
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="cart_items.php">
						<i class="fas fa-cart-plus"></i> Shopping Cart
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="orders.php">
						<i class="fas fa-list-alt"></i> My Orders
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="view_purchased.php">
						<i class="fas fa-history"></i> Order History
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="modal" data-bs-target="#setAccount">
						<i class="fas fa-cog"></i> Account Settings
					</a>
				</li>
				<li class="nav-item">
    <a class="nav-link text-danger fw-bold" href="logout.php">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</li>


			</ul>
		</nav>

		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid fadeIn">
				<h2 class="page-title"><i class="fas fa-th-large"></i> Our Tile Collection</h2>

				<div class="row">
					<?php
					$conn=mysqli_connect("localhost","root","");
					mysqli_select_db($conn,"tile");

					$start=0;
					$limit=8;

					if(isset($_GET['id']))
					{
						$id=$_GET['id'];
						$start=($id-1)*$limit;
					}

					$query=mysqli_query($conn,"select * from items LIMIT $start, $limit");

					while ($query2 = mysqli_fetch_array($query)) {
						$imagePath = "../../admin/admin/itempic/" . $query2['item_image'];

						// Debugging: Check if the image exists
						if (!file_exists($imagePath)) {
							$imageTag = "<p class='text-danger'>Image not found</p>";
						} else {
							$imageTag = "<img src='$imagePath' class='product-image img-fluid' />";
						}

						echo "<div class='col-sm-6 col-md-4 col-lg-3 mb-4'>
								<div class='card product-card'>
									<div class='card-header'>
										<textarea class='card-title form-control' rows='1' disabled>".$query2['item_name']."</textarea>
									</div>
									<div class='card-body'>
										<a class='fancybox-buttons' href='$imagePath' data-fancybox-group='button' title='Page ".$query2['item_id']." - ".$query2['item_name']."'>
											$imageTag
										</a>
										<h4 class='price'> LKR ".$query2['item_price']." </h4>
										<a class='btn btn-cart' href='add_to_cart.php?cart=".$query2['item_id']."'>
											<i class='fas fa-cart-plus'></i> Add to cart
										</a>
									</div>
								</div>
							</div>";
					}
					?>
				</div>

				<?php
				$rows=mysqli_num_rows(mysqli_query($conn,"select * from items"));
				$total=ceil($rows/$limit);
				
				echo "<div class='pager d-flex justify-content-center gap-3 mb-4'>";
				if($id>1)
				{
					echo "<a class='btn btn-pager' href='?id=".($id-1)."'><i class='fas fa-arrow-left'></i> Previous</a>";
				}
				if($id!=$total)
				{
					echo "<a class='btn btn-pager' href='?id=".($id+1)."'>Next <i class='fas fa-arrow-right'></i></a>";
				}
				echo "</div>";

				echo "<ul class='pagination'>";
				for($i=1;$i<=$total;$i++)
				{
					if($i==$id) { 
						echo "<li class='page-item active'><a class='page-link'>".$i."</a></li>"; 
					}
					else { 
						echo "<li class='page-item'><a class='page-link' href='?id=".$i."'>".$i."</a></li>"; 
					}
				}
				echo "</ul>";
				?>

				<div class="footer">
					<p>
						&copy; 2025 HERATH TILE SHOW ROOM | All Rights Reserved | Design by : Dinitha
					</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Account Settings Modal -->
	<div class="modal fade" id="setAccount" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="accountModalLabel">Account Settings</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form enctype="multipart/form-data" method="post" action="settings.php">
						<div class="mb-3">
							<label for="user_firstname" class="form-label">Firstname</label>
							<input type="text" class="form-control" id="user_firstname" name="user_firstname" value="<?php echo $user_firstname; ?>" required>
						</div>
						
						<div class="mb-3">
							<label for="user_lastname" class="form-label">Lastname</label>
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
						
						<input class="form-control d-none" name="user_id" type="text" value="<?php echo $user_id; ?>" required>
						
						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-success" name="user_save">
								<i class="fas fa-save"></i> Save Changes
							</button>
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal">
								<i class="fas fa-times"></i> Cancel
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function () {
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