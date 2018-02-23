<?php
session_start();
$basepath = "./";
include_once($basepath."includes/IncSession.php");

if (isset($_SESSION['db_is_logged_in'])==true AND $usrStat=='1' AND $pExt=='1' AND $usrType=='101' || $usrType=='102') {
include_once($basepath."includes/header.php");	
include_once($basepath."includes/classMysql.php");
$classMySql = new class_mysql; 

$err = stripslashes($_REQUEST['err']);
$dat = stripslashes($_REQUEST['dat']);
if($err=='0'){
	$msg = '<br><h3 class=colorgreen>Time Extended Successfully to '.$dat.' !!!</h3>';
}else if($err=='1'){
	$msg = '<br><h3 class=colorblue>User Already Active (Expiry Date: '.$dat.') !!!</h3>';
}else if($err=='2'){
	$msg = '<br><h3 class=colorblue>User Id not found !!!</h3>';
}else if($err=='3'){
	$msg = '<br><h3 class=colorblue>Invalid Request Post !!!</h3>';
}
?>
<h1 class="colororange">Time Extension</h1>
<?php echo $msg?>
<fieldset>
<legend>Add 2 Days</legend>
<form name="formname" action="timeextensionAct.php" method="POST" enctype="form/data" onsubmit="return validateForm()">
	
	Users are requested to check the valid date and status of the Adsl User then enter ADSL User Id and press submit button to <b>add 2 days of extension to expiry date</b> of the corresponding customer.<br>
	For example <b>adsl5544132</b><br><br>
	<div class="bgline"></div><br>
	
	<div class="leftfield">ADSL User Id : </div>
	<div class="rightfield"><input type="text" name="userid" id="userid" maxlength="20"></div>
	
	<div class="leftfield">Remarks : </div>
	<div class="rightfield"><select name="ref"><option value="As Referred ">As Referred By</option> <option value="Customers Late Arrival ">Customers Late Arrival </option></div> <input type="text" name="remarks" id="remarks" size="50"></div>
	

	<div class="leftfield"></div>
	<div class="rightfield"> <input type="submit" name="submit" value="Add 2 Days"></div>
	
</form>
</fieldset>


<script type="text/javascript">

function validateForm(){
	
	var uid	= document.formname.userid;	
	var rem	= document.formname.remarks;
	
	// at lease one number is a must
	var invalid = " "; // checks space var
	re = /[0-9]/; 	


	if(uid.value=="") {
		alert("User Id is Missing !!!");
		uid.focus();
		return false;

	} else if(rem.value=="") {
		alert("Enter Remarks  !!!");
		rem.focus();
		return false;
	
	}
	
	return true;
}
</script>

<?php 
	include_once ($basepath."includes/footer.php");
}else { // if not logged in redirect to logout page
	header("location:logout.php?err=1");	
}
?>
