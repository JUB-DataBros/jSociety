<?php
  if($_SESSION['authentication'] == 1) {
    //Handle quick refresh logouts
    //!!!!!!!!!!!!!!!
  }
  else if(isset($_COOKIE['username']) && isset($_COOKIE['token'])) {
    echo "<script>loadPage('routes/feed.php');</script>";
  }
  else {
    echo "<script>localStorage.removeItem('crypto_key');</script>";
  }

  session_start();
  if($_SESSION['authentication'] == 1) {
    die("<script>loadPage('routes/feed.php');</script>");
  }
  $s = False;
  $timeout = 0;
  while($s == False && $timeout < 10) {
    $new_challenge = hash("sha256", bin2hex(openssl_random_pseudo_bytes(256, $s)), false);
    // if the random number is cryptographically secure, $s is set True
    $timeout++;
  }
  if($s == True) {
    $_SESSION['crypto_challenge'] = $new_challenge;
    setcookie("challenge", $_SESSION['crypto_challenge'],0 ,"/"); //To be changed upon deployment
  }
  else {
    writeLOG("Crypto challenge could not be generated in 'login.php'");
    die("<h1>Unexpected Error</h1><br>Error code: J1001. <a onClick=\"loadPage('index.php')\">Click here to continue</a>");
  }
?>

<form method="POST" style="margin-left:20%;margin-top:5%">
  <?php
    //echo $_SESSION['authentication'] . "<br>";
    if($_SESSION['authentication'] == -1) {
      echo "<div style='color:red;margin-left:-1.5%'>Incorrect Username or Password</div><br>";
      $_SESSION['authentication'] = 0;
    }
    else {
      echo "<div style='color:royalblue;margin-left:95px'>Login</div><br>"; //So the form position will remain the same
      //regardless of whether there is the incorrect credentials message
    }
  ?>
  <input type="text" id="login_username" placeholder="e-mail address">
  @jacobs-university.de
  <br>
  <input type="password" id="login_password" placeholder="********">
  <br><br>
  <input type="button" name="login_submit" value="Login" style="margin-left:85px"
      onclick="loginAttempt(<?php echo isset($_GET['page']) ? $_GET['page'] : "''";?>)">
      <?php //Handle redirection upon non-logged-on page request ?>
  <br><br>
  <a name="forgotpwlink" style="margin-left:30px; color:darkorange" onClick="loadPage('routes/forgotpw.php')">Forgot your password?</a>
  <br><br>
  <?php //echo isset($_GET['page']) ? "?page=" . $_GET['page'] : "";?>
  <a name="registerlink" style="margin-left:85px; color:darkblue" onClick="loadPage('routes/register.php')">Register</a>

</form>

<script>
    var sessionid = "<?php echo session_id();?>";
    var crypto_challenge = "<?php echo $_SESSION['crypto_challenge'];?>";
    if (localStorage.getItem("username") !== null) {
      document.getElementById("login_username").value = localStorage.getItem("username");
      //Auto-fill username if previously existed
      //ALSO IMPLEMENT TO FORGOTPW.PHP PAGE
    }
</script>
<script src="js/login.js">//This should remain after the previous script block</script>
