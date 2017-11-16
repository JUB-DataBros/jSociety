function loginAttempt(redirect) {
  //alert($("#login_username").val());
  //var crypto_challenge = $("#crypto_challenge").val();
  //var sessionid = $("#session_id").val();
  var crypto_challenge = document.cookie.match('(^|;)\\s*challenge\\s*=\\s*([^;]+)');
  var sessionid = document.cookie.match('(^|;)\\s*PHPSESSID\\s*=\\s*([^;]+)');
  var username = $("#login_username").val();
  var salt = CryptoJS.SHA256("jSociety by DataBros");
  var salted_password =
    CryptoJS.SHA256(username + salt + $("#login_password").val());
    //Do not store $("#login_password").val() in a variable
  var crypto_key = CryptoJS.SHA256(username + salted_password + sessionid);
  // Do not store salted_password.
  //Salted password is only stored in the server database
  localStorage.setItem("username", username);
  localStorage.setItem("crypto_key", crypto_key);

  var token = CryptoJS.SHA256(localStorage.getItem("crypto_key") + crypto_challenge)

  document.cookie = "username=" + username;
  document.cookie = "token=" + token;
  if(redirect == "") {
    loadPage("routes/feed.php");
  }
  else {
    loadPage("routes/" + redirect + ".php");
    changeURL("?page=" + redirect);
  }
}
