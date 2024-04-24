<?php 
  include_once('../authen.php');
  if(!isset($_GET['id'])){
    header('Location:index.php');
  }

  //$created_by = $_SESSION['emp_id']; 
  $sql = "SELECT *,a.id AS req_id 
                  FROM tb_request a
                      INNER JOIN tb_employee b 
                        ON a.emp_id = b.emp_id 
                          WHERE a.id = '".$_GET['id']."' ";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  
  $sql_tracking = "SELECT *,b.id AS tracking_id 
                  FROM tb_request a 
                        INNER JOIN tb_tracking b 
                        ON a.id = b.request_id
                        INNER JOIN tb_status c 
                        ON b.status_id = c.id 
                              WHERE b.request_id = '".$_GET['id']."' ORDER BY b.id ASC ";
  $result_tracking = $conn->query($sql_tracking); 



  $sql_select = "SELECT id, status_name FROM tb_status WHERE req_type_id = '".$row['req_type_id']."'";
  $result_select = $conn->query($sql_select);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tracking Management</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="../../dist/css/style.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.min.css">
  <!-- bootstrap-toggle -->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar & Main Sidebar Container -->
  <?php include_once('../includes/sidebar.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>จัดการข้อมูล Tracking</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
              <li class="breadcrumb-item"><a href="../tracking">Tracking Management</a></li>
              <li class="breadcrumb-item active">จัดการข้อมูล Tracking</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card card-primary">

        <!-- /.card-header -->
        <!-- form start -->
        <form action="create.php" method="post" enctype="multipart/form-data">
          <div class="card-body">

            <div class="form-group">
              <label for="subject">ข้อมูลพนักงาน</label>
              <input type="text" disabled class="form-control" id="subject" name="subject" placeholder="Subject" value="<?php echo $row['emp_id']." ".'|'; ?> &nbsp;<?php echo $row['names']; ?> &nbsp; <?php echo $row['position']; ?> &nbsp; <?php echo $row['office']; ?>" required>
            </div>
            <div class="form-group">
              <label for="subject">รายละเอียดข้อมูลคำร้อง</label>
              <input type="text" disabled class="form-control" id="subject" name="subject" placeholder="Subject" value="<?php echo $row['detail']; ?> " required>
            </div>

            <div class="form-group">
              <label>สถานะดำเนินการ</label>
              <select class="form-control select2" name="status_id" style="width: 100%;" required>
                  <?php 
                        echo "<option value='' disabled selected></option>";
                        if ($result_select->num_rows > 0) {
                            while($row_select = $result_select->fetch_assoc()) {
                                echo "<option value='". $row_select["id"] ."'>" . $row_select["status_name"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No options available</option>";
                        }
                  ?>
            </select>

            </div>

            <div class="form-group">
              <label for="detail">รายละเอียด</label>
              <textarea class="form-control" id="detail" name="detail" placeholder="กรอกรายละเอียด" rows="5" cols="80"></textarea>
            </div>

            <input type="hidden" name="req_id" value="<?php echo $row['req_id']; ?>">
            
          </div>
          <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-primary">บันทึกข้อมูล</button>
          </div>
        </form>
      </div>    
    </section>
    <!-- /.content -->
    <section class="col-lg-12">

<!-- DIRECT CHAT -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">ข้อมูล Tracking ทั้งหมด</h3>
    
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover">
    <tr>
        <th>No.</th>
        <th>สถานะงาน</th>
        <th>รายละเอียด</th>
        <th>วันที่-เวลา</th>

    </tr>
    </thead>
    <tbody>
    <?php 
      $num = 0;
      while($row = $result_tracking->fetch_assoc()){
        $num++;
    ?>
    <tr>
        <td><?php echo $num; ?></td>
        <td><?php echo $row['status_name']; ?></td>
        <td><?php echo $row['tracking_detail']; ?></td>
        <td><?php echo date("d/m/Y H:i:s", strtotime($row['created_at'])); ?></td>
        <td>
        <td><input class="toggle-event" data-id="<?php echo $row['tracking_id']; ?>" type="checkbox" name="active" <?php echo $row['active'] == 'true' ? 'checked': ''; ?> data-toggle="toggle" data-on="แสดงผล" data-off="ปิด" data-onstyle="success" data-style="ios"></td>
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
  <!-- /.content-wrapper -->tb_employee

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
<!-- DataTables -->
<script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>

<!-- bootstrap-toggle -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>



<script>
  $(function () {
    $('#dataTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });

    $('.toggle-event').change(function(){
    $.ajax({
      method: "POST",
      url: "active.php",
      data: { 
        id: $(this).data('id'), 
        value: $(this).is(':checked') 
      }
    })
    .done(function( resp, status, xhr) {
      setTimeout(() => {
        alert(status)
      }, 300);
    })
    .fail(function ( xhr, status, error) { 
      alert(status +' '+ error)
    })
  })

    //Initialize Select2 Elements
    $('.select2').select2()


  });
  
</script>

</body>
</html>
