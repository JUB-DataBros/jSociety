<!doctype html>
<html>
  <head>
    <title>jSociety - Registration Page</title>
    <script src="js/register.js"></script>
  </head>
  <body>
  <a name="gobacktologin" style="color:orange" onClick="loadPage('routes/login.php')">Go back to Login</a>
  <form method="POST" id="register_form" style="margin-left:10%;margin-top:5%">
    <table>
      <tr>
        <td align="right">Full name</td>
        <td><input type="text" id="register_fullname" placeholder="Full Name"></td>
      </tr>
      <tr>
        <td align="right">E-mail</td>
        <td><input type="text" id="register_username" placeholder="e-mail address"></td>
        <td>@jacobs-university.de</td>
      </tr>
      <tr>
        <td align="right">Password</td>
        <td><input type="password" id="register_password" placeholder="********"></td>
      </tr>
      <tr>
        <td align="right">Re-enter password</td>
        <td><input type="password" id="register_reenter_password" placeholder="********"></td>
      </tr>
      <tr>
        <td></td>
        <td align="center"><input type="button" name="submit_register" value="Register" onClick="registerAttempt(<?php echo isset($_GET['page']) ? $_GET['page'] : "''";?>)"></td>
      </tr>
    </table><br><br>

    <p id="message" style="color:red; margin-left:16%"></p>
  </form>


  <?php
    session_start();
    include("essentials/db.php");
    if(isset($_POST['submit_register'])) {
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
