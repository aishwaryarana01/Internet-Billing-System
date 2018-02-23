<?php
/* Class handles connection to MySQl database and parses SQL queries */
//include ("includes/config.php");
//include ("common.php");
class class_mysql{
	//properties
	var $connect;

	//constructor
     function class_mysql()
	 {
		//$this->connect=linkdb();       //takes the default from the common.php file
		$this->connect=mysql_connect("localhost","root","");
		//echo("connection link...........".$this->connect);
		mysql_select_db("prime", $this->connect) or die("Unable to select DB!".$this->connect);
	 }
     //takes sql statement
    function sql($sqlStatement)
	{
		//global $config;
		return mysql_query($sqlStatement, $this->connect);
	}
	
} // end of class-
?>
