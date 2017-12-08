<?php
  session_start();
  //include_once("essentials/db.php");
  include_once("db.php");
  //echo "password: " . $_POST['register_password'] . "<br>username: " . $_POST['register_username'] . "<br> fullname: " . $_POST['register_fullname'];
  if(strlen($_POST['register_password']) > 6
    && strlen($_POST['register_username']) > 0
    && strlen($_POST['register_fullname']) > 0) {
      //Check Input and Execute Registration Query
      $sql = "SELECT COUNT(ID) FROM JSO_STUDENT WHERE EMAIL=:username";
      $args = array(":username" => $_POST['register_username']);
      $result = runSQL($sql, $args);
      if($result == null) {
        die(changeMessage("Error in database querying. Error Code: Q1001", "red"));
      }
      $result = $result -> fetchColumn();

      if($result == 0) { //Not previously registered
        $sql = "INSERT INTO JSO_STUDENT (NAME, PASSWORD, EMAIL, DOB, COLLEGE, MAJOR) VALUES (:name, :password, :email, '1900-01-01', 0, 0)";
        $args = array(":name" => $_POST['register_fullname'], ":password" => $_POST['register_password'], ":email" => $_POST['register_username']);
        $result = runSQL($sql, $args);
        if($result == null) {
          die(changeMessage("Error in database querying. Error Code: Q1002", "red"));
        }
        changeMessage("Registration successful <br> Redirecting to Login page...", "green");
        echo "<script>window.setTimeout(function(){loadPage('routes/login.php');}, 2500); localStorage.setItem('username', '" . $_POST['register_username'] . "');</script>";
      }
      else if($result == 1) { //Previously registered
        changeMessage("This e-mail address is already registered", "orange");
      }
      else {
        //More than 1 same e-mail???
        writeLOG("Multiple same e-mail addresses detected: email=" . $_POST['register_username']);
        die(changeMessage("Unexpected error. Error code: G1002", "red"));
      }
  }
  else {
    changeMessage("Invalid input", "red");
  }


  function changeMessage($message, $color) {
    $script = "<script>$('#message').attr('style', 'color:" . $color . "; margin-left:16%').html('" . $message . "');</script>";
    echo $script;
    return $script; //Use only inside Die() when you cannot echo
  }
?>
