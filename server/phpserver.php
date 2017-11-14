<?php
$type = $_POST['type'];
$user_login = $_POST['user_login'];
$user_email = $_POST['user_email'];
$user_sha256Password = $_POST['user_password'];
$user_new_password = $_POST['user_new_password'];
$mysqli = new mysqli("localhost", "root", "", "usersDB");
if ($mysqli->errno) {
  printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
  exit();
}
switch ($type) {
  case 'registration':
  $checkFreedomLoginQuery = "SELECT * FROM users WHERE user_login = '$user_login'";
  $resultOfRegistrationCheck = $mysqli->query($checkFreedomLoginQuery);
  if (mysqli_num_rows($resultOfRegistrationCheck) == 0) {
    $RegisterQuery = "INSERT INTO users (user_login, user_email, user_password)
    VALUES ('$user_login', '$user_email', '$user_sha256Password')";
    $result = $mysqli->query($RegisterQuery);
    echo "Регистрация прошла успешно!";
    mysqli_close($mysqli);
  } else {
    echo "Имя пользователя занято!";
    mysqli_close($mysqli);
  }
  break;
  case 'login':
  if ($user_sha256Password == null) {
    $checkLoginQuery = "SELECT user_email FROM users WHERE user_login = '$user_login'";
    $resultOfLoginCheck = $mysqli->query($checkLoginQuery);
    if (mysqli_num_rows($resultOfLoginCheck) == 0) {
      echo "Вы явно ошиблись логином!";
      mysqli_close($mysqli);
    } else {
      $toUser = array();
      while ($row = $resultOfLoginCheck->fetch_assoc()) {
        $toUser[] = $row;
      }
      echo json_encode($toUser);
      mysqli_close($mysqli);
    }
  } else {
    $checkPasswordQuery = "SELECT user_password FROM users WHERE user_password = '$user_sha256Password'";
    $resultOfPasswordCheck = $mysqli->query($checkPasswordQuery);
    if (mysqli_num_rows($resultOfPasswordCheck) == 0) {
      echo "Вы явно ошиблись паролем!";
      mysqli_close($mysqli);
    } else {
      $passwordInDB = array();
      while ($row = $resultOfPasswordCheck->fetch_assoc()) {
        $passwordInDB = $row;
      }
      if ($passwordInDB['user_password'] == $user_sha256Password) {
        echo '<a href="./phpclientchangepass.php">Сменить пароль!</a></br>
        <a href="./phpclientdeleteuser.php">Выпилиццо!</a>';
      }
      mysqli_close($mysqli);
    }
  }
  break;
  case 'changePass':
  if ($user_password == null && $user_new_password == null) {
    $checkLoginQuery = "SELECT user_email FROM users WHERE user_login = '$user_login'";
    $resultOfLoginCheck = $mysqli->query($checkLoginQuery);
    $toUser = array();
    while ($row = $resultOfLoginCheck->fetch_assoc()) {
      $toUser[] = $row;
    }
    echo json_encode($toUser);
    mysqli_close($mysqli);
  } else if ($user_new_password != null) {
    $passwordChangeQuery = "UPDATE users SET user_password = '$user_new_password' WHERE user_login = '$user_login'";
    $resultOfChangePass = $mysqli->query($passwordChangeQuery);
    echo "Пароль успешно изменен!";
    mysqli_close($mysqli);
  }
  break;
  case 'deleteUser':
  if ($user_sha256Password == null) {
    $checkLoginQuery = "SELECT user_email FROM users WHERE user_login = '$user_login'";
    $resultOfLoginCheck = $mysqli->query($checkLoginQuery);
    if (mysqli_num_rows($resultOfLoginCheck) == 0) {
      echo "Такого пользователя нет!";
      mysqli_close($mysqli);
    } else {
      $toUser = array();
      while ($row = $resultOfLoginCheck->fetch_assoc()) {
        $toUser[] = $row;
      }
      echo json_encode($toUser);
      mysqli_close($mysqli);
    }
  } else {
    $checkPasswordQuery = "SELECT user_password FROM users WHERE user_password = '$user_sha256Password'";
    $resultOfPasswordCheck = $mysqli->query($checkPasswordQuery);
    $passwordInDB = array();
    while ($row = $resultOfPasswordCheck->fetch_assoc()) {
      $passwordInDB = $row;
    }
    if ($passwordInDB['user_password'] == $user_sha256Password) {
     $userDeleteQuery = "DELETE FROM users WHERE user_login = '$user_login'
     AND user_password = '$user_sha256Password'";
     $resultOfDeleteUser = $mysqli->query($userDeleteQuery);
     echo "Вы успешно выпилились!";
     mysqli_close($mysqli);
   } else {
    echo "Вы неверно ввели пароль!";
    mysqli_close($mysqli);
  }
}
break;
}
?>