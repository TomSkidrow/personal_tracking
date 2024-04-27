<?php
//กำหนดค่า Access-Control-Allow-Origin ให้ เครื่อง อื่น ๆ สามารถเรียกใช้งานหน้านี้ได้
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once '../php/connect.php';

try {
    if (isset($_POST['username'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $user_line_id = $conn->real_escape_string($_POST['user_line_id']);
        $line_displayname = $conn->real_escape_string($_POST['line_displayname']);
        //$user_line_id = "3349923";
        //$line_displayname = "LAN_TPP";
        $sql = "SELECT * FROM `tb_register` WHERE `username` = '" . $username . "' ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if (empty($row)) {
            $sql1 = "SELECT * FROM `tb_register` WHERE `user_line_id` = '" . $user_line_id . "' ";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
            if (empty($row1)) {
                $sqlInser = "INSERT INTO `tb_register` (`username`, `user_line_id`, `line_displayname`) 
                    VALUES ('" . $username . "',
                            '" . $user_line_id . "', 
                            '" . $line_displayname . "')";
                $resultInsert = $conn->query($sqlInser) or die($conn->error);
                if ($resultInsert) {
                    echo json_encode(['status' => 'ok', 'message' => 'success']);
                    include 'get_richmenu_touser.php';
                }else{
                    echo json_encode(['status' => 'not', 'message' => 'Not Insert Data']);
                }
            }else{
                echo json_encode(['status' => 'notIDline', 'message' => 'ID LINE not avalible']);
            }
        }else{
            echo json_encode(['status' => 'notuser', 'message' => 'User not avalible']);
        }
    }
} catch (SoapFault $e) {
    echo json_encode(['status' => 'not', 'message' => 'steperor']);
}
?>