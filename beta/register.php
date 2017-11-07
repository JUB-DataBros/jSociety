<!doctype html>
<html>
  <head>
    <title>jSociety - Registration Page</title>
  </head>
  <body>
  <form method="POST" style="margin-left:20%;margin-top:15%">
    <!-- margins are temporary until CSS file is arranged -->
    E-mail:
    <input type="text" id="register_username" placeholder="e-mail address">
    @jacobs-university.de
    <br>
    Password:
    <input type="password" id="register_password" placeholder="********">
    <br>
    Re-enter password:
    <input type="password" id="register_reenter_password" placeholder="********">
    <br><br>
    <input type="submit" name="submit_register" value="Register">
    <br><br>
  </form>

  <?php
    session_start();
    include("partials/dbconnect.php");
    if(isset('submit_register')) {
      if($_POST['register_password'] == $_POST['register_reenter_password']) {
        if(strlen($_POST['register_password']) > 6
          && strlen($_POST['register_username']) > 0) {

        }
        else {
          echo "<div style='color:red'>Invalid input. Password must be at least 6 characters long and Username cannot be left empty</div>";
        }
      }
      else {
        echo "<div style='color:red'>Passwords do not match</div>";
      }
    }

  ?>

  </body>
</html>
