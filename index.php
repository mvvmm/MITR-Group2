<?php require_once 'controllers/functions.php'?>
<!doctype html>
<html lang="en">
<head>
  <?php include 'style.php'?>
  <?php include 'script.php'?>
  <meta charset="utf-8">
  <title>JANRenovation</title>
</head>
<body>
  <div class="p-5">
    <?php include 'navbar.php';?>
  </div>
  <?php
  $user_type = getPrivilege();
  if($user_type == "employee"){?>

  <div class="container-fluid pt-5">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="pt-5 pb-2">Your Work Schedule</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-2 col-md-12 m-auto">
        <table class="table table-bordered">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Monday</th></tr>
          </thead>
          <tbody id="Monday"></tbody>
        </table>
      </div>

      <div class="col-lg-2 col-md-12 m-auto">
        <table class="table table-bordered">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Tuesday</th></tr>
          </thead>
          <tbody id="Tuesday"></tbody>
        </table>
      </div>

      <div class="col-lg-2 col-md-12 m-auto">
        <table class="table table-bordered">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Wednesday</th></tr>
          </thead>
          <tbody id="Wednesday"></tbody>
        </table>
      </div>

      <div class="col-lg-2 col-md-12 m-auto">
        <table class="table table-bordered">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Thursday</th></tr>
          </thead>
          <tbody id="Thursday"></tbody>
        </table>
      </div>

      <div class="col-lg-2 col-md-12 m-auto">
        <table class="table table-bordered">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Friday</th></tr>
          </thead>
          <tbody id="Friday"></tbody>
        </table>
      </div>
    </div>
  </div>


    <?php generateUserSchedule();
  } elseif($user_type == "scheduler"){?>
    <div class="container">
    <?php
    include 'scheduler_index.php';
    ?>
    </div>
    </body>

    </html>

    <?php
  } elseif($user_type == "admin"){?>
    <br><br>
    <h1>Admin Test</h1>
    <?php
  } else {
    header("Location: login.php");
  }?>
</body>
</html>
