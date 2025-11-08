<?php
	
	// Function to read .env file
	function loadEnv($path) {
		if (!file_exists($path)) {
			return [];
		}
		
		$env = [];
		$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		
		foreach ($lines as $line) {
			$line = trim($line);
			
			// Skip empty lines and comments
			if (empty($line) || strpos($line, '#') === 0) {
				continue;
			}
			
			// Check if line contains '='
			if (strpos($line, '=') === false) {
				continue;
			}
			
			list($name, $value) = explode('=', $line, 2);
			$name = trim($name);
			$value = trim($value);
			
			// Remove semicolon at the end if present
			$value = rtrim($value, ';');
			
			// Remove quotes if present
			$value = trim($value, '"\'');
			
			$env[$name] = $value;
		}
		
		return $env;
	}
	
	// Load environment variables from .env file
	$env = loadEnv(__DIR__ . '/.env');
	$appEnvironment = isset($env['APPENVIRONMENT']) ? strtolower(trim($env['APPENVIRONMENT'])) : '';
	
	/*$servername='66.199.251.67';     // Your MySql Server Name or IP address here
	$dbusername='bangalorenano';          // Login user id here
	$dbpassword='BanG9537';              // Login password here
	$dbname='bangalorenano';     		 // Your database name here
*/
	
	// Determine environment: Check .env file first, then fallback to HTTP_HOST
	$isLocal = false;
	
	if (!empty($appEnvironment)) {
		// Use .env file value
		$isLocal = ($appEnvironment == 'local');
	} else {
		// Fallback: Check HTTP_HOST
		if (isset($_SERVER['HTTP_HOST'])) {
			$httpHost = strtolower($_SERVER['HTTP_HOST']);
			$isLocal = ($httpHost == 'localhost' || $httpHost == '127.0.0.1' || strpos($httpHost, 'localhost:') === 0);
		}
	}
	
	// Set database credentials based on environment
	if ($isLocal) {
		// Local environment credentials
		$servername = '82.25.125.158'; // Your MySql Server Name or IP address here
		$dbusername = 'u852403557_sciexpouser'; // Login user id here
		$dbpassword = 'r@1t:zd@8HEA'; // Login password here
		$dbname = 'u852403557_sci25expo'; // Your database name here

		
	} else {
		// Production environment credentials
		
		$servername = 'localhost'; // Your MySql Server Name or IP address here
		$dbusername = 'root'; // Login user id here
		$dbpassword = 'sci@2025'; // Login password here
		$dbname = 'sci2025'; // Your database name here
	}
	
	// Connect to database
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