<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
{ 
header('location:index.php');
}
else{
// Code for Update Sub Admin Details
if(isset($_POST['update'])){
$fname=$_POST['fullname'];
$email=$_POST['emailid'];
$mobileno=$_POST['mobilenumber'];
$adminid=intval($_SESSION['aid']);
$query=mysqli_query($con,"update login set AdminName='$fname',MobileNumber='$mobileno',Email='$email' where ID='$adminid'");
if($query){
echo "<script>alert('Profile details updated successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
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
    <title>Herath Tile Shop | My Profile</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    
    <style>
        :root {
            --primary-color: #4a69bd;
            --secondary-color: #6a89cc;
            --light-bg: #f1f2f6;
        }

        .profile-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 30px;
            transition: transform 0.3s ease;
        }

        .profile-container:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: var(--primary-color);
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            padding: 12px 24px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-3px);
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
            <h1>My Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Profile</li>
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
                <h3 class="card-title"><i class="fas fa-user-edit me-2"></i>Update Profile Information</h3>
              </div>
              
              <?php 
              $adminid=intval($_SESSION['aid']);
              $query=mysqli_query($con,"select * from login where ID='$adminid'");
              while($result=mysqli_fetch_array($query)){
              ?>
              
              <form name="subadmin" method="post">
                <div class="card-body">
                  <div class="row g-3">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">
                            <i class="fas fa-user me-2"></i>Username
                        </label>
                        <input type="text" name="sadminusername" class="form-control" 
                               value="<?php echo $result['AdminuserName'];?>" readonly>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label class="form-label">
                            <i class="fas fa-id-card me-2"></i>Full Name
                        </label>
                        <input type="text" class="form-control" name="fullname" 
                               value="<?php echo $result['AdminName'];?>" required>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <input type="email" class="form-control" name="emailid" 
                               value="<?php echo $result['Email'];?>" required>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label class="form-label">
                            <i class="fas fa-phone me-2"></i>Mobile Number
                        </label>
                        <input type="text" class="form-control" name="mobilenumber" 
                               pattern="[0-9]{10}" maxlength="10" 
                               value="<?php echo $result['MobileNumber'];?>" required>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label class="form-label">
                            <i class="fas fa-calendar-alt me-2"></i>Registration Date
                        </label>
                        <input type="text" class="form-control" 
                               value="<?php echo $result['AdminRegdate'];?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" name="update" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Profile
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
<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
<?php } ?>