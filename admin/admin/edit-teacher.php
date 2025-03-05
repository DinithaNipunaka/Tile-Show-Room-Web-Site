<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
{ 
header('location:index.php');
}
else{
// Code for update product details
if(isset($_POST['submit'])){
$iname=$_POST['item_name'];
$iprice=$_POST['item_price'];
$iqty=$_POST['qty'];
$idate=$_POST['item_date'];
$itemid=intval($_GET['tid']);

$query=mysqli_query($con,"update items set item_name='$iname',item_price='$iprice',qty='$iqty',item_date='$idate' where item_id='$itemid'");
if($query){
echo "<script>alert('Product details updated successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'manage-products.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again.');</script>";
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Herath Tile Shop | Edit Product</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <style>
    .product-image {
      max-width: 200px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }
    .product-image:hover {
      transform: scale(1.05);
    }
    .image-update-link {
      display: inline-flex;
      align-items: center;
      color: #007bff;
      text-decoration: none;
      margin-top: 10px;
    }
    .image-update-link:hover {
      color: #0056b3;
    }
    .image-update-link i {
      margin-right: 5px;
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
            <h1>Edit Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="manage-products.php">Products</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
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
                <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Edit Product Details</h3>
              </div>
              
              <?php
              $itemid=intval($_GET['tid']);
              $query=mysqli_query($con,"select * from items where item_id='$itemid'");
              while($result=mysqli_fetch_array($query)){
              ?>
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="item_name" 
                               value="<?php echo $result['item_name']?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.01" class="form-control" 
                               name="item_price" value="<?php echo $result['item_price']?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="qty" 
                               value="<?php echo $result['qty']?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Date Added</label>
                        <input type="date" class="form-control" name="item_date" 
                               value="<?php echo $result['item_date']?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Current Image</label>
                    <div class="d-block">
                      <img src="itempic/<?php echo $result['item_image']?>" 
                           class="product-image mb-2" alt="Product Image">
                      <br>
                      <a href="update-product-pic.php?tid=<?php echo $result['item_id'];?>" 
                         class="image-update-link">
                        <i class="fas fa-sync-alt"></i>Update Product Image
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button type="submit" name="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>Update Product
                  </button>
                </div>
              </form>
              <?php } ?>
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
<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Set max date to today
  const dateInput = document.querySelector('input[name="item_date"]');
  const today = new Date().toISOString().split('T')[0];
  dateInput.setAttribute('max', today);

  // Form validation
  const form = document.querySelector('form');
  form.addEventListener('submit', function(e) {
    const price = document.querySelector('input[name="item_price"]');
    const qty = document.querySelector('input[name="qty"]');
    
    if (parseFloat(price.value) < 0) {
      alert('Price cannot be negative');
      e.preventDefault();
      price.focus();
      return false;
    }
    
    if (parseInt(qty.value) < 0) {
      alert('Quantity cannot be negative');
      e.preventDefault();
      qty.focus();
      return false;
    }
  });
});
</script>
</body>
</html>
<?php } ?>