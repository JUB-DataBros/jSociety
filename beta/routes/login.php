<script src="js/login.js"></script>
<script src="js/sha256.js"></script>
<?php
  session_abort(); //In case login.php is loaded when already logged in
  session_start();
  include("essentials/db.php");
  $s = False;
  $timeout = 0;
  while($s == False && timeout < 10) {
    $new_challenge = hash("sha256", bin2hex(openssl_random_pseudo_bytes(256, $s)), false);
    // if the random number is cryptographically secure, $s is set True
    $timeout++;
  }
  if($s == True) {
    $_SESSION['crypto_challenge'] = $new_challenge;
  }
  else {
    writeLOG("Crypto challenge could not be generated in 'login.php'");
    die("<h1>Unexpected Error</h1><br>Error code: J1001. <a onClick=\"loadPage('routes/feed.php')>Click here to continue</a>\"");
  }
?>
<div class="hidden">
  <input type="hidden" id="crypto_challenge" value="<?php echo $_SESSION['crypto_challenge']; ?>">
  <input type="hidden" id="session_id" value="<?php echo session_id(); ?>">
</div>

<form method="POST" style="margin-left:20%;margin-top:15%">
  <!-- margins are temporary until CSS file is arranged -->
  <input type="text" id="login_username" placeholder="e-mail address">
  @jacobs-university.de
  <br>
  <input type="password" id="login_password" placeholder="********">
  <br><br>
  <input type="button" name="login_submit" value="Enter"
      onclick="loginAttempt(<?php echo $_GET['page'];?>)">
      <?php //Handle redirection upon non-logged-on page request ?>
  <br><br>
  <a name="forgotpwlink" onClick="loadPage('routes/forgotpw.php<?php if(isset($_GET['page'])) {echo "?page=" + $_GET['page'];}?>')">Forgot your password?</a>
  <?php //Carry $_GET['page'] across pages ?>

</form>

<script>
  if (localStorage.getItem("username") !== null) {
    document.getElementById("login_username").value = localStorage.getItem("username");
    //Auto-fill username if previously existed
    //ALSO IMPLEMENT TO FORGOTPW.PHP PAGE
  }
</script>
