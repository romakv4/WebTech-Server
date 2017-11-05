<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Смена пароля</title>
</head>
<body>
  <form>
    <p>Введите логин: <input type="text" name="user_login" id="user_login" required /></p>
    <p>Введите старый пароль: <input type="password" name="user_password" id="user_password" required /></p>
    <p>Введите новый пароль: <input type="password" name="user_new_password" id="user_new_password" required></p>
    <p><input type="hidden" name="type" id="type" value="changePass" /></p>
    <p><input type="button" id="changePass" value="Change Password" /></p>
  </form>
  <div id="result"></div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="./js/changePassword.js"></script>
  <script type="text/javascript" src="js/sha256.js" charset="utf-8"></script>
</body>
</html>