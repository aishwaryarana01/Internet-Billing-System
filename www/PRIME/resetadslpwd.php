<?php
session_start();
$basepath = "./";
include_once($basepath."includes/IncSession.php");

if (isset($_SESSION['db_is_logged_in'])==true AND $usrStat=='1' AND $pPwd=='1' AND $usrType=='101' || $usrType=='102' || $usrType=='103') { // if not logged in or no previllege, will redirect to logout page //
include_once($basepath."includes/header.php");
$err = stripslashes($_REQUEST['err']);
if($err=='0'){
	$msg = '<br><h3 class=colorgreen>Password Changed Successfully !!!</h3>';
}else if($err=='1'){
	$msg = '<br><h3 class=colorblue>User Id not found !!!</h3>';
}else if($err=='2'){
	$msg = '<br><h3 class=colorblue>Invalid Request Post !!!</h3>';
}

?>
<h1 class="colororange">Reset ADSL A/c Password</h1>

<?php echo $msg?>

<fieldset>
<legend>Change Password</legend>
<form name="formname" action="resetadslpwdAct.php" method="POST" enctype="form/data" onsubmit="return validateForm()">
	
	Users are requested to enter ADSL User Id  and press submit button to <b>reset ADSL A/c Password</b> for the corresponding customer.<br>
	For example <b>adsl5544132</b><br><br>
	<div class="bgline"></div><br>
	
	<div class="leftfield">ADSL User Id : </div>
	<div class="rightfield"><input type="text" name="userid" id="userid" maxlength="20"></div>
	
	<div class="leftfield">Password : </div>
	<div class="rightfield"><input type="password" name="pwd" id="pwd" size="30"></div>
	
	<div class="leftfield">Re-Type Password : </div>
	<div class="rightfield"><input type="password" name="repwd" id="repwd" size="30"> </div>
	
	<div class="leftfield"></div>
	<div class="rightfield"> <input type="submit" name="submit" value="Change Pwd"></div>
	
</form>
</fieldset>


<script type="text/javascript">

function validateForm(){
	
	var uid	= document.formname.userid;	
	var pass	= document.formname.pwd;
	var repass	= document.formname.repwd;
	
	// at lease one number is a must
	var invalid = " "; // checks space var
	re = /[0-9]/; 	


	if(uid.value=="") {
		alert("User Id is Missing !!!");
		uid.focus();
		return false;

	} else if(pass.value=="") {
		alert("Enter Password !!!");
		pass.focus();
		return false;
	
	} else if(pass.value.length < 6) { 
		alert("Password must contain at least Six Characters!"); 
		pass.focus(); 
		return false; 

	//} else if(!re.test(pass.value)) { 
		//alert("Password must contain at least one number (0-9)!"); 
		//pass.focus(); 
		//return false; 
	}
	// check for spaces
	else if (pass.value.indexOf(invalid) > -1) {
		alert("Sorry, spaces are not allowed in password.");
		pass.focus();
		return false;
		
	} else if(repass.value=="") {
		alert("Retype  Password !!!");
		repass.focus();
		return false;
	
	} 
	
	if (repass.value == pass.value)	{
		return true;
	} else {
		alert ("Password Mismatch !!!");
		repass.focus();
		return false;
	}
	
	return true;
}
</script>

<?php
	include_once ($basepath."includes/footer.php");
}else{
	// if not logged in redirect to logout page
	header("location:logout.php?err=1");	
}
?>
