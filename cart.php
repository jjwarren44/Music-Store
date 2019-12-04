<?php
require_once('DBConn.php');
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	 <title>Catalog</title>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="css/catalog.css"> <!-- Custom css file -->
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

    <!-- Begin looping through all records in database to display albums and artist -->
    <?php

        // If user has items in cart, show them
        if (isset($_SESSION['itemsInCart']) && sizeof($_SESSION['itemsInCart']) > 0) {
            // Show table and all cart items
            echo '<div class="container-fluid">';
                echo '<div class="row" align="center">';
                    echo '<div class=col-4>';
                    echo '</div>';
                    echo '<div class="col-4" align="center">';
                        echo '<div class="form-group" align="center">'; // Search bar
                            echo '<input type="text" class="form-control" onkeyup="search()" placeholder="Search Album or Artist" id="searchBar" align="center">';
                        echo '</div>';
                        echo '<p>Click album to see songs in the album</p>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="row" align="center">';
                    echo '<div class="col-1">';
                    echo '</div>';
                    echo '<div class="col-10">';
                        echo '<table class="table table-borderless" id="albums" align="Center">';
                            echo "<div class = 'tableContent'>";
                                echo '<thead>';
                                    echo "<col width='30%'>"; // Column widths
                                    echo "<col width='30%'>";
                                    echo "<col width='20%'>";
                                    echo "<col width-'12%'>";
                                        echo "<tr class='table-active'>"; // Table headers
                                        echo "<th>Album</th>";
                                        echo "<th>Artist</th>";
                                        echo "<th>Price</th>";
                                        echo "<th></th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";

            $sql_cartItems = implode(",", $_SESSION['itemsInCart']); // Create string of album IDs in cart -- example (56,42,10)

            mysqli_begin_transaction($conn); // Start mySQLi transaction
            $albumResult = mysqli_query($conn, "SELECT AlbumId, Name, Title FROM Artist, Album WHERE Artist.ArtistId = Album.ArtistId AND Album.AlbumId IN (${sql_cartItems})");

            while ($row = $albumResult->fetch_assoc()) {
                echo "<tr class='table-active clickable-row' album-link='track_list.php?AlbumId=".$row['AlbumId']."&AlbumName=".$row['Title']."&Artist=".$row['Name']."'>";
                echo "<td>".$row['Title']."</td>";
                echo "<td>".$row['Name']."</td>";

                // Find album price
                $albumPrice = mysqli_query($conn, "SELECT SUM(UnitPrice) FROM Track WHERE AlbumId=".$row['AlbumId']);
                $price = mysqli_fetch_row($albumPrice);
                echo "<td>$".$price[0]."</td>";

                mysqli_free_result($albumPrice); // free result

                // Remove from cart button
                echo "<td><form action='cart_handler.php' method='post' id='addToCart'>";
                    echo "<button type='submit' name='removeFromCart' value='".$row['AlbumId']."' class='btn btn-outline-danger'>Remove from cart</button>";
                echo "</form></td>";
                echo "</tr>";
            }

            // Free result set
            mysqli_free_result($albumResult);

            // Show cart total on screen
            $sql_cartItems = implode(",", $_SESSION['itemsInCart']); // Create string of album IDs in cart -- example (56,42,10)

            mysqli_begin_transaction($conn); // Start mySQLi transaction
            $result = mysqli_query($conn, "SELECT SUM(UnitPrice) FROM Track WHERE AlbumId IN (${sql_cartItems})");

            $cartTotal = mysqli_fetch_row($result)[0];

            echo "<h3 align='center'>Total: $${cartTotal}</h3>";

            echo "</tbody>";
            echo "</div>";
            echo "</table>"; // End table

            // Free result set
            mysqli_free_result($result);

            mysqli_close($conn); // close

            // Check out button
            // User must be logged in
            if (isset($_SESSION['customerFirstName'])) {
                echo "<button type='button' name='checkout' class='btn btn-success' data-toggle='modal' data-target='#checkoutForm'>Check out</button>";
            } else {
                echo "<h4>You must log in before you can checkout</h4>";
            }

        } else { // else, there are no items in the cart
            echo "<h3 align='center'>There are no items in your cart</h3>";
        }

    ?>

            </div>
        </div>

        <!-- Check out modal -->
        <div class="modal fade" id="checkoutForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Check out</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <p>Street Address</p>
                                <div class="form-group row"><input type="Username" name="uname" class="form-control" placeholder="Enter Username"></div>
                            <p>City</p>
                                <div class="form-group row"><input type="Password" name="pwrd" class="form-control" placeholder="Enter Password"></div>
                            <p>Postal Code</p>
                                <div class="form-group row"><input type="Password" name="pwrd" class="form-control" placeholder="Enter Password"></div>
                            <p>State</p>
                                <div class="form-group row"><input type="Username" name="uname" class="form-control" placeholder="Enter Username"></div>
                            <p>Country</p>
                                <div class="form-group row"><input type="Password" name="pwrd" class="form-control" placeholder="Enter Password"></div>
                            </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Check out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Both login modals -->
        <?php include('login_modals.php'); ?>
        
    </div>
</body>

<script type="text/javascript" language="javascript" src="js/catalog.js"></script>   <!-- javascript file -->

</html>