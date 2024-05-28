<?php
//กำหนดค่า Access-Control-Allow-Origin ให้ เครื่อง อื่น ๆ สามารถเรียกใช้งานหน้านี้ได้
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once '../php/connect.php';

try {
    $user_line_id = $conn->real_escape_string($_POST['user_line_id']);
    //$user_line_id = "Ud7d88bd790e06b9b78aad3b576ebc149";
    $sqlLineID = "SELECT username,user_line_id FROM tb_register WHERE user_line_id = '" . $user_line_id . "' ";
    $resultLindId = $conn->query($sqlLineID);
    $row_lineID = $resultLindId->fetch_assoc();
    $username = $row_lineID['username'];

    $sqlRequest = "SELECT id,emp_id FROM tb_request WHERE emp_id = '" . $username . "' ORDER BY id DESC LIMIT 0 , 1";
    $resultRequest = $conn->query($sqlRequest);
    $row_Request = $resultRequest->fetch_assoc();
    $id = $row_Request['id'];

    $sql = "SELECT *,a.id AS req_id 
    FROM tb_request a
        INNER JOIN tb_employee b 
          ON a.emp_id = b.emp_id 
            WHERE a.id = '" . $id . "' ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    //echo json_encode(['status' => 'ok', 'messageRequest' => $row], JSON_UNESCAPED_UNICODE);
    $sql_tracking = "SELECT * FROM tb_tracking AS t INNER JOIN tb_status AS s ON s.id = t.status_id WHERE t.request_id = '" . $id . "' AND t.active = 'true' ORDER BY t.id ASC ";
    $result_tracking = $conn->query($sql_tracking);
    $row_tracking_all = array();
    while ($row_tracking = $result_tracking->fetch_assoc()) {
        $row_tracking_all[] = $row_tracking;
    }
    echo json_encode(['status' => 'ok', 'result_tracking' => $row_tracking_all, 'profile' => $row], JSON_UNESCAPED_UNICODE);
} catch (SoapFault $e) {
    echo json_encode(['status' => 'not', 'message' => 'steperor']);
}
