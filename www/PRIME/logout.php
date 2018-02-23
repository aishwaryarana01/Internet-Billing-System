<?php
session_start();
//include_once("includes/IncSession.php");
include_once("includes/classMysql.php");
$classMySql = new class_mysql;
$sessId = session_id();
$sql = "UPDATE user_log SET lg_logout_date='".date('Ymd')."', lg_logout_time='".date('H:i:s')."', lg_log_status='0' WHERE lg_sessionid='$sessId'" ;
//echo $sql; die();
$result = mysql_query($sql);

//echo $ses;die();
$_SESSION=null;
session_destroy();
session_unset();
print "<script>window.location='index.php'</script>";
?>

