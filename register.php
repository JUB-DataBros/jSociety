<!doctype html>
<html>
  <head>
    <title>jSociety - Registration Page</title>
  </head>
  <body>
  <form method="POST">
    E-mail:
    <input type="text" name="register_username" placeholder="e-mail address">
    @jacobs-university.de
    <br>
    Password:
    <input type="password" name="register_password" placeholder="********">
    <br>
    Re-enter password:
    <input type="password" name="register_reenter_password" placeholder="********">
    <br><br>
    <input type="submit" name="submit_register" value="Register">
    <br><br>
  </form>

    <?php
      //session_start();
      //include("partials/dbconnect.php");
      if(isset($_POST['submit_register'])) {
        if($_POST['register_password'] === $_POST['register_reenter_password']) {
          if(strlen($_POST['register_password']) >= 6
            && strlen($_POST['register_username']) > 0) {
              //$sql = "SELECT COUNT (*) FROM dabr_users WHERE username = '" . mysql_real_escape_string($_POST['register_username']) . "'");
              //$rs = $conn->query($sql);
              //$rs->data_seek(0);
              //$row = $rs->fetch_row();
              //if($row[0] == 0) {
                //$sql = "INSERT INTO dabr_users VALUES(username='" . mysql_real_escape_string($_POST['register_username']) . "', password='" . mysql_real_escape_string($_POST['register_password']) "')";
                //$rs = $conn->query($sql);
                //echo "Registration successful. <a href='index.php'>Click here</a> to log in";
              //}
              //else {
                //echo "User already exists";
              //}
              echo "Registration successful. <a href='index.php'>Click here</a> to log in";
          }
          else {
            echo "Invalid input. Password must be at least 6 characters long and Username cannot be left empty";
          }
        }
        else {
          echo "Passwords do not match";
        }
      }

    ?>

  </body>
</html>
