<?php require_once 'controllers/session_check.php';?>
<!doctype html>
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
                  <select class="form-control projectAddress" name="projectAddress" required>
                    <option selected disabled>Project Address</option>
                    <?php generateUsersActiveProjects();?>
                  </select>
                </div>
              </div>
            </div>

            <input id="inrange" type=hidden name="inrange" value=0></input>

            <div class="text-center">
              <button class="btn btn-dark btn-clock text-uppercase" type="submit" name="submit" id="submit">Submit</button>
            </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>

// Change the value of whether you are at the site or not when the selector changes
$('select.projectAddress').on('change', function() {


    jQuery.get('apikey.ini', function(key) {

        // Gets address and converts to coordinates via ajax call
        var selected = $("select.projectAddress").children("option:selected").val();
        var addressArray = selected.split(" ");
        var urlStr = "https://maps.googleapis.com/maps/api/geocode/json?address=" + addressArray[0];
        for (var i = 1; i < addressArray.length; i++) {
            urlStr = urlStr + "+";
            urlStr = urlStr + addressArray[i];
        }
        urlStr = urlStr + "&key=" + key;

        $.ajax({
            type: "GET",
            url: urlStr,
            success: function(responseData, status){

                // Gets the user location
                $.ajax({
                    type: "POST",
                    url: 'https://www.googleapis.com/geolocation/v1/geolocate?key=' + key,
                    success: function(data, status) {
                        var projectLat = responseData.results[0].geometry.location.lat;
                        var projectLng = responseData.results[0].geometry.location.lng;
                        var userLat = data.location.lat;
                        var userLng = data.location.lng;

                        // Detect if user is close enough to project
                        if (userLat <= projectLat + 0.002 && userLat >= projectLat - 0.002 && userLng <= projectLng + 0.002 && userLng >= projectLng - 0.002) {
                            console.log("In range!");
                            $('#inrange').val(1);
                        } else {
                            console.log("Not in range");
                            $('#inrange').val(0);
                        }
                    }, error: function(msg) {
                        alert("There was a problem.");
                    }
                });

            }, error: function(msg) {
                alert("There was a problem.");
            }
        });
    });
});
</script>

<script type="text/javascript" src="js/clock_IO.js"></script>
</body>

</html>
