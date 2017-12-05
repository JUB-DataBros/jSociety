function loginAttempt(redirect) {
  //window.onload = function(){
    //alert($("#login_username").val());
    //var crypto_challenge = $("#crypto_challenge").val();
    //var sessionid = $("#session_id").val();
    //var crypto_challenge = document.cookie.match('(^|;)\\s*challenge\\s*=\\s*([^;]+)');
    //var sessionid = document.cookie.match('(^|;)\\s*PHPSESSID\\s*=\\s*([^;]+)');
    var username = $("#login_username").val();
    //var salt = CryptoJS.SHA256("jSociety by DataBros");
    //The same as above but no need to compute every time
    var salt = "98866a88c5fb4683636443dfb0e7d2a67c892baadc65749edad0fa5d588f7d6b";
    var salted_password =
      CryptoJS.SHA256(username + salt + $("#login_password").val());
      //Do not store $("#login_password").val() in a variable
    var crypto_key = CryptoJS.SHA256(username + salted_password + sessionid);
    // Do not store salted_password.
    //Salted password is only stored in the server database
    //Instead store the crypto key
    localStorage.setItem("username", username);
    localStorage.setItem("crypto_key", crypto_key);

    var token = CryptoJS.SHA256(localStorage.getItem("crypto_key") + crypto_challenge)

    document.cookie = "username=" + username;
    document.cookie = "token=" + token;

    //For comparison with server-side script
    //alert(username + "\n" + salt + "\n" + $("#login_password").val() + "\n" + salted_password + "\n" + sessionid + "\n" + crypto_key + "\n" + crypto_challenge  + "\n" + token + "\n");
    //Remove this^ comment upon deployment !
    if(redirect == "") {
      //loadSidebar();
      loadPage("routes/feed.php");
      //window.location = "index.php";
    }
    else {
      loadPage("routes/" + redirect + ".php");
      changeURL("?page=" + redirect);
      //window.location = "index.php?page=" + redirect;
    }
  //};
}
