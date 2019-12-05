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
		<!--Change into PHP-->
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <h1>User Information</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-1">
                <br>
                <h4>First Name:</h4>
                <h4>Last Name:</h4>
                <h4>Email:</h4>
                <h4>Address:</h4>
                <h4>Phone:</h4>
            </div>
             <div class="col-md-5">
                <br>

                <?php
                    mysqli_begin_transaction($conn);

                    // Get user information to be displayed
                    $user_info_query = mysqli_query($conn, "SELECT FirstName, LastName, Email, Address, City, State, PostalCode, Country, Phone FROM Customer WHERE CustomerId=".$_SESSION['customerId']);
                    $info = mysqli_fetch_assoc($user_info_query);

                    // Display user info
                    echo '<h4>'.$info['FirstName'].'</h4>';
                    echo '<h4>'.$info['LastName'].'</h4>';
                    echo '<h4>'.$info['Email'].'</h4>';
                    echo '<h4>'.$info['Address'].', '.$info['City'].', '.$info['State'].', '.$info['PostalCode'].', '.$info['Country'].'</h4>';
                    echo '<h4>'.$info['Phone'].'</h4>';
                ?>

             </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" align="center">

                <!-- If user has no purchases, display "no purchases" and catalog button. If they do, display all purchases -->
                <?php

                    mysqli_begin_transaction($conn); // Start mySQLi transaction

                    $invoices = mysqli_query($conn, "SELECT InvoiceId, InvoiceDate, Total FROM Invoice WHERE CustomerId=".$_SESSION['customerId']);
                    $numRows = mysqli_num_rows($invoices);

                    if ($numRows > 0) {

                        echo '<h1>Purchases</h1>';

                        // Table of invoices for this customer with tracks for each invoice
                        echo '<table class="table table-borderless" id="invoices" align="Center">';
                            echo '<div class = "tableContent">';
                                echo '<thead>';
                                    echo '<tr class="table-active">';
                                        echo '<th>Invoice ID</th>';
                                        echo '<th>Invoice Date</th>';
                                        echo '<th>Songs</th>';
                                        echo '<th>Total</th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody> ';

                        while ($invoiceRow = $invoices->fetch_assoc()) {
                            echo "<tr class='table-active clickable-row'>";
                            echo "<td>".$invoiceRow['InvoiceId']."</td>";
                            echo "<td>".$invoiceRow['InvoiceDate']."</td>";

                            // Find all tracks associated with invoice
                            $tracks = mysqli_query($conn, "SELECT TrackId, UnitPrice, Quantity FROM InvoiceLine WHERE InvoiceId=".$invoiceRow['InvoiceId']);
                            echo '<td>';
                            echo '<ul>';
                            while ($tracksInInvoice = $tracks->fetch_assoc()) {
                              // list within cell to show all tracks
                              $trackNamesQuery = mysqli_query($conn, "SELECT Name, Composer FROM Track WHERE TrackId=".$tracksInInvoice['TrackId']);
                              $trackNames = $trackNamesQuery->fetch_assoc();
                              echo '<li>'.$trackNames['Name'].' by '.$trackNames['Composer'].' - $'.$tracksInInvoice['UnitPrice'].'</li>';
                            }

                            mysqli_free_result($tracks); // free results

                            echo '</ul>';
                            echo '</td>';
                            echo "<td>$".$invoiceRow['Total']."</td>";
                            echo "</tr>";
                        }

                        mysqli_free_result($invoices); // free results
                        mysqli_commit($conn); // commit
                        mysqli_close($conn); // close

                    } else { // no purchases yet
                        echo '<h2>No purchases yet :(</h2>';
                        echo '<h4>Go check out our catalog to browse our selection</h4>';
                        echo '<br/>';
                        echo '<a class="btn btn-info btn-lg" href="catalog.php" role="button">Catalog</a>';
                    }

                ?>
                    </tbody>
                </div>
            </table>
        </div>
    </div>

    </div>
</body>
</html>
