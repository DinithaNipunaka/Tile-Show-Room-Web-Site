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
  <title>Herath Tile Shop | Total Orders</title>

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
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #3498db;
      --secondary-color: #2ecc71;
      --background-color: #f4f6f9;
      --text-color: #2c3e50;
    }

    .card-header {
      background: linear-gradient(to right, var(--primary-color), #2980b9);
      color: white;
    }

    .table-striped tbody tr:nth-of-type(even) {
      background-color: rgba(52, 152, 219, 0.05);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      background: var(--primary-color) !important;
    }

    .dt-buttons .btn {
      margin: 2px;
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
            <h1><i class="fas fa-shopping-cart"></i> Total Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-clipboard-list"></i> Order Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="ordersTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $query = mysqli_query($con,"SELECT orderdetails.order_id, 
                    CONCAT(users.user_firstname,' ',users.user_lastname) AS full_name,
                    users.user_email, orderdetails.order_name, orderdetails.order_price,
                    orderdetails.order_quantity, orderdetails.order_total, orderdetails.order_date 
                    FROM orderdetails 
                    JOIN users ON orderdetails.user_id = users.user_id");
                  
                  $cnt = 1;
                  while($result = mysqli_fetch_array($query)){
                  ?>
                  <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo $result['full_name'] ?></td>
                    <td><?php echo $result['user_email'] ?></td>
                    <td><?php echo $result['order_name'] ?></td>
                    <td><?php echo $result['order_price'] ?></td>
                    <td><?php echo $result['order_quantity'] ?></td>
                    <td><?php echo $result['order_total'] ?></td>
                    <td><?php echo $result['order_date'] ?></td>
                  </tr>
                  <?php $cnt++; } ?>
                  </tbody>
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
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
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

<script>
  $(function () {
    $('#ordersTable').DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
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
  });
</script>
</body>
</html>
<?php } ?>