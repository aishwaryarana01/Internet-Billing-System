<?php
session_start();
$basepath = "./";
include_once($basepath."includes/IncSession.php");

if (isset($_SESSION['db_is_logged_in'])==true AND $usrStat=='1' AND $pExt=='1' AND $usrType=='101' || $usrType=='102') {
include_once($basepath."includes/header.php");	
include_once($basepath."includes/classMysql.php");
$classMySql = new class_mysql; 

	$tom = mktime(0,0,0,date("m"),date("d")+2, date ("y"));
	$extDate= date("Y-m-d",$tom);
	//$today =  strtoupper(date('d-M-y'));
	 $today = mktime(0,0,0,date("m"),date("d")+1, date ("y"));
	//$today = date('Y-m-d');
	//echo $today;
	$submit = trim($_POST['submit']);
	

	if($submit){
		
		$userid = $_POST['userid'];
		$chkdate = mysql_query("SELECT expiredate from tbl_adsl WHERE adsl_id='$userid'");
		$expdate = mysql_result($chkdate,'0','expiredate');
		
		if($expdate < date('Y-m-d') ){
			
			$tom = mktime(0,0,0,date("m"),date("d")+2, date ("y"));
			$extDate= date("Y-m-d",$tom);
			//echo $extDate;
			$sql_update = "UPDATE tbl_adsl SET expiredate='$extDate' WHERE adsl_id='$userid'";
			$res_update = mysql_query($sql_update);

			$sql_ins = "INSERT INTO ist_timeext(te_adsl_user, te_extendto, te_remarks, te_chg_by, te_ip) VALUES ('$telno', '$extDate', '$rem', '$usrId', '$ip')";
			//echo $sql_ins;
			$res_ins = mysql_query($sql_ins);					
			header("location:timeextension.php?err=0&dat=$newdate");
		

		} else{
			echo "still active";
		}
		
	
	}else{ // if not submitted
		header("location:timeextension.php?err=3&dat=$newdate");
	}
		
	//include_once ($basepath."includes/footer.php");
	mysql_close();
}else{
	header("location:logout.php?err=1");
}
?>
