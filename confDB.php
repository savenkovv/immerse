<?php
	$host = "localhost";
	$db = "marlin";
	$db_user = "admin";
	$db_pass = "";	
	$dsn = "mysql:host=$host;dbname=$db";
	$pdo = new PDO($dsn, $db_user, $db_pass);
?>