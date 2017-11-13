$("#deleteUser").click(function () {
  var login = $("#user_login").val();
  var password = $("#user_password").val();
  var type = $("#type").val();
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
        var resultPassword = login + email + password;
        var sha256Password = sha256(resultPassword);
          var message = {
            user_login: login,
            user_password: sha256Password,
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
});