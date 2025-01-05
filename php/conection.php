<?php
// Error Reporting Turn On
ini_set('error_reporting', E_ALL);

// Setting up the time zone
date_default_timezone_set('Africa/Luanda');

// Host Name
$dbhost = 'localhost';
// Database Name
$dbname = 'acamp_maravilha';
// Database Username
$dbuser = 'root';
// Database Password
$dbpass = '';
// Defining base url
define("BASE_URL", "");
// Getting Admin url
define("ADMIN_URL", BASE_URL . "admin" . "/");

try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass,
  array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'UTF8'"));  //Setting utf8 as
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}