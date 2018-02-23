<?php
session_start();
include_once("../includes/IncSession.php");

if($usrType=='101' || $usrType=='102' AND $pUsers=='1'){ // if not logged in or no previllege, will redirect to logout page //

	
include_once("../includes/classMysql.php");
$classMySql = new class_mysql;

$id = trim(mysql_real_escape_string($_POST['id']));

$resEdit = mysql_query("SELECT * FROM user_tbl WHERE usr_ids='$id'");
$rowEdit = mysql_fetch_array($resEdit); 
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
			$.post('userEditAction.php', $("#addform").serialize(), function(data) {
				$('#valid').html(data);
			});
		}
	});
});
</script>


<fieldset>
<legend>Edit Users</legend>	
<form name="addform" id="addform" method="post">
	
		<div id="valid"></div>
		
		<div class="leftfield">User Name : </div> <div class="rightfield"><input type="text" name="custname" id="custname" size="25" value="<?=$rowEdit['usr_fullname'];?>"></div>
		
		<div class="leftfield">Login Id : </div> <div class="rightfield"><input type="text" name="loginname" id="loginname" size="25" readonly value="<?=$rowEdit['usr_name'];?>"></div>
		
		<div class="leftfield">User Type : </div> <div class="rightfield">
			<?php
				if($usrType=='101'){
					$sqlTyp = "SELECT * from user_type ORDER BY utype_id DESC";				
				}else{
					$sqlTyp = "SELECT * from user_type WHERE utype_id='103' ORDER BY utype_id DESC";									
				}
				
				$selectType = $rowEdit['usr_type'];
				$resTyp = mysql_query($sqlTyp);
				echo "<select name='user_type' id='user_type'>";

				while($rowTyp=mysql_fetch_array($resTyp)){
				
					echo "<option value=".$rowTyp['utype_id']; 
						if($rowTyp['utype_id']==$selectType){echo " selected=selected ";}
					echo ">". $rowTyp['type_name'] ."</option>";
				
				} // end of while loop
				echo "</select>";
				
				$selectStat = $rowEdit['usr_status'];
	
				
			?>
		</div>

		<div class="leftfield">User Status : </div> <div class="rightfield">
			<select name="user_status" id="user_status">
			<option value="0" <?php if($selectStat==0){echo "selected=selected";} ?> >Inactive</option>
			<option value="1" <?php if($selectStat==1){echo "selected=selected";} ?>>Active</option>				
		</select>
		</div>

		<div class="leftfield">Select Region : </div> <div class="rightfield">
			<?php

				$sqlReg = "SELECT * from tbl_region";

				$resReg = mysql_query($sqlReg);
				echo "<select name='region' id='region' onChange='get_zone();'><option value=''>Select</option>";
				$selectReg = $rowEdit['usr_region'];
				while($rowReg=mysql_fetch_array($resReg)){
				
					echo "<option value=".$rowReg['reg_id']; 
						if($rowReg['reg_id']==$selectReg){echo " selected=selected ";}
					echo">". $rowReg['reg_name'] ."</option>";
				
				} // end of while loop
				echo "</select>"
			?>
		</div>

				
		<div class="leftfield">Office : </div> <div class="rightfield"><input size="30" type="text" name="off" id="off" size="25" value="<?=$rowEdit['usr_office'];?>"></div>
		<div class="leftfield">Email Id : </div> <div class="rightfield"><input size="30" name="user_mail" id="user_mail" type="mail" size="25" class="mail" value="<?=$rowEdit['usr_email'];?>"></div>
		<div class="leftfield">Mobile : </div> <div class="rightfield"><input type="text" name="mobile" id="mobile" size="25" value="<?=$rowEdit['usr_telno'];?>"></div>

		<div class="leftfield">Privillege : </div> 
		<div class="rightfield">
				
		
		
				<?php
				// Grab Previllige into varaible //
					
				
				$selectCid 		= $rowEdit['usr_adm_cid'];
				$selectPwd 		= $rowEdit['usr_adm_pwd'];
				
				if($usrType=='101'){
					//$selectNot 		= $rowEdit['usr_adm_not'];
					$selectExt 		= $rowEdit['usr_adm_ext'];
					$selectUser 	= $rowEdit['usr_adm_user'];
	
				}				
				?>
				
			<table>				
				<th width="0%">Caller Id</th> <th width="0%">Reset Pwd</th>
				<?php if($usrType=='101'){?>
					<th width="0%">Users</th><th width="0%">Time Ext</th>
				<?php }?>
				<tr>
					
					<td><input type="checkbox" value="1" id="adm_cid" name='adm_cid' <?php if($selectCid==1){echo " checked=checked ";}?>></td>
					<td><input type="checkbox" value="1" id="adm_pwd" name="adm_pwd" <?php if($selectPwd==1){echo " checked=checked ";}?>></td>
				
					<?php if($usrType=='101'){?>
						<td><input type="checkbox" value="1" id="adm_user"  name="adm_user" <?php if($selectUser==1){echo " checked=checked ";}?>></td>				
						<td><input type="checkbox" value="1" id="adm_ext" name="adm_ext" <?php if($selectExt==1){echo " checked=checked ";}?>></td>

					<?php }?>
					
				</tr>
			</table>
			
		</div>

		<div class="leftfield">Remarks : </div> <div class="rightfield"><input type="text" name="remarks" id="remarks" value="<?=$rowEdit['usr_remarks'];?>" size="55"></div>
		
		
		<div class="leftfield"></div><div class="rightfield"><input type="submit" value="Edit User"><input type="hidden" name="eid" value="<?php echo $id;?>"></div>			

</form>
</fieldset>
<?php
mysql_close();	
}else{  echo ("<script> window.location='../logout.php?act=login&err=1';</script>"); }  // if not logged in //
?>
