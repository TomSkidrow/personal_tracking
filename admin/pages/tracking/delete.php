<meta charset="UTF-8">
<meta name="viewport" content="width=320, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<?php include_once('../authen.php') ?>
<?php
    if (isset($_GET['id'])){
        $sql = "DELETE FROM `tb_request` WHERE `id` = '".$_GET['id']."' ";
        $result = $conn->query($sql);
        $sql2 = "DELETE FROM `tb_tracking` WHERE `request_id` = '".$_GET['id']."' ";
        $result2 = $conn->query($sql2);

        if( $conn->affected_rows ){
            echo '<script> alert("ลบข้อมูลสำเร็จ!")</script>'; 
            header('Refresh:0; url=index.php'); 
        } else {
            echo '<script> alert("ไม่มีข้อมูล!")</script>'; 
            header('Refresh:0; url=index.php');
        }

    } else {
        header('Refresh:0; url=index.php');
    }

?>