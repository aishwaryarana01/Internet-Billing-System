<?php
session_start();
include_once("../includes/IncSession.php");

if($usrType=='101' || $usrType=='102' AND $pUsers=='1'){ // if not logged in or no previllege, will redirect to logout page //
		
	
	$name = trim(stripslashes($_POST['custname']));
	$login = trim(stripslashes($_POST['loginname']));
	$pass = sha1(trim(stripslashes($_POST['pwd']."#int@202!")));
	$type = trim(stripslashes($_POST['user_type']));
	$stat = trim(stripslashes($_POST['user_status']));
	$mail = trim(stripslashes($_POST['user_mail']));
	$reg = trim(stripslashes($_POST['region']));
	$off = trim(stripslashes($_POST['off']));
	$mob = trim(stripslashes($_POST['mobile']));
	$rem = trim(stripslashes($_POST['remarks']));
	
	//echo $login; echo $mail;
	$admCid 	= stripslashes($_POST['adm_cid']);					
	$admPwd 	= stripslashes($_POST['adm_pwd']);
	
	if($usrType=='101'){
	
		$admUser 	= stripslashes($_POST['adm_user']);
		$admExt 	= stripslashes($_POST['adm_ext']);

	}else{
		$admUser 	= 0;
		
	}
	
	$today = date('Y-m-d');

	echo "<div class='showres radius5'>";
	//echo $mtype;
	
	if($login==NULL || $pass==NULL || $mail==NULL){
		echo "Username / Password Empty";
	}else{

		include_once("../includes/classMysql.php");
		$classMySql = new class_mysql;
		
			$sql = "SELECT * FROM user_tbl WHERE usr_name='$login'";
			//echo $sql; die();
			$res = mysql_query($sql);
			$numrow = mysql_num_rows($res);
			//echo $numrow;

			//usr_adm_user, usr_adm_sites, usr_adm_alarm, usr_adm_problem, usr_adm_comment, usr_adm_email, usr_adm_report, usr_adm_team	

			if($numrow==0){
				//echo "<h3>Not Registered yet !!!</h3>";
				$sql_ins = "INSERT INTO user_tbl(usr_name, usr_pwd, usr_email, usr_fullname, usr_type, usr_status, usr_telno, usr_region, usr_office, created_by, created_on, usr_remarks, usr_adm_user, usr_adm_cid, usr_adm_pwd, usr_adm_ext)
				VALUES('$login', '$pass', '$mail', '$name', '$type', '$stat', '$mob', '$reg' , '$off', '$usrId', '$today', '$rem', '$admUser', '$admCid', '$admPwd', '$admExt')";
				
				//echo $sql_ins; die();
				
				$res_ins = mysql_query($sql_ins);
				if($res_ins){
					echo "User successfully Added !!!";
				}else{
					echo "Sorry Couldn't register at this time, try again later !!!";
				}
				
			}else{
				echo "User already exists in the Database  !!!";		
			}
		

	} // if not null
	echo "</div>";


mysql_close();	
}else{  echo ("<script> window.location='../logout.php?act=login&err=1';</script>"); }  // if not logged in //
?>
