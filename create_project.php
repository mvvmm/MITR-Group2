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
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.min.css">
    <meta charset="utf-8">
    <title>Create Project</title>
  </head>
  <body class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card shadow-lg mt-5">
            <div class="card-body">
              <h1 class="card-title text-center">Create Project</h1>
              <form id="assign" action="controllers/create_project_controller.php" method="post">
                  <div class="form-group">
                      <label for="address">Project Address</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="Address" required />
                  </div>
                  <div class="form-group">
                      <label for="borough">Select Project</label>
                      <select name="borough" id="borough" class="form-control">
                          <option value="Bronx">Bronx</option>
                          <option value="Brooklyn">Brooklyn</option>
                          <option value="Manhattan">Manhattan</option>
                          <option value="Queens">Queens</option>
                          <option value="Staten Island">Staten Island</option>
                      </select>
                  </div>
                  <div id="datepairExample">
                      <h4>Project Start</h4>
                      <label for="startDateInput">Select Date</label>
                      <input name="startDateInput" id="startDateInput" type="text" class="date start" />
                      <br>
                      <label for="startTimeInput">Select Time</label>
                      <input name="startTimeInput" id="startTimeInput" type="text" class="time start" />
                      <h4>Project End</h4>
                      <label for="endDateInput">Select Date</label>
                      <input name="endDateInput" id="endDateInput" type="text" class="date start" />
                      <br>
                      <label for="endTimeInput">Select Time</label>
                      <input name="endTimeInput" id="endTimeInput" type="text" class="time start" />
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


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/jquery.timepicker.min.js"></script>
<script>
    // initialize input widgets first
    $('#datepairExample .time').timepicker({
        'showDuration': true,
        'timeFormat': 'g:ia'
    });
    $('#datepairExample .date').datepicker({
        'format': 'yyyy-m-d',
        'autoclose': true
    });
    // initialize datepair
    $('#datepairExample').datepair();
</script>
</div>


    <script src="js/jquery.js"></script>
    <script src="js/edit_account.js"></script>
  </body>
</html>
