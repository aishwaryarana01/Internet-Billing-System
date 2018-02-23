<?php
session_start();
$basepath = "./";
include_once($basepath."includes/IncSession.php");

if (isset($_SESSION['db_is_logged_in'])==true AND $usrStat=='1' AND $pCid=='1' AND $usrType=='101' || $usrType=='102' || $usrType=='103') { // if not logged in or no previllege, will redirect to logout page //

	include_once($basepath."includes/header.php");
	
	$err = stripslashes($_REQUEST['err']);
	//$dat = stripslashes($_REQUEST['dat']);
	if($err=='0'){
		$msg = '<br><h3 class=colorgreen>Port Bind Resetted Successfully !!!</h3>';
	}else if($err=='1'){
		$msg = '<br><h3 class=colorblue>User Id not found !!!</h3>';
	}else if($err=='2'){
		$msg = '<br><h3 class=colorblue>Invalid Request Post !!!</h3>';
	}
?>

<h1 class="colororange">Reset Port Bind</h1>
<?php echo $msg?>
<fieldset>
<legend>Do Next Call</legend>
<form name="formname" action="portbindAct.php" method="POST" enctype="form/data" onsubmit="return validateForm()">
	
	Users are requested to enter ADSL user id and press submit button to <b>reset the port bind to next call</b> for the corresponding customer.<br>
	eg <b>adsl5544321</b><br><br>
	<div class="bgline"></div><br>
	<div class="leftfield">ADSL User Id : </div>
	<div class="rightfield"><input type="text" name="userid" id="userid" maxlength="20">  <input type="submit" name="submit" value="Submit"></div>

</form>
</fieldset>


<script type="text/javascript">
function validateForm(){
	
	var phone	= document.formname.telno;	
	if(phone.value=="") {
		alert("Phone Number is Missing !!!");
		phone.focus();
		return false;

	} 
	
	return true;
}
</script>

<?php 
	include_once ($basepath."includes/footer.php");
}else{
	header("location:logout.php?err=1");
}
?>
