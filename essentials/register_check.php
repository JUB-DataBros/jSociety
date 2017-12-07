<?php
  session_start();
  //include("essentials/db.php");
  include("essentials/db.php");
  echo "password: " . $_POST['register_password'] . "<br>username: " . $_POST['register_username'] . "<br> fullname: " . $_POST['register_fullname'];
  if(strlen($_POST['register_password']) > 6
    && strlen($_POST['register_username']) > 0
    && strlen($_POST['register_fullname']) > 0) {
      //Check Input and Execute Registration Query
      echo "<script>$('#message').attr('style', 'color:green').html('Registration Successful'); localStorage.setItem('username'," . $_POST['register_username'] . ");</script>";
  }
  else {
    echo "<script>$('#message').attr('style', 'color:red').html('Invalid input. Registration failed.');</script>";
  }
?>
