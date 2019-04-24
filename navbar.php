<?PHP
require_once 'controllers/db_connector.php';
require_once 'controllers/functions.php';
require_once 'script.php';
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
                  <li>
                    <a class="nav-link" href="timesheet.php">View Clocked Hours</a>
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Projects
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="create_project.php">Create a Project</a>
                        <a class="dropdown-item" href="edit_project.php">Edit a Project</a>
                        <a class="dropdown-item" href="end_project.php">End Project</a>
                        <a class="dropdown-item" href="reactivate_project.php">Reactivate Project</a>
                        <a class="dropdown-item" href="assign_job.php">Schedule an Employee</a>
                        <a class="dropdown-item" href="laborcost.php">View Labor Cost</a>
                    </div>
                </li>
                <li>
                  <a class="nav-link" href="edit_account.php">Lookup/Edit Account</a>
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
                          Projects
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                          <a class="dropdown-item" href="laborcost.php">View Labor Cost</a>
                          <a class="dropdown-item" href="create_project.php">Create a Project</a>
                          <a class="dropdown-item" href="edit_project.php">Edit a Project</a>
                          <a class="dropdown-item" href="end_project.php">End Project</a>
                          <a class="dropdown-item" href="reactivate_project.php">Reactivate Project</a>
                          <a class="dropdown-item" href="assign_job.php">Schedule an Employee</a>
                      </div>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Accounts
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item notification-bubble" href="account_approval.php">Approve Accounts<span class="badge">' . getQueuedAccountsCount() . '</span></a>
                          <a class="dropdown-item" href="edit_account.php">Lookup/Edit Account</a>
                      </div>
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
