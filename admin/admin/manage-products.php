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
//Code For Deletion the teacher
if($_GET['action']=='delete'){
$lid=intval($_GET['tid']);
$iimage=$_GET["ipic"];
// $profilepic=$_GET['profilepic'];
$impath="itempic"."/".$iimage;
// $ppicpath="itempic"."/".$profilepic;
$sql=mysqli_query($con,"delete from items where item_id='$lid'");
// $query=mysqli_query($con,"delete from tblteachers where id='$lid'");
if($sql){
unlink($impath);
echo "<script>alert('Product details deleted successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'manage-products.php'; </script>";
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
  <title>Herath Tile Shop  | Manage Products</title>

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
    body {
      background-color: #f4f6f9;
      font-family: 'Arial', sans-serif;
    }
    .products-container {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      padding: 30px;
      margin-top: 30px;
      transition: all 0.3s ease;
    }
    .products-container:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .table-responsive {
      border-radius: 10px;
      overflow: hidden;
    }
    .table {
      margin-bottom: 0;
    }
    .table thead {
      background-color: #007bff;
      color: white;
    }
    .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgba(0,123,255,0.05);
    }
    .table-hover tbody tr:hover {
      background-color: rgba(0,123,255,0.1);
      transition: background-color 0.3s ease;
    }
    .product-image {
      max-width: 100px;
      height: auto;
      border-radius: 8px;
      transition: transform 0.3s ease;
    }
    .product-image:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    .action-icons {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .action-icons a {
      margin: 0 5px;
      color: #007bff;
      transition: all 0.3s ease;
    }
    .action-icons a:hover {
      color: #0056b3;
      transform: scale(1.2);
    }
    .delete-icon {
      color: #dc3545 !important;
    }
    .delete-icon:hover {
      color: #a71d2a !important;
    }
    .page-header {
      background-color: #007bff;
      color: white;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    .animated-row {
      animation: fadeIn 0.5s ease;
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
            <h1>Manage Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Products</li>
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
                <h3 class="card-title">ProductDetails</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Item Image</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Item Qunatity</th>
                    <th>Item Added date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
<?php $query=mysqli_query($con,"select * from items");
$cnt=1;
while($result=mysqli_fetch_array($query)){
?>

                  <tr>
                    <td><?php echo $cnt;?></td>
                    <td style="background-color:wheat"><img src="itempic/<?php echo $result['item_image']?>" width="110"></td>
                    <td><?php echo $result['item_name']?></td>
                   <td><?php echo $result['item_price']?></td>
                   <td><?php echo $result['qty']?></td>
                    <td><?php echo $result['item_date']?></td>
                    <th>
     <a href="edit-teacher.php?tid=<?php echo $result['item_id'];?>" style="color:orange;" title="Edit Sub Admin Details"> <i class="fa fa-edit" aria-hidden="true"></i> </a> | 
     <a href="manage-products.php?action=delete&&tid=<?php echo $result['item_id']; ?>&&ipic=<?php echo $result['item_image'];?>" style="color:red;" title="Delete this record" onclick="return confirm('Do you really want to delete this record?');"><i class="fa fa-trash" aria-hidden="true"></i> </a>
 </th>
                  </tr>
         <?php $cnt++;} ?>
             
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Item image</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Item Quantity</th>
                    <th>Item Added date</th>
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