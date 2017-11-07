<script src="js/login.js"></script>
<script src="js/sha256.js"></script>
<?php
  $s = False;
  $timeout = 0;
  while($s == False && timeout < 10) {
    $new_challenge = bin2hex(openssl_random_pseudo_bytes(16, $s));
    // if the random number is cryptographically secure, $s is set True
    $timeout++;
  }
  if($s == True) {
    $_SESSION['crypto_challenge'] = $new_challenge;
  }
  else {
    die("New challenge cannot be securely generated");
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
      onclick="loginAttempt()">
  <br><br>
  <a name="forgotpwlink" href="#" onClick="loadPage('routes/forgotpw.php')">Forgot your password?</a>

</form>

<script>
  if (localStorage.getItem("username") !== null) {
    document.getElementById("login_username").value = localStorage.getItem("username");
    //Auto-fill username if previously existed
    //ALSO IMPLEMENT TO FORGOTPW.PHP PAGE
  }
</script>
