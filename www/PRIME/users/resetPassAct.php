<?php
session_start();
include_once("../includes/IncSession.php");

if($usrType=='101' ||  $usrType=='102' AND $pUsers=='1' AND $usrStat){ // if not logged in or no previllege, will redirect to logout page //

	
	$search = stripslashes(trim($_POST['search']));
	$pwd = stripslashes(trim($_POST['pwd']));
	

	echo "<div class='showres radius5'>";
	//echo $mtype;
	if($search=='' || $pwd=='' ){
		echo "User Name or Password Empty";
	}else{

		include_once("../includes/classMysql.php");
		$classMySql = new class_mysql;
			$pwdnew = SHA1($pwd);
			
			$sqlPass = "UPDATE user_tbl SET usr_pwd='".$pwdnew."' WHERE usr_ids='$search'";
			//echo $sql;
			$resPass = mysql_query($sqlPass);
				

			if($resPass){
				echo "Password Changed Successfully !!!";
			}else{
				echo "Couldn't change password at this time, try again later  !!!";		
			}
		

	} // if not null
	echo "</div>";

mysql_close();
} else { // if not logged - redirect to login page
	echo ("<script> window.location='../logout.php?act=login&err=1';</script>");
} 
?>