<meta charset="UTF-8">
<meta name="viewport" content="width=320, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<?php include_once('../authen.php') ?>
<?php
    if(isset($_POST['submit'])){
        $detail = str_replace('../../../', './', $_POST['detail'] );
        $new_name = round(microtime(true)*9999) . '.' . end($temp);
        $url_upload = '../../../assets/images/blog/'.$new_name;
        
            $sql = "INSERT INTO `tb_request` (`emp_id`, `detail`, `created_by`, `req_type_id`, `is_close`) 
                    VALUES ('".$_POST['emp_id']."', 
                            '".$detail."',  
                            '".$_POST['created_by']."', 
                            '".$_POST['req_type_id']."', 
                            'NO')";
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