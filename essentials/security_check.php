<!--
This must be included in every partial other than login.php and forgotpw.php
//login.php creates its own crypto challenge
-->
<?php
  include_once("db.php");
  SESSION_START();
  $error_script = "<script>$('div.sidebar').remove();$('img#logout').remove();loadPage('routes/login.php');</script>";
  if(isset($_COOKIE['username']) && isset($_COOKIE['token'])) {
    //Fetch salted password from DB
    //Don't keep the salted password in a SESSION variable
    //$salt = hash("sha256", "jSociety by DataBros", false);
    //The same as above but no need to compute every time
    $salt = "98866a88c5fb4683636443dfb0e7d2a67c892baadc65749edad0fa5d588f7d6b";
    //$password = substr($_COOKIE['username'], 0, 3) . "123";
    //In this test case, password for each username starts with
    //the first 3 letters of the username and followed by "123"
    //$salted_password = hash("sha256", $_COOKIE['username'] . $salt . $password, false);
    $sql = "SELECT PASSWORD FROM JSO_STUDENT WHERE EMAIL = :username";
    $args = array(":username" => $_COOKIE['username']);
    $result = runSQL($sql, $args);
    if($result == null) {
      die("<h1 style='color:red'>Error in database querying</h1> <br>Error Code: Q1003");
    }
    $result = $result -> fetch();
    $salted_password = $result["PASSWORD"];
    //Expected crypto key
    $crypto_key = hash("sha256", $_COOKIE['username'] . $salted_password . session_id(), false);
    //Expected token
    $token = hash("sha256", $crypto_key . $_SESSION['crypto_challenge'], false);
    //For comparison with user-side script
    //die($_COOKIE['username'] . "<br>" . $salt . "<br>" . $password . "<br>" . $salted_password . "<br>" . session_id() . "<br>" . $crypto_key . "<br>" . $_SESSION['crypto_challenge'] . "<br>" . $token . "<br>");
    //echo $_COOKIE['username'] . "<br>" . $salt . "<br>" . $password . "<br>" . $salted_password . "<br>" . session_id() . "<br>" . $crypto_key . "<br>" . $_SESSION['crypto_challenge'] . "<br>" . $token . "<br>";
    //Compare
    if($_COOKIE['token'] === $token) { //SUCCESSFUL AUTHENTICATION
      if($_SESSION['authentication'] != 1) { //Initial login
        $newLogin = 1;
      }
      $_SESSION['authentication'] = 1;
      $_SESSION['username'] = $_COOKIE['username']; //It will be needed
      $_SESSION['usertype'] = 1;
      $sql = "SELECT ID FROM JSO_STUDENT WHERE EMAIL = :username";
      $args = array(":username" => $_SESSION['username']);
      $result = runSQL($sql, $args);
      if($result == null) {
        die("<h1 style='color:red'>Error in database querying</h1> <br>Error Code: Q1004</h1>");
      }
      $result = $result -> fetch();
      $_SESSION['userid'] = $result[0];
      //Load the sidebarClick
      echo "<script>loadSidebar();</script>";
      //Only end that doesn't die()
    }
    else {
      $_SESSION['authentication'] = -1;
      unset($_SESSION['username']);
      unset($_SESSION['userid']);
      unset($_SESSION['usertype']);
      //Remove the incorrect cookie values username and token
      setcookie("username", "", time()-3600, "/");
      setcookie("token", "", time()-3600, "/");
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
    setcookie("challenge", $_SESSION['crypto_challenge'], 0, "/"); //To be changed upon deployment
    //Session and cookie are always syncronized on the crypto challenge
    //Thats why always use those two to refer the crypto challenge
    //Do not use hidden form input
    //This allows multiple tabs

  }
  else {
    writeLOG("New crypto challenge could not be generated in 'security_check.php'");
    die("<h1>Unexpected Error</h1><br>Error code: S1003<br><a onClick=\"loadPage('index.php')>Click here to continue</a>\"");
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
    var token = CryptoJS.SHA256(localStorage.getItem("crypto_key") + crypto_challenge).toString();

    document.cookie = "username=" + username + "; path=/";
    document.cookie = "token=" + token + "; path=/";
    <?php
      if($newLogin == 1) { //Load the requested page
        echo "if(findGetParameter('page') != null) {loadPage('routes/' + findGetParameter('page') + '.php');}";
      }
    ?>
  }
</script>
