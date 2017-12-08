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
          <td><input type="text" id="register_fullname" placeholder="Full Name" autocomplete="off"></td>
        </tr>
        <tr>
          <td align="right">E-mail</td>
          <td><input type="text" id="register_username" placeholder="e-mail address" autocomplete="off"></td>
          <td>@jacobs-university.de</td>
        </tr>
        <tr>
          <td align="right">Password</td>
          <td><input type="password" id="register_password" placeholder="********" autocomplete="off"></td>
        </tr>
        <tr>
          <td align="right">Re-enter password</td>
          <td><input type="password" id="register_reenter_password" placeholder="********" autocomplete="off"></td>
        </tr>
        <tr>
          <td></td>
          <td align="center"><input type="button" name="submit_register" value="Register" onClick="registerAttempt()"></td>
        </tr>
      </table><br><br>

      <p id="message" style="color:red; margin-left:16%"></p>
    </form>

    <div class="register_check"><br></div>


  </body>
</html>
