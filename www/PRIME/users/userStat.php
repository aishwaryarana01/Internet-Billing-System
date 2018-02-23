<?php
session_start();
include_once("../includes/IncSession.php");

if($usrType=='101' || $usrType=='102' AND $pUsers=='1'){ // if not logged in or no previllege, will redirect to logout page //

include_once("../includes/classMysql.php");
$classMySql = new class_mysql;


	// if the user exists in database
	function user_exists($id){
		$id = (int)$id;
		return (mysql_result(mysql_query("SELECT COUNT('usr_ids') FROM user_tbl WHERE usr_ids='$id'"),0)==0) ? false : true;
	}

	
	// change active/inactive status
	function stat_chg($id){
		$id = (int)$id;
		
		if(mysql_result(mysql_query("SELECT usr_status FROM user_tbl WHERE usr_ids=$id"),0)==0){		
			mysql_query("UPDATE user_tbl SET usr_status=1 WHERE usr_ids=$id");
			echo  'Active';
		}else{		
			mysql_query("UPDATE user_tbl SET usr_status=0 WHERE usr_ids=$id");
			echo 'Inactive';
		}
		
		
	}

	//******************************************//

	$id = $_POST['id'];
	stat_chg($id);
	
mysql_close();	
}else{  echo ("<script> window.location='../logout.php?act=login&err=1';</script>"); }  // if not logged in //
?>