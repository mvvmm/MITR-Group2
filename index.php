<?php require_once 'controllers/functions.php'?>
<!doctype html>
<html>
<head>
  <?php include 'style.php'?>
  <meta charset="utf-8">
  <title>JANRenovation</title>
</head>
<body>
<?php include 'navbar.php'; ?>
<h1>Index</h1>
 <?php
	$user_type = getPrivilege();
	if($user_type == "employee"){
	  echo "  <div class='form-group'>";
	  echo "      <select class='form-control' id='privilege' name='privilege'>";
	  echo "        <option selected disabled>Privilege</option>";
	  echo "        <option value='employee'>Employee</option>";
	  echo "        <option value='scheduler'>Scheduler</option>";
	  echo "        <option value='admin'>Admin</option>";
	  echo "      </select>";
	  echo "   </div>";
	}
?>
</body>
</html>
