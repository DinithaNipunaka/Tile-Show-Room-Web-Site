<?php //error_reporting(0);
include('includes/config.php');

if(isset($_POST['resetpwd']))
  {
$uname=$_POST['username'];
$mobile=$_POST['mobileno'];
$newpassword=md5($_POST['newpassword']);
$sql =mysqli_query($con,"select id from login where AdminuserName='$uname' and MobileNumber='$mobile'");
$rowcount=mysqli_num_rows($sql);

if($rowcount >0)
{
$query=mysqli_query($con,"update login set Password='$newpassword' where AdminuserName='$uname' and MobileNumber='$mobile'");
if($query){
echo "<script>alert('Your Password succesfully changed');</script>";
echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
}
}}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Herath Tile Shop | Password Recovery</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <!-- Custom Styles -->
  <style>
    :root {
      --primary: #3b7ddd;
      --secondary: #6c757d;
      --success: #28a745;
      --danger: #dc3545;
      --warning: #ffc107;
      --info: #17a2b8;
      --light: #f8f9fa;
      --dark: #343a40;
    }
    
    body {
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      height: 100vh;
    }
    
    .login-box {
      max-width: 450px;
      margin-top: 5vh;
    }
    
    .card {
      border-radius: 15px;
      box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
      overflow: hidden;
      transition: all 0.3s ease;
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 18px 35px rgba(50, 50, 93, 0.1), 0 8px 15px rgba(0, 0, 0, 0.07);
    }
    
    .card-header {
      background: linear-gradient(135deg, var(--primary) 0%, #2d5ca8 100%);
      padding: 1.5rem 0;
      border-bottom: none;
    }
    
    .card-header a {
      color: white;
      text-decoration: none;
      font-weight: 300;
      transition: all 0.3s ease;
    }
    
    .card-header a b {
      font-weight: 600;
    }
    
    .card-header a:hover {
      opacity: 0.8;
    }
    
    .card-body {
      padding: 2rem;
    }
    
    .login-box-msg {
      font-size: 1.2rem;
      margin-bottom: 1.5rem;
      color: var(--dark);
      text-align: center;
      font-weight: 500;
    }
    
    .input-group {
      margin-bottom: 1.5rem !important;
    }
    
    .input-group-text {
      background-color: var(--primary);
      color: white;
      border: none;
      border-radius: 0 5px 5px 0;
      width: 40px;
      justify-content: center;
    }
    
    .form-control {
      border-radius: 5px 0 0 5px;
      border: 1px solid #ced4da;
      padding: 0.6rem 1rem;
      height: auto;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(59, 125, 221, 0.25);
      border-color: var(--primary);
    }
    
    .btn-primary {
      background: linear-gradient(135deg, var(--primary) 0%, #2d5ca8 100%);
      border: none;
      border-radius: 5px;
      padding: 0.6rem 1rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
      background: linear-gradient(135deg, #2d5ca8 0%, var(--primary) 100%);
      transform: translateY(-2px);
      box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
    }
    
    .btn-block {
      width: 100%;
    }
    
    .mb-1 a {
      color: var(--primary);
      text-decoration: none;
      transition: all 0.3s ease;
      display: inline-block;
      margin-top: 1rem;
      font-weight: 500;
    }
    
    .mb-1 a:hover {
      color: #2d5ca8;
      transform: translateX(5px);
    }
    
    .form-title {
      position: relative;
      display: inline-block;
      margin-bottom: 1rem;
    }
    
    .form-title:after {
      content: '';
      position: absolute;
      width: 50%;
      height: 3px;
      background: var(--primary);
      bottom: -10px;
      left: 25%;
      border-radius: 2px;
    }
    
    .password-feedback {
      height: 5px;
      margin-top: -15px;
      margin-bottom: 15px;
      border-radius: 3px;
      transition: all 0.3s ease;
    }
    
    /* Animation classes */
    .slide-up {
      animation: slideUp 0.5s ease forwards;
    }
    
    @keyframes slideUp {
      0% {
        transform: translateY(20px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .login-box {
        width: 90%;
        margin: 2rem auto;
      }
    }
  </style>
  
  <script type="text/javascript">
  function valid() {
    if(document.passwordrecovery.newpassword.value != document.passwordrecovery.confirmpassword.value) {
      alert("New Password and Confirm Password Field do not match  !!");
      document.passwordrecovery.confirmpassword.focus();
      return false;
    }
    return true;
  }
  
  function checkPasswordStrength() {
    var password = document.getElementById('newpassword').value;
    var strengthBar = document.getElementById('password-strength');
    
    // Reset the strength bar
    strengthBar.style.width = '0%';
    strengthBar.className = 'password-feedback';
    
    if (password.length === 0) {
      return;
    }
    
    // Calculate strength
    var strength = 0;
    if (password.length > 6) strength += 20;
    if (password.length > 10) strength += 20;
    if (password.match(/[a-z]+/)) strength += 20;
    if (password.match(/[A-Z]+/)) strength += 20;
    if (password.match(/[0-9]+/)) strength += 20;
    
    // Set the strength bar width and color
    strengthBar.style.width = strength + '%';
    
    if (strength < 40) {
      strengthBar.style.backgroundColor = '#dc3545'; // Weak
    } else if (strength < 80) {
      strengthBar.style.backgroundColor = '#ffc107'; // Medium
    } else {
      strengthBar.style.backgroundColor = '#28a745'; // Strong
    }
  }
  </script>
</head>

<body class="hold-transition login-page">
  <div class="login-box animate__animated animate__fadeIn">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary animate__animated animate__zoomIn animate__delay-1s">
      <div class="card-header text-center">
        <a href="../index.php" class="h1"><b>Admin</b> | Herath Tile Shop</a>
      </div>
      <div class="card-body">
        <h4 class="login-box-msg form-title">Reset Your Password</h4>
        
        <form name="passwordrecovery" method="post" onSubmit="return valid();" class="slide-up">
          <div class="input-group animate__animated animate__fadeInUp animate__delay-1s">
            <input type="text" class="form-control" placeholder="Username" name="username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          
          <div class="input-group animate__animated animate__fadeInUp animate__delay-2s">
            <input type="text" class="form-control" placeholder="Mobile Number" name="mobileno" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-mobile-alt"></span>
              </div>
            </div>
          </div>

          <div class="input-group animate__animated animate__fadeInUp animate__delay-3s">
            <input type="password" class="form-control" placeholder="New Password" name="newpassword" id="newpassword" required onkeyup="checkPasswordStrength()">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          
          <div id="password-strength" class="password-feedback"></div>

          <div class="input-group animate__animated animate__fadeInUp animate__delay-4s">
            <input type="password" class="form-control" placeholder="Confirm Password" name="confirmpassword" id="confirmpassword" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-key"></span>
              </div>
            </div>
          </div>

          <div class="row animate__animated animate__fadeInUp animate__delay-5s">
            <div class="col-7">
              <p class="mb-1">
                <a href="index.php" class="text-center">
                  <i class="fas fa-arrow-left mr-2"></i>Back to Login
                </a>
              </p>
            </div>
            <!-- /.col -->
            <div class="col-5">
              <button type="submit" class="btn btn-primary btn-block" name="resetpwd">
                Reset Password <i class="fas fa-sync-alt ml-2"></i>
              </button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  
  <script>
  $(document).ready(function() {
    // Add focus animation to input fields
    $('.form-control').focus(function() {
      $(this).parent().addClass('animate__animated animate__pulse');
    }).blur(function() {
      $(this).parent().removeClass('animate__animated animate__pulse');
    });
    
    // Button hover effect
    $('.btn-primary').hover(
      function() { $(this).addClass('animate__animated animate__pulse'); },
      function() { $(this).removeClass('animate__animated animate__pulse'); }
    );
  });
  </script>
</body>
</html>