<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Music Store</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/register.css"> <!-- Custom css file -->

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
            echo '<div class="container-fluid" id="failedLogin" style="padding-top: 1vw">';
            echo '<div class="alert alert-danger">
                    <strong>Login failed!</strong> User not found or incorrect password.
                </div>';
            echo '</div>';
            unset($_SESSION['failedLogin']);
        }
    ?>

    <!-- If user has successful order -->
    <?php 
        if(isset($_SESSION['successfulOrder'])) {
            echo '<div class="container-fluid" id="successfulOrder" style="padding-top: 1vw">';
            echo '<div class="alert alert-success">
                    <strong>Order successfully placed</strong>';
            echo' </div>';
            echo '</div>';
            unset($_SESSION['successfulOrder']);
        }
    ?>

    <!-- Navbar -->
    <?php include("navbar.php"); ?>

    <!-- Cart -->
    <a href="cart.php">
        <button type="button" class="btn btn-primary" id="cart">
            Cart <span class="badge badge-light"><?php
                if (isset($_SESSION['itemsInCart'])) {
                    echo sizeof($_SESSION['itemsInCart']);
                }  else {
                    echo '0';
                }
            ?></span>
        </button>
    </a>
    
    <div class="cotainer-fluid">
        <div class="cotainer-fluid">
        <!--Change into PHP-->
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <h1>Register Form</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <form action="login_form_handler.php" method="post" id="register"> <!-- Begin registeration form -->
                    <br>
                    <h4>First Name:*</h4>
                    <div class="form-group">
                         <div class="input-group input-group-lg">
                                <input type="text" class="form-control" placeholder="Enter First Name" name="Fname">
                        </div>
                    </div>
                    <h4>Last Name:*</h4>
                    <div class="form-group">
                         <div class="input-group input-group-lg">
                                <input type="text" class="form-control" placeholder="Enter Last Name" name="Lname">
                        </div>
                    </div>
                    <h4>Email:*</h4>
                    <div class="form-group">
                         <div class="input-group input-group-lg">
                                <input type="Email" class="form-control" placeholder="Enter Email" name="email">
                        </div>
                    </div>
                    <h4>Address:*</h4>
                    <div class="form-group">
                         <div class="input-group input-group-lg">
                                <input type="Address" class="form-control" placeholder="Enter Address" name="address">
                        </div>
                    </div>
                    <h4>City:*</h4>
                    <div class="form-group">
                         <div class="input-group input-group-lg">
                                <input type="text" class="form-control" placeholder="Enter City" name="city">
                        </div>
                    </div>
                    <h4>State*:</h4>
                    <div class="form-group">
                         <div class="input-group input-group-lg">
                                <input type="text" class="form-control" placeholder="Enter State" name="state">
                        </div>
                    </div>
                    <h4>Country:*</h4>
                    <div class="form-group">
                         <div class="input-group input-group-lg">
                                <input type="text" class="form-control" placeholder="Enter Country" name="country">
                        </div>
                    </div>
                    <h4>Postal Code:*</h4>
                    <div class="form-group">
                         <div class="input-group input-group-lg">
                                <input type="text" class="form-control" placeholder="Enter Postal Code" name="postalcode">
                        </div>
                    </div>
                    <h4>Phone:*</h4>
                    <div class="form-group">
                         <div class="input-group input-group-lg">
                                <input type="text" class="form-control" placeholder="Enter Phone" name="phone">
                        </div>
                    </div>
                    <h4>Password:*</h4>
                    <div class="form-group">
                         <div class="input-group input-group-lg">
                                <input type="password" class="form-control" placeholder="Enter Password" name="password">
                        </div>
                    </div>
                    <button type="submit" name="register" class="btn btn-info" id="registerButton">Register</button>
                </form>
            </div>
        </div>
        <!-- Both login modals -->
        <?php include('login_modals.php'); ?>
    </div>
</body>
</html>
