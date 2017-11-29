<?php
Class RegistrationClass {
  Public function registration($login, $email, $sha256Password, $connect) {
    if($login != NULL && $email != NULL && $sha256Password != NULL) {
      $checkFreeLoginQuery = "SELECT * FROM users WHERE user_login = '$login'";
      $resultOfRegistrationCheck = $connect->query($checkFreeLoginQuery);
      if (mysqli_num_rows($resultOfRegistrationCheck) == 0) {
        $RegisterQuery = "INSERT INTO users (user_login, user_email, user_password)
        VALUES ('$login', '$email', '$sha256Password')";
        $result = $connect->query($RegisterQuery);
        echo json_encode("ok");
        mysqli_close($connect);
      } else {
        echo json_encode("fail");
        mysqli_close($connect);
      }
    }
  }
}
?>