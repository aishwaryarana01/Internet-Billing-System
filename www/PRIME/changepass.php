<?php
session_start();
$basepath = "./";
include_once($basepath."includes/IncSession.php");

if (isset($_SESSION['db_is_logged_in'])==true AND $usrStat=='1') {
include_once($basepath."includes/header.php");	
include_once($basepath."includes/classMysql.php");
$classMySql = new class_mysql; 

		$submitted	= $_POST['submitted'];
		$sql="select * from user_tbl where usr_ids=$usrId";
			//$result=mysql_query($sql);
			$result = mysql_query($sql);
			
			
			if ($row=mysql_fetch_array($result)) {
				//$email=$row['email'];
				//$custId	= $row['id'];
				$pwd	= $row['usr_pwd'];
				$id	= $row['usr_ids'];
						
			}

			if ($submitted) {
				$old_pwd = $_POST['old_pwd'];
				$new_pwd = $_POST['new_pwd'];
				
				if ($pwd!= SHA1($old_pwd)) {
					//print $old_pwd;
					$err = 1;
				} else {
					
					$encPwd  = SHA1($new_pwd);
					$pwQuery = "UPDATE user_tbl SET usr_pwd='$encPwd' where usr_ids='$usrId'";
					$result=mysql_query($pwQuery);
					if($result) { $done = 1; }
				}
			}
			?>



			<script>
			function validateForm()
			{
				var oldpass = document.pwdForm.old_pwd;
				var pass = document.pwdForm.new_pwd;
				var pass2 = document.pwdForm.new_con_pwd;
				
				var invalid = " "; // checks space var
				re = /[0-9]/; 
				
				if ((oldpass.value==null)||(oldpass.value==""))
				{
					alert("Please Enter your old password");
					pass1.focus();
					return false;
				}
				if((pass.value==null)||(pass.value==""))
				{
					alert("Please Enter your new password");
					pass.focus();
					return false;
				}
				
				
				if(pass.value.length < 6) { 
					alert("Password must contain at least Six Characters!"); 
					pass.focus(); 
					return false; 

				} 
				
				if(!re.test(pass.value)) { 
					alert("Password must contain at least one number (0-9)!"); 
					pass.focus(); 
					return false; 
				}
				// check for spaces
				if (pass.value.indexOf(invalid) > -1) {
					alert("Sorry, spaces are not allowed in password.");
					pass.focus();
					return false;
				}

				if((pass2.value==null)||(pass2.value==""))
				{
					alert("Please retype your new password");
					pass1.focus();
					return false;

				} 
				if(!(pass.value==pass2.value)){
					alert("Retyped Password mismatch");
					pass2.focus();
					return false;
		
				} 




					return true;
			}
			</script>
			
<h1 class="colororange">Change Your Portal Password</h1>			
<fieldset>
<legend>Change  Password</legend>
		
		<?
			if($done==1){
		?>
				
						<div align="center"><B>Password Successfully Changed</B>
						<br><br><br>
						Please go <a href="./logout.php" class="small"><b>BACK</b></a> 
						and login with your new password <br>
						</div>

		<?php }else{ ?>
			
			
			<form name="pwdForm" method="post" onSubmit="return validateForm()" action="#">
					<div class="leftfield">User's Name : </div><div class="rightfield"><b><?=$usrName?></b></div>
					<div class="leftfield">Old Password : </div>
					<div class="rightfield">
						<input type="password" name="old_pwd" maxlength="15">
						<?php if($err==1){ echo "<br><b class='colorgreen'><i>Old password doesn't match. Please re-enter !! </i></b>";} ?>
					</div>
					<div class="leftfield">New Password : </div><div class="rightfield"><input type="password" name="new_pwd" maxlength="15"></div>
					<div class="leftfield">Retype New Password : </div><div class="rightfield"><input type="password" name="new_con_pwd" maxlength="15"></div>
					<div class="leftfield"></div>
					<div class="rightfield">
						<input type="hidden" name="action" value="add" ><input type="submit" name="submitted" value="Submit" class="btns"><input type="reset" value="Clear" name="reset" class="btns">
					</div>
				  
				</form>
			<?
				}
			?>
		

</fieldset>


<?php 
	include_once ($basepath."includes/footer.php");
}else{
	echo("<script> window.location='logout.php';</script>");
}
?>