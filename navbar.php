<?PHP
// check if employee
if($_SESSION['privilege'] == 'employee')
{
    echo '
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- toggle style depending on screen size: better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                    aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">JAN Renovation</a>
            </div>

            <!-- navbar content -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="employee_pages/employee_schedule.php">Schedule</a></li>
                    <li><a href="#">Upload Photo</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    ';
}

// check if scheduler
if ($_SESSION['privilege'] == 'scheduler')
{
    echo '
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- toggle style depending on screen size: better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                    aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">JAN Renovation</a>
            </div>

            <!-- navbar content -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tools
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Overview</a></li>
                            <li><a href="#">Assign</a></li>
                            <li><a href="#">View Pictures</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Upload Photo</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    ';   
}

// check if admin
if ($_SESSION['privilege'] == 'admin')
{
    echo '
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- toggle style depending on screen size: better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                    aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">JAN Renovation</a>
            </div>

            <!-- navbar content -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tools
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Overview</a></li>
                            <li><a href="#">Assign</a></li>
                            <li><a href="#">View Pictures</a></li>
                            <li><a href="#">Manage Schedulers</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Upload Photo</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    ';     
}

?>
