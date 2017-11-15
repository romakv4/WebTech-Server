<?php
Class LogInClass {
  Public function login($login, $sha256Password, $connect) {
    if ($login != NULL && $sha256Password == NULL) {
      $checkLoginQuery = "SELECT user_email FROM users WHERE user_login = '$login'";
      $resultOfLoginCheck = $connect->query($checkLoginQuery);
      if (mysqli_num_rows($resultOfLoginCheck) == 0) {
        echo json_encode("Вы явно ошиблись логином!");
        mysqli_close($connect);
      } else {
        $toUser = array();
        while ($row = $resultOfLoginCheck->fetch_assoc()) {
          $toUser[] = $row;
        }
        echo json_encode($toUser);
        mysqli_close($connect);
      }
    } else {
      $checkPasswordQuery = "SELECT user_password FROM users WHERE user_password = '$sha256Password'";
      $resultOfPasswordCheck = $connect->query($checkPasswordQuery);
      if (mysqli_num_rows($resultOfPasswordCheck) == 0) {
        echo json_encode("Вы явно ошиблись паролем!");
        mysqli_close($connect);
      } else {
        $passwordInDB = array();
        while ($row = $resultOfPasswordCheck->fetch_assoc()) {
          $passwordInDB = $row;
        }
        if ($passwordInDB['user_password'] == $sha256Password) {
          echo json_encode("OK");
          mysqli_close($connect);
        }
      }
    }
  }
}
?>