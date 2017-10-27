function loginAttempt() {
  alert("login attempted");
  var challenge = document.getElementById("crypto_challenge");
  var sessionid = document.getElementById("session_id");
  var username = document.getElementById("login_username");
  var salt = CryptoJS.SHA256("DataBros-jSociety");
  var salted_password =
    CryptoJS.SHA256(username + salt + document.getElementById("login_password"));

  sessionStorage.username = username;
  sessionStorage.crypto_key = CryptoJS.SHA256( // Do not store salted_password
    username + salted_password + sessionid
  );

  loadPage("partials/feed.php?username=" + username
          + "&token=" + CryptoJS.SHA256(sessionStorage.crypto_key + challenge));
}
