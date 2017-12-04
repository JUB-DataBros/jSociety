<h1 id="message" style="color:orange">Logging out</h1>
<?php
  //Delete all SESSION variables
  SESSION_DESTROY();
  SESSION_START();
  $_SESSION['authentication'] = 0;
  //Delete the cookies
  setcookie("username", "", time()-3600, "/jSociety/beta/");
  setcookie("token", "", time()-3600, "/jSociety/beta/");
?>
<script>
  //Remove the crypto_key from the local storage
  localStorage.removeItem("crypto_key");
  //Keep the username for future auto-fill
  $("#message").attr("style", "color:royalblue").html("Logout successful !");
  location.replace("index.php");
</script>
