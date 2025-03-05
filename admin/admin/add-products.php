<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { 
header('location:index.php');
}
else{
// Code for Add New Teacher
if(isset($_POST['submit'])){
//Getting Post Values  
$iname=$_POST['item_name'];
$iprice=$_POST['item_price'];
$iqty=$_POST['qty'];
$idate=$_POST['item_date'];
$iimage=$_FILES["ipic"]["name"];
// get the image extension
$extension = substr($iimage,strlen($iimage)-4,strlen($iimage));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
//rename the image file
$newpic=md5($iimage).time().$extension;
// Code for move image into directory
move_uploaded_file($_FILES["ipic"]["tmp_name"],"itempic/".$newpic);

$query=mysqli_query($con,"insert into items(item_name,item_price,item_image,qty,item_date) values('$iname','$iprice','$newpic','$iqty','$idate')");
if($query){
echo "<script>alert('Product added successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'add-products.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again.');</script>";
}
}
}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herath Tile Shop | Add Products</title>
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    
    <style>
        :root {
            --primary-color: #4a69bd;
            --secondary-color: #6a89cc;
            --light-bg: #f1f2f6;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .card-header {
            background: var(--primary-color);
            color: white;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            border-color: var(--secondary-color);
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Product</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-box-open me-2"></i>Product Details</h3>
              </div>
              
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-tag me-2"></i>Product Name
                        </label>
                        <input type="text" class="form-control" name="item_name" required placeholder="Enter Product Name">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-dollar-sign me-2"></i>Product Price
                        </label>
                        <input type="number" step="0.01" class="form-control" name="item_price" required placeholder="Enter Price">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-cubes me-2"></i>Quantity
                        </label>
                        <input type="number" class="form-control" name="qty" required placeholder="Enter Quantity">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-calendar-alt me-2"></i>Date Added
                        </label>
                        <input type="date" class="form-control" name="item_date" required>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-image me-2"></i>Product Image
                    </label>
                    <div class="input-group">
                        <input type="file" class="form-control" name="ipic" required>
                    </div>
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Only jpg, jpeg, png, gif formats are allowed
                    </small>
                  </div>
                </div>
                
                <div class="card-footer text-center">
                  <button type="submit" name="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i>Save Product
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include_once('includes/footer.php');?>
</div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
<?php } ?>