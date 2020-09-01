<?php
session_start();
require "functions.php";


	$email = $_POST['email'];

	$password = $_POST['password'];


	login($email, $password);
	
	if (!login($email, $password)) {
		redirect_to("page_login.php");
	}
	else {
		redirect_to("users.php");
	}
	


?>