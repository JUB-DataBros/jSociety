function registerAttempt() {
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
    $("#message").attr("style", "color:blue; margin-left:16%").html("Processing...");
    loadCheckRegister();
  }

}


function loadCheckRegister() {
  var username = $("#register_username").val();
  var salt = "98866a88c5fb4683636443dfb0e7d2a67c892baadc65749edad0fa5d588f7d6b";
  var salted_password =
    CryptoJS.SHA256(username + salt + $("#register_password").val()).toString();
  //Do not send plain-password
  alert(username + "\n" + salted_password);
  $.ajax({
    method: "POST",
    url: "essentials/register_check.php",
    data: {register_fullname:$("#register_fullname").val(), register_username:username,
           register_password:salted_password}
  })

  .done(function(data) {
    $(".body").append(data);
  })

  .fail(function(data) {
    $("#message").attr("style", "color:red; margin-left:16%")
                 .html("Registration form could not be processed. Error code: R1001.");
  });

}
