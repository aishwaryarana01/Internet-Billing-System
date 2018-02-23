<?php
session_start();
$basepath = "./";
include_once($basepath."includes/IncSession.php");

if (isset($_SESSION['db_is_logged_in'])==true AND $usrStat=='1' AND $usrType=='101' || $usrType=='102' || $usrType=='103') { // if not logged in or no previllege, will redirect to logout page //

	include_once($basepath."includes/header.php");
?>
<h1 class="colororange">View Active/Inactive Status</h1>
<fieldset>
<legend>Account Status</legend>
<form name="formname" action="" method="POST" enctype="form/data" onsubmit="return validateForm()">
	
	Users are requested to enter ADSL user id or Phone No with area code and press submit button to <b>view ADSL status </b> for the corresponding customer.<br>
	eg <b>adsl5544321 or 015544123</b>, please use 0(zero) before area code.<br><br>
	<div class="bgline"></div><br>
	<div class="leftfield">Search By : </div>
	<div class="rightfield"><input type="radio" name="searchby" id="searchby" value="adsl" checked="checked"> ADSL User Id   <input type="radio" name="searchby" id="searchby" value="tel">  Phone No</div>
	<div class="leftfield">ADSL User Id/ Phone No : </div>
	<div class="rightfield"><input type="text" name="telno" id="telno" maxlength="30">  <input type="submit" name="submit" value="Submit"></div>

</form>
</fieldset>


<script type="text/javascript">
function validateForm(){
	
	var phone	= document.formname.telno;	
	
	var invalid = " "; // checks space var
	re = /[0-9]/;
	
	if(phone.value=="") {
		alert("ADSL User Id/Phone No is Missing !!!");
		phone.focus();
		return false;

	} 
	
	if (( document.formname.searchby[1].checked == true )) {
				
		if(isNaN(phone.value)==true){
			alert("Enter a Valid Number");		
			return false;
		}else if(phone.value.length < 9 ||  phone.value.length > 9){
			
			alert("Enter a Valid 9 Digit Number starting with 0");
			return false;
		}
	}
	
	return true;
}


</script>

<?php 
	$submit = trim($_POST['submit']);

	if($submit){
		
		$adsl = $_POST['telno'];
		$search = $_POST['searchby'];

		include_once("./includes/classMysql.php");
		$classMySql = new class_mysql;
		
		if($search=='adsl'){
			$sql = "SELECT * FROM tbl_adsl WHERE adsl_id='$adsl'";
		}else{
			$sql = "SELECT * FROM tbl_adsl WHERE phoneno='$adsl'";
		}
		$res = mysql_query($sql);

		//echo $sql;
		
		if(mysql_num_rows($res)>0){
			$row=mysql_fetch_array($res);
			echo "ADSL ID : <b>".$row['adsl_id'];
			echo "</b><br>Expire Date : <b>".$row['expiredate'];
			echo "</b><br>Status :<b>" .$row['status']."</b>";
		}else{
			
			echo "<h2>ADSL Id not found !!!</h2>";
		}
		
		
		
		
	}

	
	include_once ($basepath."includes/footer.php");
}else{
	echo("<script> window.location='logout.php';</script>");
}
?>







