<!DOCTYPE HTML>
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
        <br>
        <div class="row text-center">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-3">DBM Music</h1>
                    <p class="lead">Buy the music that you want quick and easy! No Hastle.</p>
                    <hr class="my-4">
                    <p>Browse the catalog to find your future music!</p>
                    <p class="lead">
                    <a class="btn btn-info btn-lg" href="catalog.php" role="button">Catalog</a>
                    </p>
                </div>
                <div class="row">
                <div class="col-sm" align="center">
                    <div class="card border-info mb-3" style="max-width: 750px;">
                        <div class="card-header">Customer Log in</div>
                        <div class="card-body">
                            <h4 class="card-title">Log into your customer account now</h4>
                            <p class="card-text">Customers can log in here to gain access to their account</p>
                            <a class="btn btn-info btn-lg" href="#customerLogin" role="button" data-toggle="modal">Log In</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card border-info mb-3" style="max-width: 750px;">
                        <div class="card-header">Employee Log in</div>
                        <div class="card-body">
                            <h4 class="card-title">Log into your employee account now</h4>
                            <p class="card-text">Employees can log in here to gain access to their account.</p>
                            <a class="btn btn-info btn-lg" href="#employeeLogin" role="button" data-toggle="modal">Log In</a>
                        </div>
                    </div>
                </div>  
            </div>
            </div>
        </div>
        <!-- Both login modals -->
        <?php include('login_modals.php'); ?>

    </div>
</body>
</html>
