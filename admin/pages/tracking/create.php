<meta charset="UTF-8">
<meta name="viewport" content="width=320, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<?php include_once('../authen.php') ?>
<?php
    if(isset($_POST['submit'])){
        $detail = str_replace('../../../', './', $_POST['detail'] );
        
            $sql = "INSERT INTO `tb_tracking` (`request_id`, `status_id`, `tracking_detail`) 
                    VALUES ('".$_POST['req_id']."',
                            '".$_POST['status_id']."', 
                            '".$detail."')";
            $result = $conn->query($sql) or die($conn->error);
            if($result){
                echo '<script> alert("เพิ่มข้อมูลสำเร็จ") </script>';
                header('Refresh:0; url=index.php');
            }
         else {
            echo 'No';
        }
    } else {
        header('location:index.php');
    }
?>