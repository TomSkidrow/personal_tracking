<?php 
include_once('../authen.php');
$emp_id = $_SESSION['emp_id']; 

$type_count1 = "SELECT * FROM tb_request WHERE created_by = ".$emp_id." AND req_type_id = 1 ";
$result_type_count1 = $conn->query($type_count1);
$type_count2 = "SELECT * FROM tb_request WHERE created_by = ".$emp_id." AND req_type_id = 2 ";
$result_type_count2 = $conn->query($type_count2);
$type_count3 = "SELECT * FROM tb_request WHERE created_by = ".$emp_id." AND req_type_id = 3 ";
$result_type_count3 = $conn->query($type_count3);
$close_count = "SELECT * FROM tb_request WHERE created_by = ".$emp_id." AND is_close = 'YES' ";
$result_close_count = $conn->query($close_count);

$sql_req_by = "SELECT *,a.id AS req_id 
                  FROM tb_request a 
                        INNER JOIN tb_employee b 
                        ON a.emp_id = b.emp_id 
                              WHERE created_by = ".$emp_id." ORDER BY a.id ASC ";
$result_req_by = $conn->query($sql_req_by);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="../../dist/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../dist/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../dist/img/favicons/favicon-16x16.png">
  <link rel="manifest" href="../../dist/img/favicons/site.webmanifest">
  <link rel="mask-icon" href="../../dist/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="../../dist/img/favicons/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="../../dist/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.min.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php include_once('../includes/sidebar.php') ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
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
        <div class="row">
          <div class="col-lg-3 col-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $result_type_count1->num_rows; ?></h3>
                <p>เลื่อนระดับ</p>
              </div>
              <div class="icon">
                <i class="ion-android-contact"></i>
              </div>
              <a href="../articles" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-3">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $result_type_count2->num_rows; ?></h3>
                <p>ย้าย</p>
              </div>
              <div class="icon">
                <i class="ion-android-contacts"></i>
              </div>
              <a href="../articles" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-3">
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?php echo $result_type_count3->num_rows; ?></h3>
                <p>แต่งตั้ง/ย้ายและแต่งตั้ง (ชผ.ขึ้นไป)</p>
              </div>
              <div class="icon">
                <i class="ion-android-person"></i>
              </div>
              <a href="../articles" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-3">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $result_close_count->num_rows; ?></h3>

                <p>เสร็จแล้ว</p>
              </div>
              <div class="icon">
                <i class="ion-ios-checkmark-outline"></i>
              </div>
              <a href="../contacts" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">

            <!-- DIRECT CHAT -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">คำร้องระหว่างดำเนินการ</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                <tr>
                    <th>No.</th>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>ตำแหน่ง</th>
                    <th>สังกัด</th>
                    <th>รายละเอียด</th>
                    <th>สร้างเมื่อ</th>
                    <th></th>

                </tr>
                </thead>
                <tbody>
                <?php 
                  $num = 0;
                  while($row = $result_req_by->fetch_assoc()){
                    $num++;
                ?>
                <tr>
                    <td><?php echo $num; ?></td>
                    <td><?php echo $row['emp_id']; ?></td>
                    <td><?php echo $row['names']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td><?php echo $row['office']; ?></td>
                    <td><?php echo $row['detail']; ?></td>
                    <td><?php echo date("d/m/Y", strtotime($row['created_at'])); ?></td>
                    <td>
                  <a href="form-edit.php?id=<?php echo $row['req_id']; ?>" class="btn btn-sm btn-warning text-white">
                    <i class="fas fa-edit"></i>
                  </a> 
                  <a href="#" onclick="deleteItem(<?php echo $row['req_id']; ?>);" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </td>
                    
                </tr>
                <?php } ?>
                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- footer -->
  <?php include_once('../includes/footer.php') ?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

</body>
</html>
