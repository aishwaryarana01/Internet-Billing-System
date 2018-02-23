<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Support System</title>
<link rel="stylesheet" href="<?=$basepath?>css/stylesheet.css" type="text/css" media="all">
<link rel="shortcut icon" type="image/x-icon" href="<?=$basepath;?>images/favicon.ico">	
<!--[if lt IE 9]>
	<script type="text/javascript" src="js/ie6_script_other.js"></script>
	<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->
<script src="<?=$basepath?>js/jquery.js" type="text/javascript"></script>
</head>
<body>
<div id="container" class="shadow">
	<div id="header">
		<div id="head-left">
			<h1>Telecommunication<br>Internet Support</h1>
		</div>
		<div id="head-right">
		<p><br>	<?php 
				if(!$usrFullName == NULL){
					echo "welcome <b>".$usrFullName."</b><br>";
					echo "<a href='".$basepath."changepass.php'>change password</a> | <a href='".$basepath."logout.php'>logout</a>";
				}
			
			?>
		</p>
		</div>
	</div>
	<div id="nav-top">
		<ul>
			<li><a href="<?=$basepath?>main.php">Home</a></li>
			<li><a href="<?=$basepath?>changepass.php">Change Password</a></li>
			<li><a href="<?=$basepath?>logout.php">Logout</a></li>

		</ul>
	</div>
	
	<div id="content-container">
	
		<div id="content-container2">
			
			<div id="nav-left">
				
				<ul>
					<li class="subhead">Admin Menu</li>
					<li><a href="<?=$basepath?>main.php">Main</a></li>
					<li><a href="<?=$basepath?>viewstatus.php">View Status</a></li>
					<li><a href="<?=$basepath?>viewsession.php">Retrieve Session</a></li>

					<?php if($pPwd=='1'){?>
						<li><a href="<?=$basepath?>resetadslpwd.php">Reset Users'  Password</a></li>
					<?}?>
					
					<?php if($pCid=='1'){?>
						<li><a href="<?=$basepath?>portbind.php">Reset Port Bind</a></li>
					<?}?>
					
					<?php if($pLog=='1'){?>
						<li><a href="<?=$basepath?>viewlog.php">View Log</a></li>
					<?}?>
								
				
					
					<?php if($pExt=='1'){?>
						<li><a href="<?=$basepath?>timeextension.php">Time Extension</a></li>
					<?}?>
					
					
					<?php if($usrType<>'103')?><li class="subhead">Users Menu</li><?php ;?>
					
					<?php if($pUsers=='1'){?>
						<li><a href="<?=$basepath?>users/userMain.php">Portal Users</a></li>
						<li><a href="<?=$basepath?>users/userAdd.php">Add Portal User</a></li>
						<li><a href="<?=$basepath?>users/resetPass.php">Reset Portal User's Password</a></li>
					<?}?>
					
					<li><a href="<?=$basepath?>changepass.php">Change Password</a></li>
					<li><a href="<?=$basepath?>logout.php">Logout</a></li>
					<li class="noborder"></li>
				</ul>
			</div>
			
			<div id="more">
				<h3 class="colorgreen">ADSL Syncronization</h3>
				Once you've connected the telephone line to your modem, After turning the power on, The ADSL Led in your modem first blinks for few seconds and after it steadily glows. If it keeps contineously glowing, it means your ADSL modem is properly syncronized.   
				
								
			</div>			
			
			<div id="content"><br>
