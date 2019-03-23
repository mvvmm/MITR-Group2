<!doctype html>
<html>
<head>
  <?php include 'style.php'?>
  <meta charset="utf-8">
  <title>JANRenovation</title>
</head>
<body>
<h1>Index</h1>
<a class="btn btn-primary" href="create_account.php" role="button">Create Account</a>
<a class="btn btn-primary" href="edit_account.php" role="button">Edit Account</a>

<?php
if(isset($_COOKIE['JAN-SESSION'])){
  echo "<a class='btn btn-primary' href='controllers/logout_controller.php'>Logout</a>";
}else{
  echo "<a class='btn btn-primary' href='login.php'>Login</a>";
}
?>

</body>
</html>
