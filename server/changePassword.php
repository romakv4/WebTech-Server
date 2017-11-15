<?php
Class changePassClass {
  Public function changePass($login, $sha256Password, $new_password, $connect) {
    if ($password == null && $new_password == null) {
      $checkLoginQuery = "SELECT user_email FROM users WHERE user_login = '$login'";
      $resultOfLoginCheck = $connect->query($checkLoginQuery);
      if (mysqli_num_rows($resultOfLoginCheck) == 0) {
        echo json_encode("Вы ошиблись логином");
      } else {
        $toUser = array();
        while ($row = $resultOfLoginCheck->fetch_assoc()) {
          $toUser[] = $row;
        }
        echo json_encode($toUser);
        mysqli_close($connect);
      }
    } else if ($new_password != null) {
      $passwordCheckQuery = "SELECT user_password FROM users WHERE user_password = '$sha256Password'";
      $resultOfPasswordCheck = $connect->query($passwordCheckQuery);
      if (mysqli_num_rows($resultOfPasswordCheck) == 0) {
        echo json_encode("Старый пароль не совпадает!");
        mysqli_close($connect);
      } else {
        $passwordChangeQuery = "UPDATE users SET user_password = '$new_password' WHERE user_login = '$login'";
        $resultOfChangePass = $connect->query($passwordChangeQuery);
        echo json_encode("Пароль успешно изменен!");
        mysqli_close($connect);
      }
    }
  }
}
?>