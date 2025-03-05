<?php
session_start();
include('includes/config.php');

if(isset($_POST['login']))
  {
    $uname=$_POST['username'];
    $Password=md5($_POST['inputpwd']);
    $query=mysqli_query($con,"select ID,AdminuserName,UserType from login where  AdminuserName='$uname' && Password='$Password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['aid']=$ret['ID'];
      $_SESSION['uname']=$ret['AdminuserName'];
      $_SESSION['utype']=$ret['UserType'];
     header('location:dashboard.php');
    }
    else{
    echo "<script>alert('Invalid Details.');</script>";          
    }
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Herath Tile Shop | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Additional Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  
  <style>
    body {
      font-family: 'Poppins', 'Source Sans Pro', sans-serif;
      background: linear-gradient(135deg, #2c3e50, #3498db);
      height: 100vh;
      overflow: hidden;
    }
    
    #abcd {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    
    .login-box {
      width: 400px;
      margin-top: -30px;
    }
    
    .card {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
      transform: translateY(0);
      transition: all 0.5s ease;
      border: none;
      animation: fadeInDown 1s;
    }
    
    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }
    
    .card-outline {
      border-top: 3px solid #4e73df;
    }
    
    .card-header {
      background: linear-gradient(135deg, #4e73df, #224abe);
      color: white;
      padding: 20px;
      border-bottom: none;
    }
    
    .card-header a {
      color: white;
      font-weight: 600;
      font-size: 1.5rem;
      text-decoration: none;
      transition: all 0.3s ease;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }
    
    .card-header a:hover {
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
      transform: scale(1.02);
    }
    
    .card-body {
      padding: 30px;
      background: #fff;
    }
    
    .login-box-msg {
      color: #4e73df;
      font-weight: 500;
      font-size: 1.1rem;
      margin-bottom: 20px;
      text-align: center;
    }
    
    .input-group {
      margin-bottom: 25px !important;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      border-radius: 10px;
      overflow: hidden;
      transition: all 0.3s ease;
    }
    
    .input-group:focus-within {
      box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
      transform: translateY(-3px);
    }
    
    .form-control {
      border: none;
      padding: 12px 15px;
      height: auto;
      font-size: 0.95rem;
      background-color: #f8f9fc;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      background-color: #fff;
      box-shadow: none;
    }
    
    .input-group-text {
      background-color: #4e73df;
      border: none;
      color: white;
      padding: 0 20px;
    }
    
    .input-group-text .fas {
      font-size: 1.1rem;
    }
    
    .btn-primary {
      background: linear-gradient(135deg, #4e73df, #224abe);
      border: none;
      box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
      padding: 10px 15px;
      border-radius: 10px;
      font-weight: 600;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
      background: linear-gradient(135deg, #224abe, #4e73df);
      box-shadow: 0 8px 20px rgba(78, 115, 223, 0.4);
      transform: translateY(-3px);
    }
    
    .btn-primary:active {
      transform: translateY(0);
    }
    
    a {
      color: #4e73df;
      transition: all 0.3s ease;
      font-weight: 500;
    }
    
    a:hover {
      color: #224abe;
      text-decoration: none;
    }
    
    .mb-1 {
      text-align: center;
      margin-top: 20px;
    }
    
    .tile-icon {
      display: block;
      margin: 0 auto 20px;
      font-size: 40px;
      text-align: center;
      color: #4e73df;
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0% {
        transform: scale(1);
        opacity: 1;
      }
      50% {
        transform: scale(1.1);
        opacity: 0.8;
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }
    
    .form-footer {
      text-align: center;
      margin-top: 15px;
      color: #6c757d;
      font-size: 0.9rem;
    }
    
    /* Entry animations */
    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .animate-delay-1 {
      animation-delay: 0.2s;
    }
    
    .animate-delay-2 {
      animation-delay: 0.4s;
    }
    
    .animate-delay-3 {
      animation-delay: 0.6s;
    }
  </style>
</head>
<body class="hold-transition login-page" id="abcd">
<div class="login-box animate__animated animate__fadeIn">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <i class="fas fa-store tile-icon"></i>
      <a href="../index.php" class="h1"><b>Admin</b> |  Herath Tile Shop</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg animate__animated animate__fadeInUp animate-delay-1">Sign in to start your session</p>

      <form method="post" class="animate__animated animate__fadeInUp animate-delay-2">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="inputpwd" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
   
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1 animate__animated animate__fadeInUp animate-delay-3">
        <a href="password-recovery.php">I forgot my password</a>
      </p>
      
      <div class="form-footer animate__animated animate__fadeInUp animate-delay-3">
        <small>&copy; 2025 Herath Tile Shop. All rights reserved.</small>
      </div>

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
    // Add a subtle hover effect to input fields
    $('.form-control').hover(function() {
      $(this).parent('.input-group').css('transform', 'translateY(-2px)');
    }, function() {
      $(this).parent('.input-group').css('transform', 'translateY(0)');
    });
    
    // Add button press animation
    $('.btn').mousedown(function() {
      $(this).css('transform', 'scale(0.95)');
    });
    
    $('.btn').mouseup(function() {
      $(this).css('transform', 'scale(1)');
    });
  });
</script>
</body>
</html>