<?php 
  include_once('../authen.php');
  if(!isset($_GET['id'])){
    header('Location:index.php');
  }
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
                              WHERE b.request_id = '".$_GET['id']."' AND b.active = 'true' ORDER BY b.id ASC ";
  $result_tracking = $conn->query($sql_tracking); 
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
            <h1>Tracking View</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
              <li class="breadcrumb-item active">ข้อมูล Tracking</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
      <div class="card">
  <br>
  <br>

<!-- The timeline -->
<ul class="timeline timeline-inverse">

              <!-- timeline time label -->
              <li class="time-label">&nbsp;
                <span class="bg-primary">
                <?php echo date("d/m/Y", strtotime($row['created_at'])); ?>
                </span>
              </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
                <i class="fa fa-user bg-warning"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock"></i> <?php echo date("d/m/Y H:i:s", strtotime($row['created_at'])); ?></span>

                  <h3 class="timeline-header"><?php echo $row['emp_id']." ".'|'; ?> &nbsp;<?php echo $row['names']; ?> &nbsp; <?php echo $row['position']; ?> &nbsp; <?php echo $row['office']; ?></h3>

                  <div class="timeline-body">
                          <?php echo $row['detail']; ?>
                  </div>

                </div>
              </li>
              <!-- END timeline item -->

            </ul><br>



</div>
</section>

<section class="content">
      <div class="card">
  <br>

        <!-- The timeline -->
        <ul class="timeline timeline-inverse">

 

        <?php 
                $num = 0;
                while($row = $result_tracking->fetch_assoc()){
                  $num++;
        ?>
                      <!-- timeline time label -->
                      <li class="time-label">&nbsp;
                        <span class="bg-success">
                        <?php echo date("d/m/Y", strtotime($row['created_at'])); ?>
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock"></i> <?php echo date("d/m/Y H:i:s", strtotime($row['created_at'])); ?></span>

                          <h3 class="timeline-header"><?php echo $row['status_name']; ?></h3>

                          <div class="timeline-body">
                                  <?php echo $row['tracking_detail']; ?>
                          </div>

                        </div>
                      </li>
                      <!-- END timeline item -->
      <?php } ?>

                     
                      <!-- END timeline item -->
                      <li>
                        <i class="fa fa-flag-checkered bg-gray"></i>
                      </li>
                    </ul><br>
      </div>    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <!-- footer -->
    <?php include_once('../includes/footer.php') ?>
  
  </div>
  <!-- ./wrapper -->
  

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>


</body>
</html>
