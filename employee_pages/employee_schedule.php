
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Worker Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">

    <?php include("./navbar.php"); ?> <!-- include navbar file -->

        <div class="sub-container" style="padding-left:15px; padding-right:15px;">
            <div class="row" style="padding-bottom: 15px;">
                <div class="col-sm-12">
                    <h3>Your Work Schedule</h3>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Day</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">End Time</th>
                                <th scope="col">Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">3/11/2019</th>
                                <td>Monday</td>
                                <td>9:00 AM</td>
                                <td>5:00 PM</td>
                                <td>256 4th Street</td>
                            </tr>
                            <tr>
                                <th scope="row">3/12/2019</th>
                                <td>Tuesday</td>
                                <td>9:00 AM</td>
                                <td>5:00 PM</td>
                                <td>256 4th Street</td>
                            </tr>
                            <tr>
                                <th scope="row">3/13/2019</th>
                                <td>Wednesday</td>
                                <td>9:00 AM</td>
                                <td>5:00 PM</td>
                                <td>256 4th Street</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>