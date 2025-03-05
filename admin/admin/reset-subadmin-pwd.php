<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { 
header('location:index.php');
}
else{
// Code for reset the password of sub admin
if(isset($_POST['reset'])){
$sudadminid=intval($_GET['said']);
$password=md5($_POST['inputpwd']);

$query=mysqli_query($con,"update login set Password='$password' where UserType=0 and ID='$sudadminid'");
if($query){
echo "<script>alert('Sub-Admin password reset successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'manage-subadmins.php'; </script>";
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
  <title>Herath Tile Shop | Reset Sub-Admin Password</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Custom Styles -->
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Arial', sans-serif;
    }
    .password-reset-container {
      max-width: 500px;
      margin: 50px auto;
      padding: 30px;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }
    .password-reset-container:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    .form-control {
      border-radius: 8px;
      padding: 12px;
      transition: all 0.3s ease;
    }
    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    }
    .btn-reset {
      background-color: #007bff;
      border-color: #007bff;
      transition: all 0.3s ease;
    }
    .btn-reset:hover {
      background-color: #0056b3;
      transform: translateY(-2px);
    }
    .card-header {
      background-color: #007bff;
      color: white;
      border-radius: 8px 8px 0 0;
    }
    .password-strength {
      height: 4px;
      background-color: #e0e0e0;
      margin-top: 5px;
      transition: all 0.3s ease;
    }
    .password-strength-bar {
      height: 100%;
      width: 0;
      transition: width 0.5s ease;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="password-reset-container">
    <div class="card">
      <div class="card-header text-center">
        <h3 class="mb-0">
          <i class="fas fa-lock me-2"></i>Reset Sub-Admin Password
        </h3>
      </div>
      <div class="card-body">
        <form name="resetpassword" method="post" onsubmit="return checkpass();">
          <div class="mb-3">
            <label for="inputpwd" class="form-label">
              <i class="fas fa-key me-2"></i>New Password
            </label>
            <input 
              type="password" 
              class="form-control" 
              id="inputpwd" 
              name="inputpwd" 
              placeholder="Enter new password" 
              required
              oninput="checkPasswordStrength(this.value)"
            >
            <div class="password-strength">
              <div class="password-strength-bar" id="password-strength-bar"></div>
            </div>
            <small class="form-text text-muted" id="password-strength-text"></small>
          </div>
          
          <div class="mb-3">
            <label for="confirmpassword" class="form-label">
              <i class="fas fa-check-circle me-2"></i>Confirm Password
            </label>
            <input 
              type="password" 
              class="form-control" 
              id="confirmpassword" 
              name="confirmpassword" 
              placeholder="Confirm new password" 
              required
            >
          </div>
          
          <div class="d-grid">
            <button 
              type="submit" 
              class="btn btn-reset btn-primary" 
              name="reset" 
              id="reset"
            >
              <i class="fas fa-sync-alt me-2"></i>Reset Password
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
function checkpass() {
  var password = document.getElementById('inputpwd').value;
  var confirmPassword = document.getElementById('confirmpassword').value;
  
  if(password !== confirmPassword) {
    alert('New Password and Confirm Password field does not match');
    document.getElementById('confirmpassword').focus();
    return false;
  }
  return true;
}

function checkPasswordStrength(password) {
  var strengthBar = document.getElementById('password-strength-bar');
  var strengthText = document.getElementById('password-strength-text');
  var strength = 0;
  
  if (password.length > 7) strength++;
  if (password.match(/[a-z]+/)) strength++;
  if (password.match(/[A-Z]+/)) strength++;
  if (password.match(/[0-9]+/)) strength++;
  if (password.match(/[$@#&!]+/)) strength++;
  
  switch(strength) {
    case 0:
    case 1:
      strengthBar.style.width = '20%';
      strengthBar.style.backgroundColor = 'red';
      strengthText.textContent = 'Very Weak';
      strengthText.style.color = 'red';
      break;
    case 2:
      strengthBar.style.width = '40%';
      strengthBar.style.backgroundColor = 'orange';
      strengthText.textContent = 'Weak';
      strengthText.style.color = 'orange';
      break;
    case 3:
      strengthBar.style.width = '60%';
      strengthBar.style.backgroundColor = 'blue';
      strengthText.textContent = 'Medium';
      strengthText.style.color = 'blue';
      break;
    case 4:
      strengthBar.style.width = '80%';
      strengthBar.style.backgroundColor = 'green';
      strengthText.textContent = 'Strong';
      strengthText.style.color = 'green';
      break;
    case 5:
      strengthBar.style.width = '100%';
      strengthBar.style.backgroundColor = 'darkgreen';
      strengthText.textContent = 'Very Strong';
      strengthText.style.color = 'darkgreen';
      break;
  }
}
</script>
</body>
</html>
<?php } ?>