<!--
This must be included in every partial other than login.php and forgotpw.php
//Those partial pages will not run if $_GET['token'] is not valid
//login.php creates its own (crypto) challenge
-->
<?php
  SESSION_START();

  if($isset($_COOKIE['username']) && isset($_SESSION['salted_password']) == false) {
    //Fetch salted password from DB
    $_SESSION['salted_password'] = substr($_COOKIE['username'], 0, 3) + "123";
    //In this test case, password for each username starts with
    //the first 3 letters of the username and followed by "123",
    //Normally fetch salted_password from the database
    //If user provides tampered username in the cookie, it will be denied
  }
  else {
    echo "<script>loadPage('partials/login.php');</script>";
    //This is okay, because if token is wrong, page will be denied anyway
  }
  if(isset($_COOKIE['token']) &&
    $_COOKIE['token'] ===
    hash("sha256", hash("sha256", $_COOKIE['username']
                                + $_SESSION['salted_password']
                                + session_id())
                 + $_SESSION['crypto_challenge']
                 //Fetch the crypto_challenge from the session, not from the cookie
    )
  ) {
    $_SESSION['authentication'] = 1;
    $_SESSION['username'] = $_COOKIE['username']; //It will be needed
    include("sidebar.php");
  }
  else {
    $_SESSION['authentication'] = -1;
    unset($_SESSION['username']);
    unset($_SESSION['id']);
    die("<h1>Authentication Failed</h1><br><a onClick = \"loadPage('routes/login.php')\">Click here to continue</a>");
  }

  //User is authenticated
  //Prepare the next challenge
  $s = False;
  $timeout = 0;
  while($s == False && timeout < 10) {
    $new_challenge = hash("sha256", bin2hex(openssl_random_pseudo_bytes(256, $s)), false);
    // if the random number is cryptographically secure, $s is set True
    $timeout++;
  }
  if($s == True) {
    $_SESSION['crypto_challenge'] = $new_challenge;
    setcookie("challenge", $_SESSION['crypto_challenge'], time()+3600);
    //Not sure if 3600 is seconds
    //Session and cookie are always syncronized on the crypto challenge
    //Thats why always use those two to refer the crypto challenge
    //Do not use hidden form input
    //This allows multiple tabs

  }
  else {
    die("New challenge could not be securely generated");
  }
?>
<script>
  //JAVASCRIPT UPDATES THE TOKEN BASED ON THE NEW CHALLENGE AND CRYPTO KEY AND WRITES IT INTO THE COOKIE
  //var sessionid = document.cookie.match('(^|;)\\s*PHPSESSID\\s*=\\s*([^;]+)');
  var sessionid = "<?php echo session_id();?>";
  var username = sessionStorage.username;
  var crypto_challenge = document.cookie.match('(^|;)\\s*challenge\\s*=\\s*([^;]+)');
  var token = CryptoJS.SHA256(sessionStorage.crypto_key + crypto_challenge);

  document.cookie = "PHPSESSID=" + sessionid + "; username=" + username + "; token=" + token;
</script>
