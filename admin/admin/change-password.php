<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
{ header('location:index.php');
}
else{
// Code for change Password
if(isset($_POST['change'])){
$admid=$_SESSION['aid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$query=mysqli_query($con,"select ID from login where ID='$admid' and Password='$cpassword'");
$row=mysqli_fetch_array($query);
if($row>0){
$ret=mysqli_query($con,"update login set Password='$newpassword' where ID='$admid'");
echo '<script>alert("Your password successfully changed.")</script>';
} else {
echo '<script>alert("Your current password is wrong.")</script>';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Herath Tile Shop | Change Password</title>

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
        }

        .password-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 30px;
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

        .password-strength {
            font-size: 0.8rem;
            margin-top: 5px;
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
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Change Password</li>
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
                <h3 class="card-title"><i class="fas fa-lock me-2"></i>Change Your Password</h3>
              </div>
              
              <form method="post" name="changepassword" onsubmit="return checkpass();">  
                <div class="card-body">
                  <div class="row g-3">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">
                            <i class="fas fa-key me-2"></i>Current Password
                        </label>
                        <input class="form-control" name="currentpassword" type="password" required>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label class="form-label">
                            <i class="fas fa-lock me-2"></i>New Password
                        </label>
                        <input class="form-control" type="password" name="newpassword" required>
                        <div id="password-strength" class="password-strength text-muted">
                            Password strength will be shown here
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label class="form-label">
                            <i class="fas fa-lock me-2"></i>Confirm Password
                        </label>
                        <input class="form-control" type="password" name="confirmpassword" required>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary" name="change">
                    <i class="fas fa-save me-2"></i>Change Password
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script>
function checkpass() {
    // Check if new password and confirm password match
    if(document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
        alert('New Password and Confirm Password field does not match');
        document.changepassword.confirmpassword.focus();
        return false;
    }

    // Basic password strength check
    var password = document.changepassword.newpassword.value;
    var strengthBadge = document.getElementById('password-strength');
    
    // Weak password (less than 6 characters)
    if (password.length < 6) {
        strengthBadge.textContent = 'Weak Password';
        strengthBadge.className = 'password-strength text-danger';
        return false;
    }
    
    // Strong password criteria
    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})");
    if (strongRegex.test(password)) {
        strengthBadge.textContent = 'Strong Password';
        strengthBadge.className = 'password-strength text-success';
    } else {
        strengthBadge.textContent = 'Moderate Password';
        strengthBadge.className = 'password-strength text-warning';
    }
    
    return true;
}   
</script>
</body>
</html>
<?php } ?>