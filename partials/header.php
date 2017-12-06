<div class="header">
  <a href="index.php">
    <img class="logo" src="images/logo.png" alt="jSociety"></a>
  <h1>jSociety</h1>
  <?php if($_SESSION['authentication'] == 1)
          echo "<img id='logout' src='images/logout.png' alt='Log out?' onClick=\"loadPage('essentials/logout.php')\">"; ?>
</div>
