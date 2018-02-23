<?php
session_start();
$basepath = "./";
include_once($basepath."includes/IncSession.php");

if (isset($_SESSION['db_is_logged_in'])==true AND $usrStat=='1' AND $pPwd=='1' AND $usrType=='101' || $usrType=='102' || $usrType=='103') { // if not logged in or no previllege, will redirect to logout page //
//include_once($basepath."includes/header.php");
	
	$submit = trim($_POST['submit']);

	if($submit){
		
		$telno = trim($_POST['userid']);
		$pass = trim($_POST['pwd']);
		$ip = $_SERVER["REMOTE_ADDR"];		
				
		include_once("./includes/classMysql.php");
		$classMySql = new class_mysql;
		
		$sql_update = "UPDATE tbl_adsl SET adslpass='$pass' WHERE adsl_id='$telno'";
		$res_update = mysql_query($sql_update);

		if($res_update){
			$sql_ins = "INSERT INTO ist_chgpwd(cp_adsl_user, cp_adsl_pwd, cp_chg_by, cp_ip) VALUES ('$telno', '$pass', '$usrId', '$ip')";
			//echo $sql_ins;
			$res_ins = mysql_query($sql_ins);
		}


		header("location:resetadslpwd.php?err=0&act=pwd");
			
		
		
	}else{
		header("location:resetadslpwd.php?err=2&act=pwd");
	}
	mysql_close();	
}else{ // if not logged in redirect to logout page
	header("location:logout.php?err=1");	
}
?>
