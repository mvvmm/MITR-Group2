<?php require_once 'controllers/session_check.php'?>
<?php require_once 'controllers/functions.php'?>
<!DOCTYPE html>
<html class="bg-light" lang="en">
<head>
  <?php include 'style.php'?>
  <?php include 'script.php'?>
  <meta charset="utf-8">
  <title>Labor Cost</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
              <h1 class="card-title text-center">View Labor Cost</h1>
              <form id="laborcalc" method="post">
                <div class="form-group" id="form1">
                  <label for="employee">Select Employee</label>
                  <select name="employee" id="employee" class="form-control" required>
                    <option selected disabled>Employee</option>
                    <!-- <option value= "0">No Employee</option> -->
                    <?php generateUsersByPrivilege("employee"); ?>
                  </select>
                </div>
                <!-- <div class="form-group" id="form2">
                  <label for="project">Select Project</label>
                  <select name="project" id="project" class="form-control" onchange="projectVal()"required>
                    <option selected disabled>Project</option>
                    <option value= "0">No Project</option>
                    <?php generateActiveProjects(); ?>
                  </select>
                </div> -->
 

                
                <div class="form-group">
                  <label for="workDate">Work Date</label>
                  <div class="input-group date" id="workpicker" data-target-input="nearest">
                    <input type="text" name="workDate" class="form-control datetimepicker-input" data-target="#workpicker" placeholder="Date" required/>
                    <div class="input-group-append" data-target="#workpicker" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
              
                <div class="text-center">
                  <button class="btn btn-dark btn-clock text-uppercase" type="submit" name="Submit">Submit</button>
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
              <h1 class="card-title text-center">Labor Cost Information</h1>
              

                <div class="form-group">
                  <label for="fullname">Name:</label>
                  <input class="form-control" type="text" id="fullname" class="form-control" name="fullname" placeholder="Employee" required disabled/>
                </div>
                <div class="form-group" id="form2">
                  <label for="day">Date:</label>
                  <input class="form-control" type="text" id="day" class="form-control" name="day" placeholder="Date" required disabled/>
                </div>

                <div class="form-group" id="form2">
                  <label for="totalhours">Total hours:</label>
                  <input class="form-control" type="text" id="totalhours" class="form-control" name="totalhours" placeholder="Hours" required disabled/>
                </div>
                <div class="form-group" id="form2">
                  <label for="totalhours">At the location?</label>
                  <input class="form-control" type="text" id="atlocation" class="form-control" name="atlocation" placeholder="Hours" required disabled/>
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  <script type="text/javascript" src="js/labor_cost.js"></script>
</body>
</html>
