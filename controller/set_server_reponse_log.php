<?php
include "config.class.php";
include "database.fnc.php";

if(!isset($_GET['uid'])){
  disconnect($conn);
  die();
}

if(!isset($_GET['ip'])){
  disconnect($conn);
  die();
}

if(!isset($_GET['response'])){
  disconnect($conn);
  die();
}

$uid = mysqli_real_escape_string($conn, $_GET['uid']);
$ip = mysqli_real_escape_string($conn, $_GET['ip']);
$response = mysqli_real_escape_string($conn, $_GET['response']);

$strSQL = "INSERT INTO server_response_log (sr_ip, sr_datetime, sr_status, sr_uid)
           VALUES ('$ip', '$sys_datetime', '$response', '$uid')";
$result = insert($conn, $strSQL, false);
// if($result){
//   echo "Y";
// }else{
//   echo $strSQL;
// }
disconnect($conn);
die();
?>
