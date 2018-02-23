<?php
session_start();
$basepath = "./";
include_once($basepath."includes/IncSession.php");

if (isset($_SESSION['db_is_logged_in'])==true AND $usrStat=='1' AND $usrType=='101' || $usrType=='102' || $usrType=='103') { // if not logged in or no previllege, will redirect to logout page //

	include_once($basepath."includes/header.php");
?>
<h1 class="colororange">Retrieve Active Session</h1>
<fieldset>
<legend>Active Session</legend>
<form name="formname" action="" method="POST" enctype="form/data" onsubmit="return validateForm()">
	
	Users are requested to enter ADSL user id and press submit button to <b>view ADSL Active Session</b> for the corresponding customer.<br>
	eg <b>adsl5544321 </b><br><br>
	<div class="bgline"></div><br>
	
	<div class="leftfield">ADSL User Id : </div>
	<div class="rightfield"><input type="text" name="telno" id="telno" maxlength="30">  <input type="submit" name="submit" value="Submit"></div>

</form>
</fieldset>


<script type="text/javascript">
function validateForm(){
	
	var phone	= document.formname.telno;	
	
	if(phone.value=="") {
		alert("ADSL User Id Missing !!!");
		phone.focus();
		return false;

	} 
	
	return true;
}


</script>

<?php 
	$submit = trim($_POST['submit']);

	if($submit){
		
		$adsl = trim($_POST['telno']);
	
		include_once("./includes/classMysql.php");
		$classMySql = new class_mysql;
		
		
			$sql = "SELECT * FROM tbl_adsl WHERE adsl_id='$adsl'";
		
		$res = mysql_query($sql);

		//echo $sql;
		
		if(mysql_num_rows($res)>0){
			$row=mysql_fetch_array($res);
			echo "ADSL ID : <b>".$row['adsl_id'];
			echo "</b><br>IP : <b>".$row['ip'];
			echo "</b><br>NAS Id : <b>".$row['nasid'];
			echo "</b><br>Caller Id : <b>".$row['callid'];
			echo "</b><br>Session :<b>" .$row['session']."</b>";
		}else{
			
			echo "<h2>ADSL Id not found !!!</h2>";
		}
		
	}
//ip	session	callid	nasid
	
	include_once ($basepath."includes/footer.php");
}else{
	echo("<script> window.location='logout.php';</script>");
}
?>







