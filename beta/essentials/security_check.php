<!--
This must be included in every partial other than login.php and forgotpw.php
//login.php creates its own crypto challenge
-->
<?php
  SESSION_START();
  $getPage = isset($_GET['page']) ? "?page=" . $_GET['page'] : "";
  $error_script = "<script>loadPage('routes/login.php" . $getPage . "');</script>";
  if(isset($_COOKIE['username']) && isset($_COOKIE['token'])) {
    //Fetch salted password from DB
    //Don't keep the salted password in a SESSION variable
    //$salt = hash("sha256", "jSociety by DataBros", false);
    //The same as above but no need to compute every time
    $salt = "98866a88c5fb4683636443dfb0e7d2a67c892baadc65749edad0fa5d588f7d6b";
    $password = substr($_COOKIE['username'], 0, 3) . "123";
    //In this test case, password for each username starts with
    //the first 3 letters of the username and followed by "123"
    $salted_password = hash("sha256", $_COOKIE['username'] . $salt . $password, false);
    //Normally fetch salted_password from the database

    //Expected crypto key
    $crypto_key = hash("sha256", $_COOKIE['username'] . $salted_password . session_id(), false);
    //Expected token
    $token = hash("sha256", $crypto_key . $_SESSION['crypto_challenge'], false);
    //For comparison with user-side script
    //die($_COOKIE['username'] . "<br>" . $salt . "<br>" . $password . "<br>" . $salted_password . "<br>" . session_id() . "<br>" . $crypto_key . "<br>" . $_SESSION['crypto_challenge'] . "<br>" . $token . "<br>");
    //echo $_COOKIE['username'] . "<br>" . $salt . "<br>" . $password . "<br>" . $salted_password . "<br>" . session_id() . "<br>" . $crypto_key . "<br>" . $_SESSION['crypto_challenge'] . "<br>" . $token . "<br>";
    //Compare
    if($_COOKIE['token'] === $token) {
      $_SESSION['authentication'] = 1;
      $_SESSION['username'] = $_COOKIE['username']; //It will be needed
      //$_SESSION['userid'] = ... Fetch user ID here !!!!!!!!!!!!!!1
      //$_SESSION['usertype'] = ... Fetch type of the user here. 0 for admin 1 for user
      //Load the sidebarClick
      echo "<script>if(sidebarLoaded == 0){loadSidebar();}</script>";
      //Only end that doesn't die()
    }
    else {
      $_SESSION['authentication'] = -1;
      unset($_SESSION['username']);
      unset($_SESSION['userid']);
      unset($_SESSION['usertype']);
      //Remove the incorrect cookie values username and token
      setcookie("username", "", time()-3600, "/jSociety/beta/");
      setcookie("token", "", time()-3600, "/jSociety/beta/");
      //Because if these cookies are present login.php redirects to feed.php that includes this page
      //In case the user was already logged in but opens login.php
      die($error_script); //Reload login page
      //Deny authentication and redirect to login with $_GET['page']
    }
  }
  else {
    $_SESSION['authentication'] = 0;
    die($error_script); //Reload login page
    //Deny authentication and redirect to login with $_GET['page']
  }

  //User is authenticated
  //Prepare the next challenge
  $s = False;
  $timeout = 0;
  while($s == False && timeout < 10) {
    $new_challenge = hash("sha256", bin2hex(openssl_random_pseudo_bytes(256, $s)), false);
    //If the random number is cryptographically secure, $s is set True
    $timeout++;
  }
  if($s == True) {
    $_SESSION['crypto_challenge'] = $new_challenge;
    setcookie("challenge", $_SESSION['crypto_challenge'], 0, "/jSociety/beta/"); //To be changed upon deployment
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
  $(document).ready(solveChallenge());
  //JAVASCRIPT UPDATES THE TOKEN BASED ON THE NEW CHALLENGE AND CRYPTO KEY AND WRITES IT INTO THE COOKIE
  function solveChallenge() {
    //var sessionid = document.cookie.match('(^|;)\\s*PHPSESSID\\s*=\\s*([^;]+)');
    var sessionid = "<?php echo session_id();?>";
    var username = localStorage.getItem("username");
    //var crypto_challenge = document.cookie.match(new RegExp('challenge' + '=([^;]+)'))[1];
    var crypto_challenge = "<?php echo $_SESSION['crypto_challenge'];?>";
    var token = CryptoJS.SHA256(localStorage.getItem("crypto_key") + crypto_challenge);

    document.cookie = "username=" + username;
    document.cookie = "token=" + token;
  }
</script>
