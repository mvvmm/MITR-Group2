<!DOCTYPE html>
<html lang="en">

<head>
    <title>Worker Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "script.php";?>
    <?php include "style.php";?>
    <?php require "controllers/functions.php";?>
</head>

<body>
  <div class="p-5">
    <?php include 'navbar.php';?>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-9 mx-auto">
        <div class="card shadow-lg my-3">
          <div class="card-body">
            <h1 class="card-title text-center">Clock In/Out</h1><hr />
            <form action="controllers/clock_IO_controller.php" method="post">

              <div class="form-row">
                <div class="form-group col-md-4 mx-auto">
                  <select class="form-control text-center" name="IO">
                    <option value='in'>Clock In</option>
                    <option value='out'>Clock Out</option>
                  </select>
                </div>
              </div>


              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                      <input type="text" name="dateTime" class="form-control datetimepicker-input" data-target="#datetimepicker1" placeholder="Date and Time" required/>
                      <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                </div>

              <div class="col-md-6">
                <div class="form-group">
                  <select class="form-control" name="projectAddress" required>
                    <option selected disabled>Project Address</option>
                    <?php generateUsersActiveProjects();?>
                  </select>
                </div>
              </div>
            </div>

            <div class="text-center">
              <button class="btn btn-dark btn-clock text-uppercase" type="submit" name="submit">Submit</button>
            </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript" src="js/clock_IO.js"></script>
</body>

</html>
