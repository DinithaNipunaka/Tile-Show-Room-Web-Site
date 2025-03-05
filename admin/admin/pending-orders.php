<?php session_start();
error_reporting(0);
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { 
header('location:index.php');
}
else{


  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Herath Tile Shop  | Total Oders</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

 <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pending Orders </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Pending Orders</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
        

            <div class="card" >
              <div class="card-header">
                <h3 class="card-title">Order Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Order Item</th>
                    <th>Unit Price</th>
                    <th>Item Quantity</th>
                    <th>Order Total</th>
                    <th>Ordered Date</th>
                  </tr>
                  </thead>
                  <tbody>
<?php $query=mysqli_query($con,"select orderdetails.order_id,CONCAT(users.user_firstname,' ',users.user_lastname) AS full_name,users.user_email,orderdetails.order_name,orderdetails.order_price,orderdetails.order_quantity,orderdetails.order_total,orderdetails.order_date from orderdetails JOIN users ON orderdetails.user_id = users.user_id where orderdetails.order_status='Pending'");
$cnt=1;
if (!$query) {
  die("Query failed: " . mysqli_error($con));
}
while($result=mysqli_fetch_array($query)){
?>

                  <tr>
                    <td><?php echo $cnt;?></td>
                    <td><?php echo $result['full_name']?></td>
                    <td><?php echo $result['user_email']?></td>
                    <td><?php echo $result['order_name']?></td>
                   <td><?php echo $result['order_price']?></td>
                   <td><?php echo $result['order_quantity']?></td>
                    <td><?php echo $result['order_total']?></td>
                    <td><?php echo $result['order_date']?></td>
                    
 </th>
                  </tr>
         <?php $cnt++;} ?>
             
                  </tbody>
                  <tfoot>
   <tr>
   <th>#</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Order Item</th>
                    <th>Unit Price</th>
                    <th>Item Quantity</th>
                    <th>Order Total</th>
                    <th>Ordered Date</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('includes/footer.php');?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [
        {
          extend: 'copy',
          className: 'btn btn-secondary',
          text: '<i class="fas fa-copy"></i> Copy'
        },
        {
          extend: 'csv',
          className: 'btn btn-success',
          text: '<i class="fas fa-file-csv"></i> CSV'
        },
        {
          extend: 'excel',
          className: 'btn btn-success',
          text: '<i class="fas fa-file-excel"></i> Excel'
        },
        {
          extend: 'pdf',
          className: 'btn btn-danger',
          text: '<i class="fas fa-file-pdf"></i> PDF'
        },
        {
          extend: 'print',
          className: 'btn btn-info',
          text: '<i class="fas fa-print"></i> Print'
        },
        {
          extend: 'colvis',
          className: 'btn btn-warning',
          text: '<i class="fas fa-eye"></i> Columns'
        }
      ],
      "dom": 'Bfrtip',
    }).buttons().container().appendTo('#ordersTable_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
<?php } ?>