<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title> :: Welcome !!!</title>
<meta name="Description" content="IBS Support Module">
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<link rel="stylesheet" href="css/stylesheet.css" type="text/css" media="screen">
</head>

<body>

<div id="loginpage" class="radius7 shadow" >

	
	<br><div class="bgline"></div><br>
	<form name="formname" id="formname" action="authenticate.php" enctype="form/data" method="POST" onsubmit="return validateForm()">
		User Name :<br><input type="text" name="username" id="username"  size="25"><br><br>
		Password :<br><input type="password" name="pwd" id="pwd"  size="25"><br><br>
		<input type="submit" id="submitted"name="submitted" value="Login">
	</form>
	

</div>

<script type="text/javascript">
	function validateForm(){
		
		var user	= document.formname.username;
		var pass	= document.formname.pwd;
		
		if(user.value=="") {
			alert("Enter Your User Name !!!");
			user.focus();
			return false;

		}else if(pass.value==""){
			alert("Enter Your Password !!!");
			pass.focus();
			return false;
		
		} 
		
		return true;
	}
</script>
	
</body>
</html>