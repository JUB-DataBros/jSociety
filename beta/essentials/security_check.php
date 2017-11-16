<!--
This must be included in every partial other than login.php and forgotpw.php
//Those partial pages will not run if $_GET['token'] is not valid
//login.php creates its own (crypto) challenge
-->
<?php
  SESSION_START();
  $getPage = isset($_GET['page']) ? "?page=" . $_GET['page'] : "";
  $error_script = "<script>loadPage('index.php" . $getPage . "'); location.replace('index.php');</script>";
  if(isset($_COOKIE['username']) && isset($_COOKIE['token'])) {
    //Fetch salted password from DB
    //Don't keep the salted password in a SESSION variable
    $salt = hash("sha256", "jSociety by DataBros", false);
    $password = substr($_COOKIE['username'], 0, 3) + "123";
    $salted_password = hash("sha256", $_COOKIE['username'] . $salt . $password);
    //In this test case, password for each username starts with
    //the first 3 letters of the username and followed by "123",
    //Normally fetch salted_password from the database


    if($_COOKIE['token'] ===
       hash("sha256", hash("sha256", $_COOKIE['username']
                                   + $salted_password
                                   + session_id())
                    + $_SESSION['crypto_challenge']
                   //Fetch the crypto_challenge from the session, not from the cookie
                   //Cookie might be tampered
      )
    ) {
      $_SESSION['authentication'] = 1;
      $_SESSION['username'] = $_COOKIE['username']; //It will be needed
      //$_SESSION['userid'] = ... Fetch user ID here !!!!!!!!!!!!!!1
      include("sidebar.php");
      //Only end that doesn't die()
    }
    else {
      $_SESSION['authentication'] = -1;
      unset($_SESSION['username']);
      unset($_SESSION['userid']);
      die($error_script);
      //Deny Authentication !
    }
  }
  else {
    $_SESSION['authentication'] = 0;
    die($error_script);
    //Deny authentication and redirect to login with $_GET['page']
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
    setcookie("challenge", $_SESSION['crypto_challenge'], 0, "/jSociety/beta/"); //To be changed upon deployment
    //Not sure if 3600 is in seconds
    //Session and cookie are always syncronized on the crypto challenge
    //Thats why always use those two to refer the crypto challenge
    //Do not use hidden form input
    //This allows multiple tabs

  }
  else {
    writeLOG("New crypto challenge could not be generated in 'security_check.php'");
    die("<h1>Unexpected Error</h1><br>Error code: J1002. <a onClick=\"loadPage('index.php')>Click here to continue</a>\"");
  }
?>
<script>
  //JAVASCRIPT UPDATES THE TOKEN BASED ON THE NEW CHALLENGE AND CRYPTO KEY AND WRITES IT INTO THE COOKIE
  //var sessionid = document.cookie.match('(^|;)\\s*PHPSESSID\\s*=\\s*([^;]+)');
  var sessionid = "<?php echo session_id();?>";
  var username = localStorage.getItem("username");
  var crypto_challenge = document.cookie.match('(^|;)\\s*challenge\\s*=\\s*([^;]+)');
  var token = CryptoJS.SHA256(localStorage.getItem("crypto_key") + crypto_challenge);

  document.cookie = "username=" + username;
  document.cookie = "token=" + token;
</script>
