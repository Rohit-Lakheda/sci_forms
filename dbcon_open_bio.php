<?php
	

	/*$servername='66.199.251.67';     // Your MySql Server Name or IP address here
	$dbusername='bangalorenano';          // Login user id here
	$dbpassword='BanG9537';              // Login password here
	$dbname='bangalorenano';     		 // Your database name here
*/
	/* $servername='localhost';     // Your MySql Server Name or IP address here
	$dbusername='bangaloreite';          // Login user id here
	$dbpassword='BdkqLC025a';              // Login password here
	$dbname='bangaloreite';   */   		 // Your database name here
	
	/*$servername='localhost';     // Your MySql Server Name or IP address here
	$dbusername='root';          // Login user id here
	$dbpassword='';              // Login password here
	$dbname='bangalor';*/
	
	$servername = '202.38.172.143'; // Your MySql Server Name or IP address here
	$dbusername = 'Ind_bio';         // Login user id here
	$dbpassword = 'In#13@o7in';      // Login password here
	$dbname     = 'Ind_bio';

	connecttodb($servername, $dbname, $dbusername, $dbpassword);

	function connecttodb($servername, $dbname, $dbuser, $dbpassword)
	{
		global $link;
		$link = mysqli_connect($servername, $dbuser, $dbpassword, $dbname);
		if (!$link) {
			die("Could not connect to MySQL: " . mysqli_connect_error());
		}
	}
?>