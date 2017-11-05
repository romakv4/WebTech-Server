<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Client</title>
</head>
<body>
  <form>
    <p>Введите логин: <input type="text" name="user_login" id="user_login" required /></p>
    <p>Введите пароль: <input type="password" name="user_password" id="user_password" required /></p>
    <p><input type="hidden" name="type" id="type" value="login" /></p>
    <p><input type="button" id="login" value="Log In" /></p>
  </form>
  <div id="result"></div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="./js/login.js"></script>
  <script type="text/javascript" src="js/sha256.js" charset="utf-8"></script>
</body>
</html>