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
                } else {
                    echo json_encode(['status' => 'not', 'message' => 'incorect'],JSON_UNESCAPED_UNICODE);
                }
            } else {
                echo json_encode(['status' => 'not', 'message' => 'notconnectIDM'],JSON_UNESCAPED_UNICODE);
            }
        } else {
            echo json_encode(['status' => 'not', 'message' => 'notconnectIDM'],JSON_UNESCAPED_UNICODE);
        }
    } else {
        echo json_encode(['status' => 'not', 'message' => 'steperor'],JSON_UNESCAPED_UNICODE);
    }
} catch (SoapFault $e) {
    echo json_encode(['status' => 'not', 'message' => 'steperor'],JSON_UNESCAPED_UNICODE);
    //$output[] = "step ERROR !";
    // print_r($e);
}
