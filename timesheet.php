<?php require_once 'controllers/session_check.php';?>
<?php require_once 'controllers/functions.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'style.php';?>
  <?php include 'script.php';?>
  <title>Worker Portal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="bg-light">
  <div class="p-5">
    <?php include 'navbar.php';?>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="pb-2 text-center">Your Weekly Timesheet</h1>
      </div>
    </div>
  </div>

  <div class="container-fluid pt-5" id="timesheet"><?php include 'borough_colors.php';?></div>

  <script src="js/timesheet.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      populateTable(<?php echo getUID();?>);
    });
  </script>

</body>
</html>
