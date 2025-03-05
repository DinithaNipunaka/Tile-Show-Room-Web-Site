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
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  
  <!-- Custom Styles -->
  <style>
    /* Custom color scheme */
    :root {
      --primary-color: #3498db;
      --secondary-color: #2ecc71;
      --background-color: #f4f6f9;
    }

    body {
      background-color: var(--background-color);
      font-family: 'Source Sans Pro', sans-serif;
    }

    .content-wrapper {
      background-color: var(--background-color);
    }

    .card {
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }

    .table thead {
      background-color: var(--primary-color);
      color: white;
    }

    .table-striped tbody tr:nth-of-type(even) {
      background-color: rgba(52, 152, 219, 0.05);
    }

    .table-striped tbody tr:hover {
      background-color: rgba(52, 152, 219, 0.1);
      transition: background-color 0.3s ease;
    }

    .breadcrumb {
      background-color: transparent;
      padding: 0.75rem 1rem;
    }

    .card-header {
      background-color: var(--primary-color);
      color: white;
      border-bottom: none;
    }

    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }

    .btn-secondary {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .animated-content {
      animation: fadeIn 0.5s ease-in-out;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .table-responsive {
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

 <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper animated-content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-primary"><i class="fas fa-shopping-cart me-2"></i>Confirmed Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php" class="text-primary">Home</a></li>
              <li class="breadcrumb-item active">Confirmed Orders</li>
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
              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0"><i class="fas fa-list me-2"></i>Order Details</h3>
                <div class="card-tools">
                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#export-modal">
                    <i class="fas fa-download me-1"></i>Export
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
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
<?php $query=mysqli_query($con,"select orderdetails.order_id,CONCAT(users.user_firstname,' ',users.user_lastname) AS full_name,users.user_email,orderdetails.order_name,orderdetails.order_price,orderdetails.order_quantity,orderdetails.order_total,orderdetails.order_date from orderdetails JOIN users ON orderdetails.user_id = users.user_id where orderdetails.order_status='Ordered'");
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
<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
      "responsive": true, 
      "lengthChange": false, 
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