<?php
session_start();
include_once("../includes/IncSession.php");

if($usrType=='101' || $usrType=='102' AND $pUsers=='1'){ // if not logged in or no previllege, will redirect to logout page //
		
	
	$name = trim(stripslashes($_POST['custname']));
	$login = trim(stripslashes($_POST['loginname']));
	//$pass = md5(trim(stripslashes($_POST['pwd'])));
	$type = trim(stripslashes($_POST['user_type']));
	$stat = trim(stripslashes($_POST['user_status']));
	$mail = trim(stripslashes($_POST['user_mail']));
	$reg = trim(stripslashes($_POST['region']));
	$off = trim(stripslashes($_POST['off']));
	$mob = trim(stripslashes($_POST['mobile']));
	$rem = trim(stripslashes($_POST['remarks']));

	$admCid 	= stripslashes($_POST['adm_cid']);					
	$admPwd 	= stripslashes($_POST['adm_pwd']);

	
	
	if($usrType=='101'){
		
		$admUser 	= stripslashes($_POST['adm_user']);

		$admExt 	= stripslashes($_POST['adm_ext']);

		
	}else{
		$admUser 	= 0;
		$admExt 	= 0; 		
	}
	
	$id = trim(stripslashes($_POST['eid']));	

	$today = date('Y-m-d');

	echo "<div class='showres radius5'>";
	//echo $mtype;
	
	if($name==NULL || $mail==NULL){
		echo "User Name or Email Id Missing";
	}else{

		include_once("../includes/classMysql.php");
		$classMySql = new class_mysql;
		
			$sql = "SELECT * FROM user_tbl WHERE usr_name='$login' AND usr_ids<>'$id'";
			//echo $sql; die();
			$res = mysql_query($sql);
			$numrow = mysql_num_rows($res);
			//echo $numrow;

			if($numrow==0){

				$sql_ins = "UPDATE user_tbl SET usr_name='$login',  usr_email='$mail', usr_fullname='$name', usr_type='$type', usr_status='$stat', usr_telno='$mob', usr_region='$reg', usr_office='$off', usr_remarks='$rem', usr_adm_user='$admUser', usr_adm_cid='$admCid', usr_adm_pwd='$admPwd', usr_adm_ext='$admExt'  WHERE usr_ids='$id'";
					
				//echo $sql_ins; die();
				
				$res_ins = mysql_query($sql_ins);
				if($res_ins){
					echo "User Edited Successfully  !!!";
				}else{
					echo "Sorry Couldn't Edit at this time, try again later !!!";
				}
				
			}else{
				echo "Login Name Already Registered  !!!";		
			}
		

	} // if not null
	echo "</div>";


mysql_close();	
}else{  echo ("<script> window.location='../logout.php?act=login&err=1';</script>"); }  // if not logged in //
?>
