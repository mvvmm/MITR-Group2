<?php require_once 'controllers/functions.php'?>
<!doctype html>
<html>
<head>
  <?php include 'style.php'?>
  <?php include 'script.php'?>
  <meta charset="utf-8">
  <title>JANRenovation</title>
</head>
<body>
  <?php include 'navbar.php';
  $user_type = getPrivilege();
  if($user_type == "employee"){?>

  <div class="sub-container" style="padding-left:15px; padding-right:15px;">
    <div class="row" style="padding-bottom: 15px;">
      <div class="col-sm-12">
        <h1 class="pt-5">Your Work Schedule</h1>
      </div>
    </div>

    <div class="row">

      <div class="col-md-3">
        <table class="table table-bordered" id="Monday">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Monday</th></tr>
          </thead>
          <tbody id="Monday"></tbody>
        </table>
      </div>

      <div class="col-md-3">
        <table class="table table-bordered" id="Tuesday">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Tuesday</th></tr>
          </thead>
          <tbody id="Tuesday"></tbody>
        </table>
      </div>

      <div class="col-md-3">
        <table class="table table-bordered" id="Wednesday">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Wednesday</th></tr>
          </thead>
          <tbody id="Wednesday"></tbody>
        </table>
      </div>

      <div class="col-md-3">
        <table class="table table-bordered" id="Thursday">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Thursday</th></tr>
          </thead>
          <tbody id="Thursday"></tbody>
        </table>
      </div>

      <div class="col-md-3">
        <table class="table table-bordered" id="Friday">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Friday</th></tr>
          </thead>
          <tbody id="Friday"></tbody>
        </table>
      </div>
    </div>


    <?php generateUserSchedule();
  }?>
</body>
</html>
