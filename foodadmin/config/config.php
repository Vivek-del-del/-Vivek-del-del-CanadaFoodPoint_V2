<?php
ob_start();
session_start(); 
error_reporting(0);
$database_host 			= 'localhost'; 
$database_name 			= 'foodpoint';
$database_password 		= '';
$database_username 		= 'root'; 
//open mysql connection
$mysqli = new mysqli($database_host, $database_username, $database_password, $database_name);

//output error and exit if there's an error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
require_once("session/session.php"); 

?>