<?php require_once 'controllers/session_check.php'?>
<?php require_once 'controllers/functions.php'?>
<?php
  // Connect to db
  $database = parse_ini_file("controllers/db_config.ini");
  $host = $database['host'];
  $db_username = $database['username'];
  $password = $database['password'];
  $databasename = $database['dbname'];
  $conn = mysqli_connect($host, $db_username, $password, $databasename);
?>
<!doctype html>
<html class="bg-light" lang="en">
  <head>
    <?php include 'style.php'?>
    <meta charset="utf-8">
    <title>Edit Account</title>
  </head>

  <body class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card shadow-lg mt-5">
            <div class="card-body">
              <h1 class="card-title text-center">Assign Job</h1>
              <form id="assign" action="controllers/assign_job_controller.php" method="post">
                  <div class="form-group">
                      <label for="employee">Select Employee</label>
                      <select name="employee" id="employee" class="form-control">
                          <?php
                            // Add the employees to select screen
                            $sql = "SELECT * FROM users WHERE privilege='employee'";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)) {
                                echo("<option value='" . $row["uid"] . "'>" . $row["lastname"] . ", " . $row["firstname"] . "</option>");
                            }
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="project">Select Employee</label>
                      <select name="project" id="project" class="form-control">
                          <?php
                          // Add the employees to select screen
                          $sql = "SELECT * FROM projects";
                          $result = mysqli_query($conn, $sql);
                          while($row = mysqli_fetch_assoc($result)) {
                              echo("<option value='" . $row["pid"] . "'>" . $row["address"] . "</option>");
                          }
                          ?>
                      </select>
                  </div>
                  <div class="text-center">
                      <button class="btn btn-primary btn-clock text-uppercase" type="submit" name="Submit">Assign</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script src="js/jquery.js"></script>
    <script src="js/edit_account.js"></script>
  </body>
</html>
