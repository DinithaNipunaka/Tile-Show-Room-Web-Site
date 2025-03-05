<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { 
header('location:index.php');
}
else{
// Code for Update  Sub Admin Details
if(isset($_POST['update'])){
$fname=$_POST['fullname'];
$email=$_POST['emailid'];
$mobileno=$_POST['mobilenumber'];
$subadminid=intval($_GET['said']);
$query=mysqli_query($con,"update login set AdminName='$fname',MobileNumber='$mobileno',Email='$email' where UserType=0 and ID='$subadminid'");
if($query){
echo "<script>alert('Sub admin details added successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'manage-subadmins.php'; </script>";
} else {
echo "<script>alert('Something went wron. Please try again.');</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Herath Tile Shop  | Edit/Update Sub admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!--Function Email Availabilty---->
  <style>
    :root {
      --primary-color: #3498db;
      --secondary-color: #2ecc71;
      --bg-color: #f4f6f7;
      --text-color: #2c3e50;
      --input-bg: #ecf0f1;
    }

    body {
      background-color: var(--bg-color);
      font-family: 'Source Sans Pro', sans-serif;
    }

    .content-wrapper {
      background-color: var(--bg-color);
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .card-header {
      background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
      color: white;
      padding: 15px;
      display: flex;
      align-items: center;
    }

    .card-header h3 {
      margin: 0;
      display: flex;
      align-items: center;
    }

    .card-header i {
      margin-right: 10px;
      font-size: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
      position: relative;
    }

    .form-control {
      border-radius: 10px;
      padding: 12px 15px;
      background-color: var(--input-bg);
      border: 1px solid transparent;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      background-color: white;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }

    .form-control[readonly] {
      background-color: #e9ecef;
      opacity: 1;
    }

    .form-label {
      font-weight: 600;
      color: var(--text-color);
      transition: color 0.3s ease;
    }

    .btn-primary {
      background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
      border: none;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
      transform: scale(1.05);
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .form-group {
      animation: slideIn 0.5s ease forwards;
      opacity: 0;
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }

    .breadcrumb {
      background: transparent;
      padding: 0.75rem 1rem;
    }

    .breadcrumb-item a {
      color: var(--primary-color);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
      color: var(--secondary-color);
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
            <h1>Edit Sub-Admin Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Subadmin Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php 
$said=intval($_GET['said']);
$query=mysqli_query($con,"select * from login where UserType=0 and ID='$said'");
$cnt=1;
while($result=mysqli_fetch_array($query)){
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update  the Info</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="subadmin" method="post">
                <div class="card-body">
<!-- Username-->
    <div class="form-group">
                    <label for="exampleInputusername">Username (used for login)</label>
               <input type="text"   name="sadminusername" id="sadminusername" class="form-control" value="<?php echo $result['AdminuserName'];?>" readonly>
                  </div>
<!-- Subadmin Full Name--->
   <div class="form-group">
                    <label for="exampleInputFullname">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $result['AdminName'];?>" placeholder="Enter Sub-Admin Full Name" required>
                  </div>
<!-- Sub admin Email---->
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Enter email" required value="<?php echo $result['Email'];?>">
                  </div>
<!-- Sub admin Contact Number---->
                  <div class="form-group">
                    <label for="text">Mobile Number</label>
                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Enter email" pattern="[0-9]{10}" title="10 numeric characters only" required value="<?php echo $result['MobileNumber'];?>">
                  </div>

<?php } ?>
      
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="update" id="update">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

        
       
          </div>
          <!--/.col (left) -->
  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('includes/footer.php');?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
<?php } ?>
