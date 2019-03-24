  <?php require_once 'controllers/login_session_check.php';?>
<!doctype html>
<html class="bg-light" lang="en">
<head>
  <meta charset="utf-8">
  <?php include_once 'style.php';?>
  <title>Login</title>
</head>
<body class="bg-light">
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card shadow-lg my-5">
          <div class="card-body">
            <h1 class="card-title text-center">Sign In</h1>
            <form action="controllers/login_controller.php" method="post">

              <div class="form-group">
                <label>E-mail</label>
                <input type="text" class="form-control" name="email" placeholder="E-mail" required />
              </div>

              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required />
              </div>

              <div class="text-center">
                <button class="btn btn-primary btn-clock text-uppercase" type="submit">Sign in</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
