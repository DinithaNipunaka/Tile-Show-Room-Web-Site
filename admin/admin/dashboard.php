<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { 
header('location:index.php');
}
else{ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Herath Tile Shop | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <!-- Custom Styles -->
  <style>
    :root {
      --primary: #3b7ddd;
      --secondary: #6c757d;
      --success: #2dce89;
      --info: #11cdef;
      --warning: #fb6340;
      --danger: #f5365c;
      --light: #f8f9fa;
      --dark: #343a40;
    }
    
    body {
      background-color: #f4f6f9;
      font-family: 'Source Sans Pro', sans-serif;
    }
    
    .content-wrapper {
      background: linear-gradient(to right, #f8f9fa, #edf1f5);
    }
    
    .content-header {
      padding: 25px 0.5rem;
      background: rgba(255, 255, 255, 0.5);
      border-radius: 10px;
      margin-bottom: 20px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }
    
    .content-header h1 {
      font-weight: 700;
      color: #3c4858;
      position: relative;
      display: inline-block;
    }
    
    .content-header h1:after {
      content: '';
      position: absolute;
      width: 40%;
      height: 3px;
      background: linear-gradient(to right, var(--primary), var(--info));
      bottom: -10px;
      left: 0;
      border-radius: 2px;
    }
    
    .breadcrumb {
      background: transparent;
      padding: 0;
    }
    
    .breadcrumb-item a {
      color: var(--primary);
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .breadcrumb-item a:hover {
      color: var(--info);
      text-decoration: none;
    }
    
    .breadcrumb-item.active {
      color: var(--secondary);
      font-weight: 500;
    }
    
    .small-box {
      position: relative;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      transition: all 0.5s ease;
      margin-bottom: 30px;
    }
    
    .small-box:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }
    
    .small-box .inner {
      padding: 25px 20px;
      z-index: 10;
      position: relative;
    }
    
    .small-box h3 {
      font-size: 38px;
      font-weight: 700;
      margin-bottom: 10px;
      white-space: nowrap;
      padding: 0;
    }
    
    .small-box p {
      font-size: 16px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 0;
    }
    
    .small-box .icon {
      position: absolute;
      top: 15px;
      right: 15px;
      font-size: 70px;
      color: rgba(255, 255, 255, 0.15);
      z-index: 0;
    }
    
    .small-box a.small-box-footer {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 12px 0;
      color: rgba(255, 255, 255, 0.9);
      background: rgba(0, 0, 0, 0.1);
      text-align: center;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .small-box a.small-box-footer i {
      margin-left: 10px;
      transition: all 0.3s ease;
    }
    
    .small-box a.small-box-footer:hover {
      background: rgba(0, 0, 0, 0.2);
    }
    
    .small-box a.small-box-footer:hover i {
      transform: translateX(5px);
    }
    
    /* Customized Box Colors */
    .bg-info {
      background: linear-gradient(135deg, #11cdef 0%, #1171ef 100%) !important;
    }
    
    .bg-success {
      background: linear-gradient(135deg, #2dce89 0%, #2ab67c 100%) !important;
    }
    
    .bg-warning {
      background: linear-gradient(135deg, #fb6340 0%, #fbb140 100%) !important;
    }
    
    .bg-danger {
      background: linear-gradient(135deg, #f5365c 0%, #f56036 100%) !important;
    }
    
    /* Add pulsing icon effect */
    @keyframes pulse {
      0% {
        transform: scale(1);
        opacity: 0.8;
      }
      50% {
        transform: scale(1.1);
        opacity: 1;
      }
      100% {
        transform: scale(1);
        opacity: 0.8;
      }
    }
    
    .icon-pulse {
      animation: pulse 2s infinite;
    }
    
    /* Add decorative elements */
    .dashboard-row {
      position: relative;
    }
    
    .dashboard-row:before {
      content: '';
      position: absolute;
      left: 50%;
      top: -15px;
      width: 80%;
      height: 1px;
      background: linear-gradient(to right, transparent, rgba(0, 0, 0, 0.1), transparent);
      transform: translateX(-50%);
    }
    
    .dashboard-separator {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 20px 0 30px;
      position: relative;
    }
    
    .dashboard-separator h5 {
      background: white;
      padding: 0 20px;
      color: var(--secondary);
      font-weight: 600;
      position: relative;
      z-index: 1;
      margin: 0;
    }
    
    .dashboard-separator:before {
      content: '';
      position: absolute;
      left: 0;
      top: 50%;
      width: 100%;
      height: 1px;
      background: rgba(0, 0, 0, 0.1);
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
      background: #c1c1c1;
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: #a8a8a8;
    }
    
    /* Add responsive fixes */
    @media (max-width: 768px) {
      .small-box h3 {
        font-size: 28px;
      }
      
      .small-box p {
        font-size: 14px;
      }
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
<?php include_once('includes/navbar.php');?>

  <!-- Main Sidebar Container -->
<?php include_once('includes/sidebar.php');?>
    <!-- Sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header animate__animated animate__fadeIn">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row animate__animated animate__fadeInUp animate__delay-1s">
          <?php if($_SESSION['utype']==1):?>
          <div class="col-lg-4 col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php $query=mysqli_query($con,"select id from login where UserType=0");
                $subadmincount=mysqli_num_rows($query);
                ?>
                <h3><?php echo $subadmincount;?></h3>
                <p>Sub Admins</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-shield icon-pulse"></i>
              </div>
              <a href="manage-subadmins.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php endif;?>
          <!-- ./col -->
          <div class="col-lg-4 col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php $query1=mysqli_query($con,"select item_id from items");
                $listedteachers=mysqli_num_rows($query1);
                ?>
                <h3><?php echo $listedteachers;?></h3>
                <p>Listed Products</p>
              </div>
              <div class="icon">
                <i class="fas fa-box icon-pulse"></i>
              </div>
              <a href="manage-products.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php $query3=mysqli_query($con,"select user_id from users");
                $listedclasses=mysqli_num_rows($query3);
                ?>               
                <h3><?php echo $listedclasses;?></h3>
                <p>Listed Users</p>
              </div>
              <div class="icon">
                <i class="fas fa-users icon-pulse"></i>
              </div>
              <a href="manage-classes.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="dashboard-separator animate__animated animate__fadeIn animate__delay-2s">
          <h5><i class="fas fa-shopping-cart mr-2"></i>Order Management</h5>
        </div>

        <div class="row dashboard-row animate__animated animate__fadeInUp animate__delay-3s">
          <div class="col-lg-4 col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php $query11=mysqli_query($con,"select order_id from orderdetails ");
                $terollments=mysqli_num_rows($query11);
                ?>
                <h3><?php echo $terollments;?></h3>
                <p>Total Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-bag icon-pulse"></i>
              </div>
              <a href="total-orders.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
 
          <!-- ./col -->
          <div class="col-lg-4 col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php $query12=mysqli_query($con,"select order_id from orderdetails where order_status='Ordered'");
                $newerollments=mysqli_num_rows($query12);
                ?>
                <h3><?php echo $newerollments;?></h3>
                <p>Order Confirms</p>
              </div>
              <div class="icon">
                <i class="fas fa-check-circle icon-pulse"></i>
              </div>
              <a href="comfirm-orders.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php $query13=mysqli_query($con,"select order_id from orderdetails where order_status='Pending'");
                $acceptedenrollments=mysqli_num_rows($query13);
                ?>               
                <h3><?php echo $acceptedenrollments;?></h3>
                <p>Pending Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-hourglass-half icon-pulse"></i>
              </div>
              <a href="pending-orders.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
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
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>

<script>
  $(document).ready(function() {
    // Add hover effects to small boxes
    $('.small-box').hover(
      function() {
        $(this).find('.icon i').addClass('animate__animated animate__heartBeat');
      },
      function() {
        $(this).find('.icon i').removeClass('animate__animated animate__heartBeat');
      }
    );

    // Add entrance animations
    function animateElements() {
      $('.content-header').addClass('animate__animated animate__fadeIn');
      
      setTimeout(function() {
        $('.small-box').each(function(index) {
          var $this = $(this);
          setTimeout(function() {
            $this.addClass('animate__animated animate__zoomIn');
          }, index * 150);
        });
      }, 300);
    }
    
    // Trigger animations
    animateElements();
  });
</script>
</body>
</html>
<?php } ?>