<?php
$mysqli = new mysqli("localhost", "root", "", "usersDB");
if ($mysqli->errno) {
  printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
  exit();
}
switch ($_POST['type']) {
  case 'registration':
    require_once("./registration.php");
    $reg = new RegistrationClass();
    $reg->registration($_POST['user_login'], $_POST['user_email'], $_POST['user_password'], $mysqli);
    break;
  case 'login':
    require_once("./login.php");
    $login = new LogInClass();
    $login->login($_POST['user_login'], $_POST['user_password'], $mysqli);
    break;
  case 'changePass':
    require_once("./changePassword.php");
    $change = new ChangePassClass();
    $change->changePass($_POST['user_login'], $_POST['user_password'], $_POST['user_new_password'], $mysqli);
    break;
  case 'deleteUser':
    require_once("./deleteUser.php");
    $delete = new DeleteUserClass();
    $delete->deleteUser($_POST['user_login'], $_POST['user_password'], $mysqli);
    break;
}
?>