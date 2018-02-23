

function passCheck()
{
	var invalid = " ";

	if(pass.value=="") {
		alert("Enter Your Password !!!");
		pass.focus();
		return false;
	
	}

	if(pass.value.length < 6) { 
		alert("Password must contain at least Six Characters!"); 
		pass.focus(); 
		return false; 
	} 
	if(pass.value == uname.value){ 
		alert("Password must be different from Username!"); 
		pass.focus(); return false; 
	} 
	// at lease one number is a must
	re = /[0-9]/; 
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

  return true;
}


function echeck(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("Enter a Valid Email Id")
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("Enter a Valid Email Id")
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("Enter a Valid Email Id")
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Enter a Valid Email Id")
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Enter a Valid Email Id")
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Enter a Valid Email Id")
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		    alert("Enter a Valid Email Id")
		    return false
		 }

 		 return true					
}


function isInteger(dateVal)
{
  var valInt;
  valInt=dateVal/2;
  if(valInt)return true;  
  else return false; 
}

function validateDate(maindate)
{
	var len=maindate.length;
	if(len!=10)	{
		return 0;
	}else {
		var dateyear=maindate.substring(0,4); 
		var datemonth=maindate.substring(5,7); 
		var dateday=maindate.substring(8,10); 
		var datedash1=maindate.substring(4,5); 
		var datedash2=maindate.substring(7,8); 

		if( isInteger(dateyear) && isInteger(datemonth) && isInteger(dateday) && dateyear.indexOf('-')==-1 && datemonth.indexOf('-')==-1 && dateday.indexOf('-')==-1 && datedash1=="-" && datedash2=="-") {
			if( (datemonth>12) || (dateday>31) ) {
				return 0;
			}
		}else {
			return 0;
		}
	}
	return 1;
}
