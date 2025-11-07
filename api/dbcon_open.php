<?php





/*$servername='localhost';     // Your MySql Server Name or IP address here

	$dbusername='bangalorenano';          // Login user id here

	$dbpassword='BanG9537';              // Login password here

	$dbname='bangalorenano';     		 // Your database name here





	

	/* $servername='localhost';     // Your MySql Server Name or IP address here

	$dbusername='iitlexhibition';          // Login user id here

	$dbpassword='RLISL#s5sion';              // Login password here

	$dbname='iitlexhibition';

	*/

/*

	$servername='localhost';     // Your MySql Server Name or IP address here

	$dbusername='pllpuzlj_prawaas';          // Login user id here

	$dbpassword='4(YdDQ+qBRc4';              // Login password here

	$dbname='pllpuzlj_prawaas';  

*/

/*

$servername = '46.28.47.167';     // Your MySql Server Name or IP address here

$dbusername = 'u661263539_db1strtupkmorg';          // Login user id here

$dbpassword = 'db@24Strtupkm@rg';              // Login password here

$dbname = 'u661263539_db1strtupkmorg';

*/



$servername = 'localhost';     // Your MySql Server Name or IP address here

$dbusername = 'root';          // Login user id here

$dbpassword = '';              // Login password here

$dbname = 'local_cdac';











// echo "in dbcon";

// Your database name here

connecttodb($servername, $dbname, $dbusername, $dbpassword);

//echo "pass db bb";

function connecttodb($servername, $dbname, $dbuser, $dbpassword)

{

	global $link;

	$link = mysqli_connect($servername, $dbuser, $dbpassword, $dbname);

	if (!$link) {

		die("Could not connect to MySQL");

	}

	/*

	else{

		echo "connected";

	}

	*/

	mysqli_select_db($link, "$dbname") or die("could not open db - " . mysqli_error($link));

	// echo "in dbcon2";

}

