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
			
			custname: "required",
			loginname: "required",
			pwd: {
				required: true,
				//minlength: 5
			},
			repwd: {
				required: true,
				//minlength: 5,
				equalTo: "#pwd"
			},				

			user_type: "required",				
			user_status: "required",	
			user_mail: {
				required: true,
				email: true
			},
			mobile:{
				number: true,
				minlength:10,
				maxlength:10
				},
			region:"required",
			off:"required"

		},
		messages: {
			custname: "Enter Your Name",

			loginname: "Enter Phone Number",
											
			//username: {
			//	required: "Please enter a username",
			//	minlength: "Your username must consist of at least 2 characters"
			//},

			pwd: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			repwd: {
				required: "Please Retype a password",
				//minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			
			
			user_type: "Select User Type",
			
			user_status: "Select User Status",
			
			user_mail: "Please enter a valid email",
			mobile:{
				number: "Enter a valid number",
				minlength: "Mobile No should contain 10 Digits",
			},
			region:"Select Region",
			off:"Enter Office Name"
				
		},
		
		
		// if the validation is successfull //
		
		submitHandler: function(form) {
			// do other stuff for a valid form
			$.post('userAddAction.php', $("#addform").serialize(), function(data) {
				$('#valid').html(data);
			});
		}
	});
});
</script>


<h1 class="colororange">Add New Portal User  </h1>
<fieldset>
<legend>Add Users</legend>
<form name="addform" id="addform" method="post">	
		<div id="valid"></div><div class="leftfield">User Name : </div> <div class="rightfield"><input type="text" name="custname" id="custname" size="25"></div>
		<div class="leftfield">Login Id : </div> <div class="rightfield"><input type="text" name="loginname" id="loginname" size="25"></div>
		
		<div class="leftfield">Enter Password : </div> <div class="rightfield"><input type="password" name="pwd" id="pwd" size="25"></div>
		<div class="leftfield">Retype Password : </div> <div class="rightfield"><input type="password" name="repwd" id="repwd" size="25"></div>
		
		<div class="leftfield">User Type : </div> <div class="rightfield">
			<?php
				if($usrType=='101'){
					$sqlTyp = "SELECT * from user_type ORDER BY utype_id DESC";				
				}else{
					$sqlTyp = "SELECT * from user_type WHERE utype_id='103' ORDER BY utype_id DESC";									
				}
				

				$resTyp = mysql_query($sqlTyp);
				echo "<select name='user_type' id='user_type'>";

				while($rowTyp=mysql_fetch_array($resTyp)){
				
					echo "<option value=".$rowTyp['utype_id'].">". $rowTyp['type_name'] ."</option>";
				
				} // end of while loop
				echo "</select>"
			?>
		</div>

		<div class="leftfield">User Status : </div> <div class="rightfield">
			<select name="user_status" id="user_status">
			<option value="0">Inactive</option>
			<option value="1">Active</option>				
		</select>
		</div>

		<div class="leftfield">Select Region : </div> <div class="rightfield">
			<?php

				$sqlReg = "SELECT * from tbl_region";

				$resReg = mysql_query($sqlReg);
				echo "<select name='region' id='region' onChange='get_zone();'><option value=''>Select</option>";

				while($rowReg=mysql_fetch_array($resReg)){
				
					echo "<option value=".$rowReg['reg_id'].">". $rowReg['reg_name'] ."</option>";
				
				} // end of while loop
				echo "</select>";
			?>
		</div>
		
				
		
		<div class="leftfield">Office : </div> <div class="rightfield"><input type="text" name="off" id="off" size="25"></div>
		<div class="leftfield">Email Id : </div> <div class="rightfield"><input name="user_mail" id="user_mail" type="mail" size="25" class="mail"></div>
		<div class="leftfield">Mobile : </div> <div class="rightfield"><input type="text" name="mobile" id="mobile" size="25"></div>

		<div class="leftfield">Privillege : </div> 
		<div class="rightfield">
			<table>								
				<th width="0%">Caller Id</th> 
				<th width="0%">Reset Pwd</th>

				<?php if($usrType=='101'){?>
					<th width="0%">Users</th>
					<th width="0%">Time Ext</th>

			<?php }?>
				<tr>
					
					<td><input type="checkbox" value="1" id="adm_cid" name='adm_cid'></td>
					<td><input type="checkbox" value="1" id="adm_pwd" name="adm_pwd"></td>

					<?php if($usrType=='101'){?>
						<td><input type="checkbox" value="1" id="adm_user"  name="adm_user"></td>					

						<td><input type="checkbox" value="1" id="adm_ext" name="adm_ext"></td>

					
					<?php }?>
					
				</tr>


			</table>
			
		</div>

		<div class="leftfield">Remarks : </div> <div class="rightfield"><input type="text" name="remarks" id="remarks" size="55"></div>
		
		
		<div class="leftfield"></div><div class="rightfield"><input type="submit" value="Create User"></div>			

</form>
</fieldset>
<?php
mysql_close();
include_once($basepath."includes/footer.php");	
}else{  echo ("<script> window.location='../logout.php?act=login&err=1';</script>"); }  // if not logged in //
?>
