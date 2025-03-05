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
//Code For Deletion the subadmin
if($_GET['action']=='delete'){
$subadminid=intval($_GET['said']);
$query=mysqli_query($con,"delete from login where ID ='$subadminid'");
if($query){
echo "<script>alert('Sub admin record deleted successfully.');</script>";
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
  <title>Herath Tile Shop| Manage-Sub Admins</title>

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
  <style>
    :root {
      --primary-color: #3498db;
      --secondary-color: #2ecc71;
      --bg-color: #f4f6f7;
      --text-color: #2c3e50;
      --action-edit-color: #3498db;
      --action-delete-color: #e74c3c;
      --action-reset-color: #f39c12;
    }

    body {
      background-color: var(--bg-color);
      font-family: 'Source Sans Pro', sans-serif;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .card-header {
      background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
      color: white;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }

    .table {
      border-radius: 15px;
      overflow: hidden;
    }

    .table thead {
      background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
      color: white;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgba(52, 152, 219, 0.05);
    }

    .table-striped tbody tr:nth-of-type(even) {
      background-color: rgba(46, 204, 113, 0.05);
    }

    .table tbody tr:hover {
      background-color: rgba(52, 152, 219, 0.1);
      transition: background-color 0.3s ease;
    }

    .action-icons a {
      margin: 0 5px;
      transition: transform 0.3s ease;
    }

    .action-icons a:hover {
      transform: scale(1.2);
    }

    .action-icons .fa-edit {
      color: var(--action-edit-color);
    }

    .action-icons .fa-trash {
      color: var(--action-delete-color);
    }

    .action-icons .fa-key {
      color: var(--action-reset-color);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .table tbody tr {
      animation: fadeIn 0.5s ease forwards;
      opacity: 0;
    }

    .table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .table tbody tr:nth-child(2) { animation-delay: 0.2s; }
    .table tbody tr:nth-child(3) { animation-delay: 0.3s; }
    .table tbody tr:nth-child(4) { animation-delay: 0.4s; }
    .table tbody tr:nth-child(5) { animation-delay: 0.5s; }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
      padding: 5px 10px;
      margin: 0 2px;
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: var(--primary-color);
      color: white !important;
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage-Sub Admins</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Manage-Sub Admins</li>
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
        

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sub Admin Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email ID</th>
                    <th>Mobile Number</th>
                    <th>Reg. Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
<?php $query=mysqli_query($con,"select * from login where UserType=0");
$cnt=1;
while($result=mysqli_fetch_array($query)){
?>

                  <tr>
                    <td><?php echo $cnt;?></td>
                    <td><?php echo $result['AdminuserName']?></td>
                    <td><?php echo $result['AdminName']?></td>
                   <td><?php echo $result['Email']?></td>
                    <td><?php echo $result['MobileNumber']?></td>
                    <td><?php echo $result['AdminRegdate']?></td>
                    <th>
     <a href="edit-subadmin.php?said=<?php echo $result['ID'];?>" style="color:orange;" title="Edit Sub Admin Details"> <i class="fa fa-edit" aria-hidden="true"></i> </a>
     <a href="manage-subadmins.php?action=delete&&said=<?php echo $result['ID']; ?>" style="color:red;" title="Delete this record" onclick="return confirm('Do you really want to delete this record?');"><i class="fa fa-trash" aria-hidden="true"></i> </a>
     <a href="reset-subadmin-pwd.php?said=<?php echo $result['ID']; ?>" title="Reset Sub Admin Password"> <i class="fa fa-key" aria-hidden="true"></i></a></th>
                  </tr>
         <?php $cnt++; } ?>
             
                  </tbody>
                  <tfoot>
                <tr>
                  <th>#</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email ID</th>
                    <th>Mobile Number</th>
                    <th>Reg. Date</th>
                    <th>Action</th>
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