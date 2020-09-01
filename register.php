<?php
session_start();
require "functions.php";

$email = $_POST['email'];
$password = $_POST["password"];
$user = get_user_by_email($email);

if (!empty($user)) {
  set_flash_message("danger", "Этот эл. адрес уже занят другим пользователем.");
  redirect_to('page_register.php');
  exit;
}
else{
add_user($email, $password);
set_flash_message("success", "Войдите со своим email и паролем");
redirect_to('page_login.php');
exit;
}

?>