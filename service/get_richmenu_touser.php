<?php
//Set Rich-Menu หลังจากที่ login
$access_token = '/AkzXmYbZGA2uOGnWtfd0ldrSOdZTE6ui91Z6JajRS+7T5FgbOCRMriY6zREVGx2drjWpzcPw2n+GlhKUT6lOqK7phvF2X71Q1hDYWo3CkicRorPvdQeoGrcrWHVjFGIq7LGwUE7rmu98o2yTUnQBAdB04t89/1O/w1cDnyilFU=';
$arrayHeader = array();
$Body = array();

// $richMenuId ="richmenu-b8fb4981a0a96b1b50a7b5968c23a68f";
$richMenuId = "richmenu-01cd430c1ad061d4adb06dd6e2a26929";

 $userID = [$user_line_id];
//$userID = "U85a345b9c369e7911349710d62b3db25";

$arrayHeader[] = "Authorization: Bearer {$access_token}";

if (count($userID) != 1) {
    $arrayHeader[] = "Content-Type: application/json";
    $Body[] = "richMenuId:$richMenuId";
    $Body[] = "userIds:$userID";
    print_r($arrayHeader);
    print_r($Body);
    echo (endpoint("https://api.line.me/v2/bot/richmenu/bulk/link", $arrayHeader, $Body));

} else {
    $Body[] = "richMenuId:$richMenuId";
    $Body[] = "userId:$userID[0]";
    // print_r($Body);
    echo (endpoint("https://api.line.me/v2/bot/user/$userID[0]/richmenu/$richMenuId", $arrayHeader, $Body));
}
function endpoint($url, $arrayHeader, $Body)
{
    $strUrl = $url;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $strUrl);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Body));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    //return $result;
}
//End Set Rich to User
?>