<?php 
  session_start();
  require_once('../php/connect.php');

  try {
    if (isset($_POST['username'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);
        require_once '../lib/idm-service.php';
        $service     = new IDMService();
        $authenKey   = "3a243291-44d0-4171-8b17-347cfc1472ea";
        $loginRsults = $service->login($authenKey, $username, $password);

        if (!isset($loginRsults['Status'])) {

            $ResponseCode = $loginRsults['LoginResult']['ResponseCode'];
            $ResponseMsg  = $loginRsults['LoginResult']['ResponseMsg'];
            $UserId       = $loginRsults['LoginResult']['ResultObject']['UserId'];
            if ($ResponseMsg != "") {
                if ($ResponseMsg == "Success" and $ResponseCode == "WSV0000") {

                    $empAuthenKey = "93567815-dfbb-4727-b4da-ce42c046bfca";
                    $results      = $service->getEmployeeInfoByEmployeeId($empAuthenKey, $username);

                    $titlefullname = $results['GetEmployeeInfoByEmployeeIdResult']['ResultObject']['TitleFullName'];
                    $namef         = $results['GetEmployeeInfoByEmployeeIdResult']['ResultObject']['FirstName'];
                    $namel         = $results['GetEmployeeInfoByEmployeeIdResult']['ResultObject']['LastName'];
                    $baname        = $results['GetEmployeeInfoByEmployeeIdResult']['ResultObject']['BaName'];
                    $department    = $results['GetEmployeeInfoByEmployeeIdResult']['ResultObject']['DepartmentFullName'];
                    $position      = $results['GetEmployeeInfoByEmployeeIdResult']['ResultObject']['Position'];
                    echo json_encode(['status' => 'ok', 'username' => $username, 'first_name' => $namef, 'last_name' => $namel, 'position' => $position, 'department' => $department, 'ba_name' => $baname]);
                    $sql = "SELECT * FROM `tb_user` WHERE `username` = '".$username."' ";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $_SESSION['authen_id'] = $row['id'];
                    $_SESSION['names'] = $row['names'];
                    $_SESSION['emp_id'] = $row['emp_id'];
                    $_SESSION['status'] = $row['status'];
                    $_SESSION['last_login'] = $row['last_login'];

                    $update = "UPDATE `tb_user` SET `last_login` = '".date("Y-m-d H:i:s")."' WHERE `id` = '".$row['id']."' ";
                    $result_update = $conn->query($update);

                      if ($result_update) {
                               header('Location: pages/dashboard');
                             } else {
                               echo '<script> alert("Error!!!") </script>';
                             
                           } 


                  } else {
                    echo '<script> alert("รหัสผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง") </script>';
               }
           } else {
            echo '<script> alert("ไม่สามารถติดต่อกับระบบ IDM ได้") </script>';
            }


        
        }
      }
    
                 
//         } else {
//             echo json_encode(['status' => 'not', 'message' => 'notconnectIDM'],JSON_UNESCAPED_UNICODE);
//         }
//     } else {
//         echo json_encode(['status' => 'not', 'message' => 'steperor'],JSON_UNESCAPED_UNICODE);
//     }
} catch (SoapFault $e) {
//     //echo json_encode(['status' => 'not', 'message' => 'steperor'],JSON_UNESCAPED_UNICODE);
//     //$output[] = "step ERROR !";
//     // print_r($e);
}



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ระบบติดตามงานด้านบุคคล</title>
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="dist/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="dist/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="dist/img/favicons/favicon-16x16.png">
  <link rel="manifest" href="dist/img/favicons/site.webmanifest">
  <link rel="mask-icon" href="dist/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="dist/img/favicons/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="dist/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>ระบบติดตามงานด้านบุคคล</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login เข้าระบบโดย ผบก.</p>

      <form action="" method="post">

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fas fa-lock"></i></span>
            </div>
            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
        </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Login</button>
          </div>
          <!-- /.col -->
        </div>
        
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>



</body>
</html>
