function loginAttempt() {
  alert($("#login_username").val());
  var challenge = $("#crypto_challenge").val();
  var sessionid = $("#session_id").val();
  var username = $("#login_username").val();
  var salt = CryptoJS.SHA256("DataBros-jSociety");
  var salted_password =
    CryptoJS.SHA256(username + salt + $("#login_password").val());

  sessionStorage.username = username;
  sessionStorage.crypto_key = CryptoJS.SHA256( // Do not store salted_password
    username + salted_password + sessionid
  );

  loadPage("routes/feed.php?username=" + username
          + "&token=" + CryptoJS.SHA256(sessionStorage.crypto_key + challenge));
}
