<?php
define('LINE_API','https://notify-api.line.me/api/notify');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



include "config.class.php";

if(!isset($_GET['ip'])){
  die();
}


$ip = mysqli_real_escape_string($conn, $_GET['ip']);
//
$token = 'G5p0dMLnYTmvFBnZa3QzLI3aK3B50lOMBE0T6Lk7vPS'; //ใส่Token ที่copy เอาไว้
$str = 'Server IP: '.$ip.' not active or no response on '.$sys_datetime; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
//
$res = notify_message($str,$token);
print_r($res);
function notify_message($message,$token){
 $queryData = array('message' => $message);
 $queryData = http_build_query($queryData,'','&');
 $headerOptions = array(
         'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".$token."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
         )
 );
 $context = stream_context_create($headerOptions);
 $result = file_get_contents(LINE_API, FALSE, $context);
 $res = json_decode($result);
 return $res;
}
?>
