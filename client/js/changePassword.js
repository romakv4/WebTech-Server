$("#changePass").click(function () {
  var login = $("#user_login").val();
  var password = $("#user_password").val();
  var new_password = $("#user_new_password").val();
  var type = $("#type").val();
  if (password == new_password) {
    $('#result').html("Пароли совпадают!");
  } else {
    var message = {
      user_login: login,
      type: type
    };
    $.ajax({
      url: "../server/phpserver.php",
      type: "POST",
      data: message,
      success: function(data) {
        var dataParsed = JSON.parse(data);
        var email = dataParsed[0]["user_email"];
        var resultPassword = login + email + new_password;
        var sha256Password = sha256(resultPassword);
          var message = {
            user_login: login,
            user_new_password: sha256Password,
            type: type
          };
          $.ajax({
            url: "../server/phpserver.php",
            type: "POST",
            data: message,
            success: function(data) {
              $('#result').html(data);
            }
          })
      }
    })
  }
});