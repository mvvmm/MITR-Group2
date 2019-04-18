<?php require_once 'controllers/session_check.php'?>
<?php require_once 'controllers/functions.php'?>
<!doctype html>
<html class="bg-light" lang="en">
  <head>
    <?php include 'style.php'?>
    <?php include 'script.php'?>
    <meta charset="utf-8">
    <title>Create Project</title>
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
              <h1 class="card-title text-center">Create Project</h1>
              <form id="assign" action="controllers/create_project_controller.php" method="post">
                  <div class="form-group">
                      <label for="address">Street Address</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="Address" required />
                  </div>
                  <div class="form-group">
                      <label for="borough">Borough</label>
                      <select name="borough" id="borough" class="form-control" required>
                          <option selected disabled>Borough</option>
                          <option value="Bronx">Bronx</option>
                          <option value="Brooklyn">Brooklyn</option>
                          <option value="Manhattan">Manhattan</option>
                          <option value="Queens">Queens</option>
                          <option value="Staten Island">Staten Island</option>
                      </select>
                  </div>

                  <div class="form-row">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="startDate">Project Start</label>
                        <div class="input-group date" id="startpicker" data-target-input="nearest">
                          <input type="text" name="startDate" class="form-control datetimepicker-input" data-target="#startpicker" placeholder="Date" required/>
                          <div class="input-group-append" data-target="#startpicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="endDate">Project End</label>
                        <div class="input-group date" id="endpicker" data-target-input="nearest">
                          <input type="text" name="endDate" class="form-control datetimepicker-input" data-target="#endpicker" placeholder="Date" required/>
                          <div class="input-group-append" data-target="#endpicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>


                  <div class="text-center">
                      <button class="btn btn-dark btn-clock text-uppercase" type="submit" name="Submit">Create</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<script type="text/javascript" src="js/create_project.js"></script>
</div>
  </body>
</html>
