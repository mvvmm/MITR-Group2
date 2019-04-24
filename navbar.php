<?PHP
require_once 'controllers/db_connector.php';
require_once 'controllers/functions.php';
//If the user is logged in, get their privilege and show them the corresponding navbar.
if(isset($_COOKIE['JAN-SESSION'])){
  $privilege  = getPrivilege();
  // check if employee
  if($privilege == 'employee')
  {
      echo '
      <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFixed"
              aria-controls="navbarFixed" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="index.php">JANRenovation</a>

          <div class="collapse navbar-collapse" id="navbarFixed">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li>
                    <a class="nav-link" href="clock_IO.php">Clock In/Out</a>
                  </li>
                  <li>
                    <a class="nav-link" href="edit_account.php">Edit Account</a>
                  </li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <li><a class="nav-link" href="controllers/logout_controller.php">Logout</a></li>
              </ul>
          </div>
      </nav>
      ';
  }

  // check if scheduler
  if ($privilege == 'scheduler')
  {
      echo '
      <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFixed"
              aria-controls="navbarFixed" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="index.php">JANRenovation</a>

          <div class="collapse navbar-collapse" id="navbarFixed">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item">
                      <a class="nav-link" href="assign_job.php">Assign Jobs<span class="sr-only">(current)</span></a>
                  </li>
                  <li>
                    <a class="nav-link" href="edit_account.php">Edit Account</a>
                  </li>
                  <li>
                    <a class="nav-link" href="labor_cost.php">View Labor Cost</a>
                  </li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <li><a class="nav-link" href="controllers/logout_controller.php">Logout</a></li>
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
      <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFixed"
              aria-controls="navbarFixed" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="index.php">JANRenovation</a>

          <div class="collapse navbar-collapse" id="navbarFixed">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Tools
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item" href="create_project.php">Create Project</a>
                          <a class="dropdown-item" href="assign_job.php">Assign Jobs</a>
                          <a class="dropdown-item" href="edit_account.php">Edit Accounts</a>
                          <a class="nav-link" href="labor_cost.php">View Labor Cost</a>

                      </div>
                  </li>
                  <li>
                    <a class="nav-link notification-bubble" href="account_approval.php">Approve Accounts<span class="badge">' . getQueuedAccountsCount() . '</span></a>
                  </li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <li><a class="nav-link" href="controllers/logout_controller.php">Logout</a></li>
              </ul>
          </div>
      </nav>
      ';
  }
}
//If the user is not logged in, show them the default navbar with the ability to log in..
else{
  echo '
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFixed"
          aria-controls="navbarFixed" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="index.php">JANRenovation</a>

      <div class="collapse navbar-collapse" id="navbarFixed">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a class="nav-link" href="login.php">Login</a></li>
              <li><a class="nav-link" href="create_account.php">Sign Up</a></li>
          </ul>
      </div>
  </nav>
  ';
}


?>
