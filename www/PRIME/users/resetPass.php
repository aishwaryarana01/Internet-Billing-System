<?php
session_start();
$basepath = "../";
include_once($basepath."includes/IncSession.php");

if (isset($_SESSION['db_is_logged_in'])==true AND $usrStat=='1' AND $pUsers=='1' AND $usrType=='101' || $usrType=='102') { // if not logged in or no previllege, will redirect to logout page //

include_once($basepath."includes/header.php");	
include_once($basepath."includes/classMysql.php");
$classMySql = new class_mysql; 
?>

<script src="../js/jquery.validate.js" type="text/javascript"></script>	
<script type="text/javascript">

$(document).ready(function(){
	$("#addform").validate({
		debug: false,
		
		rules: {
				
				search: "required",
				pwd: {
					required: true,
					minlength: 5,
					//equalTo:"#oldpwd"
				},
				repwd: {
					required: true,
					minlength: 5,
					equalTo: "#pwd"
				}

			},
			messages: {
				search: "Select Username from the list",
												
				pwd: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				repwd: {
					required: "Please Retype a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				}
			},
		
		
		// if the validation is successfull //
		
		submitHandler: function(form) {
			// do other stuff for a valid form
			$.post('resetPassAct.php', $("#addform").serialize(), function(data) {
				$('#valid').html(data);
			});
		}
	});
});
</script>


<h1 class="colororange">Reset Portal User's Password </h1>
<fieldset>
<legend>Change Password</legend>
<form name="addform" id="addform" method="post">
	
	<div id="valid"></div>
	
	select user from the list and change his/her password<br><br>	
	
	<div class="leftfield">User Name : </div>
	<div class="rightfield">
		<select type="text" name="search" id="search" onChange='getRes();'> 
			<option value=""></option>
			<?php
				if($usrType=='101'){
					$sql = "SELECT usr_ids, usr_fullname, usr_email FROM user_tbl ORDER BY usr_fullname ASC";
				}else{
					$sql = "SELECT usr_ids, usr_fullname, usr_email FROM user_tbl WHERE usr_type<>'101' ORDER BY usr_fullname ASC";
				}
				$res = mysql_query($sql);
				while($row=mysql_fetch_assoc($res)){
				
				echo "<option value='".$row['usr_ids']."'>".$row['usr_fullname']." - ". $row['usr_email']."</option>";
				}
			?>
	</select></div>
	<div class="leftfield">Enter Password :</div> <div class="rightfield"><input type="password" name="pwd" id="pwd"></div>
	<div class="leftfield">Retype Password :</div> <div class="rightfield"><input type="password" name="repwd" id="repwd"></div>
	<div class="leftfield"></div><div class="rightfield"><input type="submit" value="Change Password"></div>
</form>


<?php
mysql_close();
include_once($basepath."includes/footer.php");
} else { // if not logged - redirect to login page
	echo ("<script> window.location='../logout.php?act=login&err=1';</script>");
} 
?>