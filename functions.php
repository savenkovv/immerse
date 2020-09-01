<?php
session_start();



function login($email, $password)
{
	$user = get_user_by_email($email);
	if (!empty($user))
	{
	  if (password_verify($password, $user['password']))
		{
			$_SESSION['is_auth'] = $email;
			return true;
		}
	}
	set_flash_message("danger", "Введен неправильный логин или пароль");
	return false;
}


function is_not_auth(){
	if (!isset($_SESSION['is_auth'])){
		return true;
	}
	else{
		return false;
	}}


function get_role($role)
{
	$email = $_SESSION['is_auth'];
	require 'confDB.php';
	$sql = "SELECT * FROM users WHERE email=:email";
	$statement = $pdo->prepare($sql);
	$statement->execute(['email' => $email]);
	$role = $statement->fetch(PDO::FETCH_ASSOC);
	return($role);
}


function get_user_name($user)
{
	$email = $_SESSION['is_auth'];
	require 'confDB.php';
	$sql = "SELECT * FROM users WHERE email=:email";
	$statement = $pdo->prepare($sql);
	$statement->execute(['email' => $email]);
	$user = $statement->fetch(PDO::FETCH_ASSOC);
	return($user);
}


function is_admin($role)
{
	if ($role['role'] == "admin") {
  	return true;
	}
  else{
    return false;
  }
}


function show_btn_addUser()
{
	echo "<a class=\"btn btn-success\" href=\"create_user.html\">Добавить</a>";
}


function get_all_users($users)
{
	require 'confDB.php';
  $sql = "SELECT * FROM users";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $users = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $users;
}


function get_user_by_email($email){
	require "confDB.php";
	$sql = "SELECT * FROM users WHERE email=:email";
	$statement = $pdo->prepare($sql);
	$statement->execute(['email' => $email]);
	$user = $statement->fetch(PDO::FETCH_ASSOC);
	return($user);}


function add_user($email, $password){
	require "confDB.php";
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
	$statement = $pdo->prepare($sql);
	$statement->execute(['email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);}


function set_flash_message($name, $message)
{
	$_SESSION[$name] = $message;
}


function display_flash_message($name){
	if (isset($_SESSION[$name])){
		echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
		unset($_SESSION[$name]);
	}}


function redirect_to($path)
{
	header("Location:".$path);
}











?>
