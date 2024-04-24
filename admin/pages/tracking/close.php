<meta charset="UTF-8">
<meta name="viewport" content="width=320, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<?php include_once('../authen.php') ?>
<?php
    if (isset($_GET['id'])){
        $sql = "UPDATE `tb_request` SET `is_close` = 'YES' WHERE `id` = '".$_GET['id']."' ";
        $result = $conn->query($sql);

        if( $conn->affected_rows ){
            echo '<script> alert("ปิดคำร้องสำเร็จ!")</script>'; 
            header('Refresh:0; url=index.php'); 
        } else {
            echo '<script> alert("ไม่มีข้อมูล!")</script>'; 
            header('Refresh:0; url=index.php');
        }

    } else {
        header('Refresh:0; url=index.php');
    }

?>