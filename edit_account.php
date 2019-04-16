<?php require_once 'controllers/session_check.php'?>
<?php require_once 'controllers/functions.php'?>
<!doctype html>
<html class="bg-light" lang="en">
  <head>
    <?php include 'style.php'?>
    <meta charset="utf-8">
    <title>Edit Account</title>
  </head>

  <body class="bg-light">
    <div class="p-5">
      <?php include 'navbar.php';?>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card shadow-lg mt-5">
            <div class="card-body">
              <h1 class="card-title text-center">Account Lookup</h1>
              <form id="lookup">
                <div class="form-group">
                  <input type="text" id="lookup-email" class="form-control" name="email" placeholder="E-mail" required/>
                </div>
                <div class="text-center">
                  <button class="btn btn-primary btn-clock text-uppercase" type="submit" name="Submit">Lookup</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card shadow-lg my-3">
            <div class="card-body">
              <h1 class="card-title text-center">Update Information</h1>
              <form action="controllers/edit_account_controller.php" method="post">

                <div class="form-group">
                  <input class="form-control" type="text" id="first" class="form-control" name="first" placeholder="First Name" required/>
                </div>

                <div class="form-group">
                  <input class="form-control" type="text" id="last" class="form-control" name="last" placeholder="Last Name" required/>
                </div>

                <div class="form-group">
                  <input class="form-control" type="number" id="phone" min="0000000000" max="9999999999" name="phone" placeholder="Phone Number" required/>
                </div>

                <div class="form-group">
                  <input class="form-control" type="text" id="email" name="email" placeholder="E-mail" required/>
                </div>

                 <div class="form-group">
                  <input type="password" id="password" class="form-control" name="password" placeholder="Password" />
                </div>

                <?php
                $user_type = getPrivilege();
                if($user_type == "admin"){
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

               <div class="form-group text-center">
                  <button class="btn btn-primary btn-clock text-uppercase" type="submit" name="submit">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/edit_account.js"></script>
  </body>
</html>
