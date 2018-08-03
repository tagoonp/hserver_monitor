<?php
include "config.class.php";
include "database.fnc.php";

if(!isset($_GET['uid'])){
  disconnect($conn);
  die();
}

$uid = mysqli_real_escape_string($conn, $_GET['uid']);

$strSQL = "SELECT * FROM server
           WHERE
            s_uid = '$uid' AND s_status = '1'";
$result = select($conn, $strSQL);

if($result){
  echo json_encode($result);
}

disconnect($conn);
die();
?>
