<?php require_once 'controllers/session_check.php'?>
<?php require_once 'controllers/functions.php'?>
<!doctype html>
<html class="bg-light" lang="en">
  <head>
    <?php include 'style.php'?>
    <?php include 'script.php'?>
    <meta charset="utf-8">
    <title>Edit Account</title>
  </head>

  <body class="bg-light">
    <div class="p-5">
      <?php include 'navbar.php';?>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-7 mx-auto">
          <div class="card shadow-lg mt-5">
            <div class="card-body">
              <h1 class="card-title text-center">Assign Job</h1>
              <form id="assign" action="controllers/assign_job_controller.php" method="post">
                  <div class="form-group">
                      <label for="employee">Select Employee</label>
                      <select name="employee" id="employee" class="form-control" required>
                        <option selected disabled>Employee</option>
                        <?php generateUsersByPrivilege("employee"); ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="project">Select Project</label>
                      <select name="project" id="project" class="form-control" required>
                        <option selected disabled>Project</option>
                        <?php generateActiveProjects(); ?>
                      </select>
                  </div>

                    <div class="form-group">
                      <label>Date</label>
                      <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                        <input type="text" name="dateTime" class="form-control datetimepicker-input" data-target="#datetimepicker" placeholder="Date and Time" required/>
                        <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>

                  <div class="text-center">
                      <button class="btn btn-dark btn-clock text-uppercase" type="submit" name="Submit">Assign</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="js/assign_job.js"></script>
  </body>
</html>
