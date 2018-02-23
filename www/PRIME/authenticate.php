<?php
session_start();
//$old_sessionid = session_id();
session_regenerate_id();
$sessId = session_id();

$basepath = "./";
include_once($basepath."includes/classMysql.php");
$classMySql = new class_mysql;

$submit 	= $_POST['submitted'];
//$userName	= trim(mysql_real_escape_string($_POST['username']));
//$pwd		= trim(mysql_real_escape_string($_POST['pwd']));

$userName	= mysql_real_escape_string(stripslashes(trim($_POST['username'])));
$pwd		= mysql_real_escape_string(stripslashes(trim($_POST['pwd'])));



if(!$submit==Null || !$userName==Null || !$pwd==Null){
	
	$sqlStatement = "SELECT * FROM user_tbl WHERE usr_name='$userName' AND usr_status ='1'";
	$selectResult = mysql_query($sqlStatement);

	//echo $sqlStatement; die();
	
	if ($row=mysql_fetch_array($selectResult)) {
		
		$usrId		= $row['usr_ids'];
		$usrName	= $row['usr_name'];
		$usrStat	= $row['usr_status'];
		$usrType	= $row['usr_type'];
		$usrPass	= $row['usr_pwd'];	
		$usrEmail	= $row['usr_email'];
		$usrReg 	= $row['usr_region'];
		$usrFullName 	= $row['usr_fullname'];

		$pUsers		= $row['usr_adm_user'];
		$pCid		= $row['usr_adm_cid'];
		$pPwd		= $row['usr_adm_pwd'];
		$pExt		= $row['usr_adm_ext'];


		if (sha1($pwd)==$usrPass) {			
			
			//session_register("SESSION");
			$_SESSION['db_is_logged_in']	= true;
			$_SESSION['usr_ids']			= $usrId;
			$_SESSION['usr_name']			= $usrName;
			$_SESSION['usr_type']			= $usrType;
			$_SESSION['usr_status']			= $usrStat;
			$_SESSION['usr_email']			= $usrEmail;
			$_SESSION['usr_region']			= $usrReg;
			$_SESSION['usr_fullname']		= $usrFullName;
			
			$_SESSION['usr_adm_user']		= $pUsers;	
			$_SESSION['usr_adm_cid']		= $pCid;	
			$_SESSION['usr_adm_pwd']		= $pPwd;	
			$_SESSION['usr_adm_ext']		= $pExt;

									
			// INSERT QUERY FOR USER LOG TABLE//
			
			$queryLog = "INSERT INTO user_log (lg_user,lg_login_date,lg_login_time, lg_ipadd, lg_sessionid,lg_log_status) VALUES (".$usrId.", '".date('Ymd')."', '".date('H:i:s')."', '".$_SERVER["REMOTE_ADDR"]."', '$sessId', '1')";
			$resultLog = mysql_query($queryLog);
				
			print("<script> window.location='main.php';</script>");
				
		
		} else {
			
			header("Location:index.php?act=mismatch&err=1");
			//print("<script> window.location='index.php?act=mismatch&err=1';</script>");
		} 

	} else {
		
		header("Location:index.php?act=mismatch&err=3");
	}

}else{
	header("Location:index.php?act=mismatch&err=3");
}

?>

