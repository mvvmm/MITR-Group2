<?php
require_once "controllers/session_check.php";
require_once "controllers/admin_check.php";
?>
<!doctype html>
<html class='bg-light'>
<head>
  <?php include 'style.php'?>
  <meta charset="utf-8">
  <title>Account Approval</title>
</head>
<body class='bg-light'>
  <div class="p-5">
    <?php include 'navbar.php';?>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <table class="table table-striped table-bordered">
          <form method="post" action="controllers/account_approval_controller.php">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Phone Number</th>
                <th scope="col">E-mail</th>
                <th scope="col">Approval</th>
              </tr>
            </thead>
            <tbody>
              <?php include_once 'controllers/account_approval_fill.php';?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
