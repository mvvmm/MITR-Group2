<!doctype html>
<html class="bg-light" lang="en">
<head>
  <?php include 'style.php';?>
  <meta charset="utf-8">
  <title>Create Account</title>
  <style>
    .top-buffer { margin-top: 100px;}
  </style>
</head>
<body class="bg-light">
<?php include 'navbar.php';?>
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto top-buffer">
      <div class="card shadow-lg my-5">
        <div class="card-body">
          <h1 class="card-title text-center">Create Account</h1>
          <form action="controllers/create_account_controller.php" method="post">

            <div class="form-group">
              <label>First Name</label>
              <input type="text" class="form-control" name="first" placeholder="First Name" required />
            </div>

            <div class="form-group">
              <label>Last Name</label>
              <input type="text" class="form-control" name="last" placeholder="Last Name" required/>
            </div>

            <div class="form-group">
              <label>Phone Number</label>
              <input type="number" class="form-control" min="0000000000" max="9999999999" name="phone" placeholder="Phone Number" required/>
            </div>

            <div class="form-group">
              <label>E-mail</label>
              <input type="email" class="form-control" name="email" placeholder="E-mail" required/>
              <small>You will use this e-mail to log in.</small>
            </div>

            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password" required/>
            </div>

            <div class="form-group">
              <label>Confirm Password</label>
              <input type="password" class="form-control" name="password2" placeholder="Confirm Password" required/>
            </div>

            <div class="text-center">
              <button class="btn btn-primary btn-clock text-uppercase" type="submit" name="submit">Create</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
