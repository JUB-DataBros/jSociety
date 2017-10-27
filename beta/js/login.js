function loginAttempt() {
  var challenge = document.getElementById("crypto_challenge").value;
  var sessionid = document.getElementById("session_id").value;
  var username = document.getElementById("login_username").value;
  var salt = CryptoJS.SHA256("DataBros-jSociety");
  var salted_password =
    CryptoJS.SHA256(username + salt + document.getElementById("login_password").value);

  sessionStorage.username = username;
  sessionStorage.crypto_key = CryptoJS.SHA256( // Do not store salted_password
    username + salted_password + sessionid
  );

  loadPage("routes/feed.php?username=" + username
          + "&token=" + CryptoJS.SHA256(sessionStorage.crypto_key + challenge));
}
