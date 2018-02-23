<?php
session_start();
$basepath = "./";
include_once($basepath."includes/IncSession.php");

if (isset($_SESSION['db_is_logged_in'])==true AND $usrStat=='1' AND $pCid=='1' AND $usrType=='101' || $usrType=='102' || $usrType=='103') { // if not logged in or no previllege, will redirect to logout page //

	//include_once($basepath."includes/header.php");

	$submit = trim($_POST['submit']);
	if($submit){
		
		$telno = trim($_POST['userid']);
		$pass = trim($_POST['pwd']);
		$ip = $_SERVER["REMOTE_ADDR"];			
		
				
		include_once("./includes/classMysql.php");
		$classMySql = new class_mysql;

		$sql_update = "UPDATE tbl_adsl SET callid='' WHERE adsl_id='$telno'";
		$res_update = mysql_query($sql_update);

		if($res_update){
			$sql_ins = "INSERT INTO ist_chgcid(cc_adsl_user, cc_chg_by, cc_ip) VALUES ('$telno', '$usrId', '$ip')";
			$res_ins = mysql_query($sql_ins);
		}
		
		
		
		header("location:portbind.php?err=0&act=bind");
		//echo "<h2 class=colororange>Port Bind Removed Successfully !!!</h2>";				

		
		
	}else{ // if not submitted
		header("location:portbind.php?err=2&act=bind");
	}
	
	mysql_close();
	//include_once ($basepath."includes/footer.php");
}else{
	header("location:logout.php?err=1");
}
?>
