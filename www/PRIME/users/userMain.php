<?php
session_start();
$basepath = "../";
include_once($basepath."includes/IncSession.php");

if (isset($_SESSION['db_is_logged_in'])==true AND $usrStat=='1' AND $pUsers=='1' AND $usrType=='101' || $usrType=='102') { // if not logged in or no previllege, will redirect to logout page //

include_once($basepath."includes/header.php");	
include_once($basepath."includes/classMysql.php");
$classMySql = new class_mysql; 


if($usrType=='101'){
	$sql = "SELECT user_tbl.*, user_type.* from user_tbl,user_type WHERE user_type.utype_id=user_tbl.usr_type ORDER BY user_tbl.usr_type ASC, user_tbl.usr_fullname ASC";				
}else{
	$sql = "SELECT user_tbl.*, user_type.* from user_tbl,user_type WHERE user_type.utype_id=user_tbl.usr_type AND usr_type<>'101' ORDER BY user_tbl.usr_type ASC,  user_tbl.usr_fullname ASC";									
}


//echo $sql;
$res = mysql_query($sql);
?>

<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
function edit_page(usr_id){
	$('#editplace').hide;
	$.post("userEdit.php", {id:usr_id},			
	function(data){
		//alert(data);		
		if(data){
			$('#editplace').html(data);
		}else{
			alert(data);
		}
		
	});

}


function stat_chg(usr_id){
	
	$.post("userStat.php", {id:usr_id},			
	function(data){
		//alert(data);		
		if(data){
			$('#usr_'+usr_id+'_id').html(data);
		}else{
			alert(data);
		}
		
	});
}
</script>

<h1 class="colororange">IBS Support -  Portal Users</h1>

<div id="editplace"></div>
<table border="1" width="100%">
<th><div align=center><b>SN</b></div></th>
<th><b>Name</b></th>
<th><b>User</b></th>
<th><b>Email</b></th>
<th> <b>User Type </b></th>
<th width="15%"> <b>Status </b></th>
<th width='3%'>&nbsp;</th>

<?php
	$count =0;
	while($row=mysql_fetch_array($res)){
	
		if ($count%2){	echo "<tr class=nextrow >";	}else{ echo "<tr>";	}

		echo "<td><div align=center>". ++$count. "</div></td>"; 
		echo "<td>". $row['usr_fullname']. "</td>"; 
		echo "<td>". $row['usr_name']. " </td><td>".$row['usr_email']."</td><td> ".$row['type_name'];
		
		echo"</td><td> <span id='usr_".$row['usr_ids']."_id'> ";
			if($row['usr_status']=='1'){ echo 'Active';}else{ echo 'Inactive';}
		
		echo "</span> &nbsp; <input type='button' onClick='stat_chg(".$row['usr_ids'].")' value='status'>";
		echo "</td><td><input type='button' value='edit' onclick=edit_page(".$row['usr_ids'].");></td></tr>";		
	}

echo "</table>";

mysql_close();
include_once($basepath."includes/footer.php");		
}else{  echo ("<script> window.location='../logout.php?act=login&err=1';</script>"); }  // if not logged in //
?>


