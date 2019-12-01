<!DOCTYPE HTML?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Music Store</title>
	<link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/index.css"> <!-- Custom css file -->

    <!-- JQuery -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="images/playbuttonfavicon.png" type="image/x-icon" /> <!-- favicon -->

</head>
<body>

<!-- Bring in session -->
<?php  require_once('DBConn.php');
    session_start();
?>

        <!-- If user has unsuccessful login -->
        <?php 
            if(isset($_SESSION['failedLogin'])) {
                echo '<div class="container-fluid failedlogin" style="padding-top: 1vw">';
                echo '<div class="alert alert-danger">
                        <strong>Login failed!</strong> User not found or incorrect password.
                    </div>';
                echo '</div>';
                unset($_SESSION['failedLogin']);
            }

        ?>

    <!-- Nav bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php">Music Store</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="catalog.php">Catalog</a>
          </li>

          <!-- If logged in, show "My Account" instead of login. My account has dropdown to take them to either customer dashboard or employee dashboard -->

          <?php
            if (isset($_SESSION['employeeID'])) {
                echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        echo 'My Account';
                    echo '</a>';
                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                        echo '<p class="loggedinName">'.$_SESSION['employeeName'].'</p>';
                        echo '<a class="dropdown-item" href="employee_page.php">My Account</a>';
                    echo '</div>';
                echo '</li>';
                echo '<form action=" login_form_handler.php" method="post" id="profileLogout">';
                    echo '<button type="submit" name="logout" class="btn btn-outline-danger" id="logout">Logout</button>';
                echo '</form>';

            } elseif (isset($_SESSION['customerID'])) {
                echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        echo 'My Account';
                    echo '</a>';
                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                        echo '<a class="dropdown-item" href="#">My Account</a>';
                    echo '</div>';
                echo '</li>';
                echo '<form action=" login_form_handler.php" method="post" id="profileLogout">';
                    echo '<button type="submit" name="logout" class="btn btn-outline-danger" id="logout">Logout</button>';
                echo '</form>';
            } else { // Not logged in, show login dropdown
                echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        echo 'Log in';
                    echo '</a>';
                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                        echo '<a class="dropdown-item" href="#" data-toggle="modal" data-target="#customerLogin">Customer</a>';
                        echo '<a class="dropdown-item" href="#" data-toggle="modal" data-target="#employeeLogin">Employee</a>';
                    echo '</div>';
                echo '</li>';

            }

          ?>       
        </ul>
      </div>
    </nav> <!-- End Nav -->
    
	<div class="cotainer-fluid">
		<br>
		<div class="row text-center">
			<div class="col-md-12">
				<h1 class="display-4 text-secondary">Search for the music you want</h1>
                <h5>A catalog full of music. Find information about music! Just a few clicks away</h5>
                <a href="catalog.php"><button type="button" class="btn btn-secondary">Find Music</button></a>
			</div>
        </div>

        <!-- Both login modals -->

        <!-- Customer login -->
	    <div class="modal fade" id="customerLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Customer Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <p>Username</p>
                            <div class="form-group row"><input type="Username" name="uname" class="form-control" placeholder="Enter Username"></div>
                            <p>Password</p>
                            <div class="form-group row"><input type="Password" name="pwrd" class="form-control" placeholder="Enter Password"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Log in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employee login -->
        <div class="modal fade" id="employeeLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Employee Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action=" login_form_handler.php" method="post" id="employeeLogin">
                            <p>Employee ID</p>
                            <div class="form-group row"><input type="text" name="employeeID" id="employeeIDinput" class="form-control" placeholder="Enter Employee ID"></div>
                            <p>Employee First Name</p>
                            <div class="form-group row"><input type="text" name="employeeName" id="employeeNameInput" class="form-control" placeholder="Enter First Name"></div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="employeeLoginSubmit" class="btn btn-primary">Log in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>