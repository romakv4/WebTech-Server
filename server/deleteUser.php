<?php
Class DeleteUserClass {
  Public function deleteUser($login, $sha256Password, $connect) {
    if ($login != null && $sha256Password == null) {
      $checkLoginQuery = "SELECT user_email FROM users WHERE user_login = '$login'";
      $resultOfLoginCheck = $connect->query($checkLoginQuery);
      if (mysqli_num_rows($resultOfLoginCheck) == 0) {
        echo json_encode("wronglogin");
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
      $passwordInDB = array();
      while ($row = $resultOfPasswordCheck->fetch_assoc()) {
        $passwordInDB = $row;
      }
      if ($passwordInDB['user_password'] == $sha256Password) {
       $userDeleteQuery = "DELETE FROM users WHERE user_login = '$login'
       AND user_password = '$sha256Password'";
       $resultOfDeleteUser = $connect->query($userDeleteQuery);
       echo json_encode("ok");
       mysqli_close($connect);
     } else {
      echo json_encode("wrongpwd");
      mysqli_close($connect);
    }
  }
}
}
?>