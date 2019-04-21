<?php require_once 'controllers/session_check.php'?>
<?php require_once 'controllers/functions.php'?>
<!doctype html>
<html class="bg-light" lang="en">
  <head>
    <?php include 'style.php';?>
    <?php include 'script.php';?>
    <meta charset="utf-8">
    <title>Edit Project</title>
  </head>

  <body class="bg-light">
    <div class="p-5">
      <?php include 'navbar.php';?>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-7 mx-auto">
          <div class="card shadow-lg mt-5">
            <div class="card-body">
              <h1 class="card-title text-center">Project Lookup</h1>
              <form id="lookup">
                <div class="form-group">
                  <select id="lookup-address" name="project" class="form-control" required>
                    <option selected disabled>Project Address</option>
                    <?php generateActiveProjects() ?>
                  </select>
                </div>
                <div class="text-center">
                  <button class="btn btn-dark btn-clock text-uppercase" type="submit" name="Submit">Lookup</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-7 mx-auto">
          <div class="card shadow-lg my-3">
            <div class="card-body">
              <h1 class="card-title text-center">Update Information</h1>
              <form action="controllers/edit_project_controller.php" method="post">

                <div class="form-group">
                  <input class="form-control" type="hidden" id="pid" class="form-control" name="pid" required/>
                </div>

                <div class="form-group">
                  <input class="form-control" type="text" id="address" class="form-control" name="address" placeholder="Address" required/>
                </div>


                <div class="form-group">
                  <select id="borough" name="borough" class="form-control" required>
                    <option selected disabled>Borough</option>
                    <?php generateBoroughs(); ?>
                  </select>
                </div>

                <div class="form-group">
                  <div class="input-group date" id="startDatePicker" data-target-input="nearest">
                    <input id="startdate" type="text" name="startDate" class="form-control datetimepicker-input" data-target="#startDatePicker" placeholder="Start Date" required/>
                    <div class="input-group-append" data-target="#startDatePicker" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group date" id="endDatePicker" data-target-input="nearest">
                    <input id="enddate" type="text" name="endDate" class="form-control datetimepicker-input" data-target="#endDatePicker" placeholder="End Date" required/>
                    <div class="input-group-append" data-target="#endDatePicker" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>

               <div class="form-group text-center">
                  <button class="btn btn-dark btn-clock text-uppercase" type="submit" name="submit">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="js/edit_project.js"></script>
  </body>
</html>
