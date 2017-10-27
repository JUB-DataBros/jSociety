<form method="POST">
  <input type="text" name="login_username" placeholder="Username"
    <?php
      $_SESSION['crypto_counter'] = 0;
      //if this page is loaded, counter must be set 0
      if(isset($_SESSION['username'])) {
        echo "value=\"" + $_SESSION['username'] + "\"";
      }
    ?>
  >
  <br>
  <input type="password" name="login_password" placeholder="********">
  <br><br>
  <input type="button" name="login_submit" value="Enter" onclick="loginAttempt()">
  <br><br>
  <a name="forgotpwlink" href="#">Forgot your password?</a>
  <script>
    $(document).ready(
      function() {
        document.getElementById("forgotpwlink").onClick = loadPage("forgotpw.php");
      }
    );
  </script>
</form>
