<?php
  Class changePassClass {
    Public function changePass($login, $sha256Password, $new_password, $connect) {
      if ($password == null && $new_password == null) {
        $checkLoginQuery = "SELECT user_email FROM users WHERE user_login = '$login'";
        $resultOfLoginCheck = $connect->query($checkLoginQuery);
        $toUser = array();
        while ($row = $resultOfLoginCheck->fetch_assoc()) {
          $toUser[] = $row;
        }
        echo json_encode($toUser);
        mysqli_close($connect);
      } else if ($new_password != null) {
        $passwordChangeQuery = "UPDATE users SET user_password = '$new_password' WHERE user_login = '$login'";
        $resultOfChangePass = $connect->query($passwordChangeQuery);
        echo "Пароль успешно изменен!";
        mysqli_close($connect);
      }
    }
  }
?>