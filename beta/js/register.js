function registerAttempt(redirect) {
  if($("#register_fullname").val() === "") {
    $("#message").html("Full name cannot be left blank<br>");
  }
  else if($("#register_username").val() === "") {
    $("#message").html("E-mail cannot be left blank<br>");
  }
  else if($("#register_password").val() != $("#register_reenter_password").val()) {
    $("#message").html("Passwords do not match<br>");
  }
  else if($("#register_password").val().length < 6) {
    $("#message").html("Password cannot be shorter than 6 characters<br>");
  }
  else {
    $("#message").html("");
    loadPage("essentials/check_register.php");
  }
}


function loadCheckRegister() {
  var username = $("#register_username").val();
  var salt = "98866a88c5fb4683636443dfb0e7d2a67c892baadc65749edad0fa5d588f7d6b";
  var salted_password =
    CryptoJS.SHA256(username + salt + $("#register_password").val());

  $.ajax({
    method: "POST",
    url: "essentials/check_register.php",
    data: {"fullname"=$("#register_fullname").val(), "username"=username,
           "password"=salted_password, "redirect"=redirect}
  })

  .done(function(data) {
    $(".body").append(data);
  })

  .fail(function(data) {
    alert("Registration could not be completed");
    loadPage("routes/register.php");
  });
}
