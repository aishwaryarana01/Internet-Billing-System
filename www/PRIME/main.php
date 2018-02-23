<?php
session_start();
$basepath = "./";
include_once($basepath."includes/IncSession.php");

if (isset($_SESSION['db_is_logged_in'])==true AND $usrStat=='1') {
include_once($basepath."includes/header.php");




?>





<?php 
	include_once ($basepath."includes/footer.php");
}else{
	echo("<script> window.location='logout.php';</script>");
}
?>

