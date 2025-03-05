<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { header('location:index.php');
}
else{
// Code for Add New Sub Admi
if(isset($_POST['submit'])){
$username=$_POST['sadminusername'];
$fname=$_POST['fullname'];
$email=$_POST['emailid'];
$mobileno=$_POST['mobilenumber'];
$password=md5($_POST['inputpwd']);
$usertype='0';
$query=mysqli_query($con,"insert into login(AdminuserName,AdminName,MobileNumber,Email,Password,UserType ) values('$username','$fname','$mobileno','$email','$password','$usertype')");
if($query){
echo "<script>alert('Sub admin details added successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'add-subadmin.php'; </script>";
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
  <title>PreSchool Enrollment System  | Add Sub admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!--Function Email Availabilty---->
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'username='+$("#sadminusername").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
<style>
    :root {
      --primary-color: #3498db;
      --secondary-color: #2ecc71;
      --bg-color: #f4f6f7;
      --text-color: #2c3e50;
    }

    body {
      background-color: var(--bg-color);
      font-family: 'Source Sans Pro', sans-serif;
      color: var(--text-color);
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
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
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
    .form-group:nth-child(5) { animation-delay: 0.5s; }

    #user-availability-status {
      position: absolute;
      bottom: -20px;
      left: 0;
      font-size: 0.8rem;
    }

    .input-group-text {
      background-color: transparent;
      border: none;
      color: var(--primary-color);
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
            <h1>Create Sub-Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Subadmin</li>
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
                <h3 class="card-title">
                  <i class="fas fa-user-plus"></i> 
                  Fill Sub-Admin Information
                </h3>
              </div>
              
              <form name="subadmin" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputusername">
                      <i class="fas fa-user me-2"></i> 
                      Username (used for login)
                    </label>
                    <input type="text" placeholder="Enter Sub-Admin Username" name="sadminusername" id="sadminusername" 
                           class="form-control" 
                           pattern="^[a-zA-Z][a-zA-Z0-9-_.]{5,12}$" 
                           title="Username must be alphanumeric 6 to 12 chars" 
                           onBlur="checkAvailability()" required>
                    <span id="user-availability-status" style="color: red;"></span>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFullname">
                      <i class="fas fa-id-badge me-2"></i>
                      Full Name
                    </label>
                    <input type="text" class="form-control" id="fullname" name="fullname" 
                           placeholder="Enter Sub-Admin Full Name" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">
                      <i class="fas fa-envelope me-2"></i>
                      Email address
                    </label>
                    <input type="email" class="form-control" id="emailid" name="emailid" 
                           placeholder="Enter email" required>
                  </div>

                  <div class="form-group">
                    <label for="text">
                      <i class="fas fa-phone me-2"></i>
                      Mobile Number
                    </label>
                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" 
                           placeholder="Enter mobile number" pattern="[0-9]{10}" 
                           title="10 numeric characters only" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">
                      <i class="fas fa-lock me-2"></i>
                      Password
                    </label>
                    <input type="password" class="form-control" id="inputpwd" name="inputpwd" 
                           placeholder="Password" required>
                  </div>
                </div>
                
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-success" name="submit" id="submit">
                    <i class="fas fa-paper-plane me-2"></i>
                    Submit
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

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Existing scripts -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="../dist/js/demo.js"></script>

<script>
function checkAvailability() {
  $("#loaderIcon").show();
  jQuery.ajax({
    url: "check_availability.php",
    data:'username='+$("#sadminusername").val(),
    type: "POST",
    success:function(data){
      $("#user-availability-status").html(data);
      $("#loaderIcon").hide();
    },
    error:function (){}
  });
}

$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
<?php } ?>
