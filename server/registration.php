<?php
Class RegistrationClass {
  Public function registration($login, $email, $sha256Password, $connect) {
    if($login != NULL && $email != NULL && $sha256Password != NULL) {
      $checkFreedomLoginQuery = "SELECT * FROM users WHERE user_login = '$login'";
      $resultOfRegistrationCheck = $connect->query($checkFreedomLoginQuery);
      if (mysqli_num_rows($resultOfRegistrationCheck) == 0) {
        $RegisterQuery = "INSERT INTO users (user_login, user_email, user_password)
        VALUES ('$login', '$email', '$sha256Password')";
        $result = $connect->query($RegisterQuery);
        echo json_encode("Регистрация прошла успешно!");
        mysqli_close($connect);
      } else {
        echo json_encode("Имя пользователя занято!");
        mysqli_close($connect);
      }
    }
  }
}
?>