<?PHP
require_once 'controllers/db_connector.php';
require_once 'controllers/functions.php';
$privilege  = getPrivilege();
// check if employee
if($privilege == 'employee')
{
    echo '
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFixed"
            aria-controls="navbarFixed" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Jan Renovation</a>

        <div class="collapse navbar-collapse" id="navbarFixed">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Schedule <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Upload Photo</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="nav-link" href="#">Logout</a></li>
            </ul>
        </div>
    </nav>
    ';
}

// check if scheduler
if ($privilege == 'scheduler')
{
    echo '
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFixed"
            aria-controls="navbarFixed" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Jan Renovation</a>

        <div class="collapse navbar-collapse" id="navbarFixed">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tools
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Overview</a>
                        <a class="dropdown-item" href="#">Assign</a>
                        <a class="dropdown-item" href="#">View Pictures</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Upload Photo</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="nav-link" href="#">Logout</a></li>
            </ul>
        </div>
    </nav>
    ';
}

// check if admin
if ($privilege == 'admin')
{
    echo '
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFixed"
            aria-controls="navbarFixed" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Jan Renovation</a>

        <div class="collapse navbar-collapse" id="navbarFixed">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tools
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Overview</a>
                        <a class="dropdown-item" href="#">Assign</a>
                        <a class="dropdown-item" href="#">View Pictures</a>
                        <a class="dropdown-item" href="#">Manage Schedulers</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Upload Photo</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="nav-link" href="#">Logout</a></li>
            </ul>
        </div>
    </nav>
    ';
}

?>
