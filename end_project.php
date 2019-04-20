<?php
require_once "controllers/session_check.php";
require_once "controllers/admin_check.php";
?>
<!doctype html>
<html class='bg-light'>
<head>
  <?php include 'style.php'?>
  <?php include 'script.php';?>
  <meta charset="utf-8">
  <title>Account Approval</title>
</head>
<body class='bg-light'>
  <div class="p-5">
    <?php include 'navbar.php';?>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="pb-2 text-center">Currently Active Projects</h1>
      </div>
    </div>
  </div>
  <div class="container p-0">
    <div class="row">
      <div class="col-lg-12">
        <table id="endTable" class="table table-striped table-bordered">
          <form method="post" action="controllers/end_project_controller.php">
            <thead class="thead-dark">
              <tr class='text-center'>
                <th scope="col">#</th>
                <th scope="col">Address</th>
                <th scope="col">Borough</th>
                <th scope="col">Start</th>
                <th scope="col">End Project</th>
              </tr>
            </thead>
            <tbody>
              <?php include_once 'controllers/end_project_fill.php';?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="js/end_project.js"></script>
</body>
</html>
