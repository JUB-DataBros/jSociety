<?php
  session_start();
  //include("essentials/db.php");
  include("essentials/db.php");
  //echo "password: " . $_POST['register_password'] . "<br>username: " . $_POST['register_username'] . "<br> fullname: " . $_POST['register_fullname'];
  if(strlen($_POST['register_password']) > 6
    && strlen($_POST['register_username']) > 0
    && strlen($_POST['register_fullname']) > 0) {
      //Check Input and Execute Registration Query
      $sql = "SELECT COUNT(ID) FROM STUDENT WHERE EMAIL=:username";
      $result = runSQL($sql, array("username" => $_POST['register_username']));
      echo $result->fetchAll()[0];
      //if()
      echo "<script>$('#message').attr('style', 'color:green; margin-left:16%').html('Registration Successful'); localStorage.setItem('username'," . $_POST['register_username'] . ");</script>";
  }
  else {
    echo "<script>$('#message').attr('style', 'color:red; margin-left:16%').html('Invalid Input');</script>";
  }
?>
