<script src="js/login.js"></script>
<script src="js/sha256.js"></script>
<!-- Cannot be included directly from login.php -->
<script>localStorage.removeItem("crypto_key");</script>
<?php
  session_start();
  include("essentials/db.php");
  if($_SESSION['authentication'] == 1) {
    echo "<script>loadPage('routes/feed.php');</script>";
  }
  $s = False;
  $timeout = 0;
  while($s == False && timeout < 10) {
    $new_challenge = hash("sha256", bin2hex(openssl_random_pseudo_bytes(256, $s)), false);
    // if the random number is cryptographically secure, $s is set True
    $timeout++;
  }
  if($s == True) {
    //echo "<script>$('document').ready(function(){alert(document.cookie);});</script>"; //!!!!!!!!!!!!!! COOKIE DOES NOT INCLUDE THE CHALLENGE COOKIE !!!!!!!!!!!!!!!!!
    $_SESSION['crypto_challenge'] = $new_challenge;
    setcookie("challenge", $_SESSION['crypto_challenge'],0 ,"/jSociety/beta/"); //To be changed upon deployment
  }
  else {
    writeLOG("Crypto challenge could not be generated in 'login.php'");
    die("<h1>Unexpected Error</h1><br>Error code: J1001. <a onClick=\"loadPage('index.php')\">Click here to continue</a>");
  }
?>

<form method="POST" style="margin-left:20%;margin-top:15%">
  <?php
    if($_SESSION['authentication'] == -1) {
      echo "<div style='color:red'>Incorrect Username or Password</div><br>";
      $_SESSION['authentication'] = 0;
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
  <a name="forgotpwlink" style="margin-left:30px" onClick="loadPage('routes/forgotpw.php<?php echo isset($_GET['page']) ? "?page=" . $_GET['page'] : "";?>')">Forgot your password?</a>
  <?php //Carry $_GET['page'] across pages ?>

</form>

<script>
  if (localStorage.getItem("username") !== null) {
    //alert("found");
    document.getElementById("login_username").value = localStorage.getItem("username");
    //Auto-fill username if previously existed
    //ALSO IMPLEMENT TO FORGOTPW.PHP PAGE
  }
</script>
