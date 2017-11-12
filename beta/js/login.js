function loginAttempt(redirect) {
  //alert($("#login_username").val());
  var challenge = $("#crypto_challenge").val();
  var sessionid = $("#session_id").val();
  var username = $("#login_username").val();
  var salt = CryptoJS.SHA256("DataBros-jSociety");
  var salted_password =
    CryptoJS.SHA256(username + salt + $("#login_password").val());
    //Do not store $("#login_password").val() in a variable

  sessionStorage.username = username;
  sessionStorage.crypto_key = CryptoJS.SHA256(
    username + salted_password + sessionid
  );
  // Do not store salted_password.
  //Salted password is only stored in the server database

  document.cookie = "username=" + username + "; token=" + CryptoJS.SHA256(sessionStorage.crypto_key + challenge);
  if(redirect == "") {
    loadPage("routes/feed.php");
  }
  else {
    loadPage("routes/" + redirect + ".php");
    changeURL("?page=" + redirect);
  }
}
