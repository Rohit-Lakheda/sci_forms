<?php
	

	/*$servername='66.199.251.67';     // Your MySql Server Name or IP address here
	$dbusername='bangalorenano';          // Login user id here
	$dbpassword='BanG9537';              // Login password here
	$dbname='bangalorenano';     		 // Your database name here
*/
$servername = '82.25.125.158'; // Your MySql Server Name or IP address here
$dbusername = 'u852403557_sciexpouser'; // Login user id here
$dbpassword = 'r@1t:zd@8HEA'; // Login password here
$dbname = 'u852403557_sci25expo'; // Your database name here

	connecttodb($servername, $dbname, $dbusername, $dbpassword);

	function connecttodb($servername, $dbname, $dbuser, $dbpassword)
	{
		global $link;
		$link = mysqli_connect($servername, $dbuser, $dbpassword, $dbname);
		if (!$link) {
			die("Could not connect to MySQL: " . mysqli_connect_error());
		}
	}
	//echo "Connected successfully to the database: $dbname<br>";
?>