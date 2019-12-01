<!DOCTYPE HTML?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Customer Invoices</title>
	<link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/customer-invoices.css"> <!-- Custom css file -->

    <!-- JQuery -->
	<script src="js/jquery-3.4.1.js"></script>
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
                echo '<div class="container-fluid failedlogin" style="padding-top: 2vw">';
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
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="catalog.php">Catalog</a>
          </li>

          <!-- If logged in, show "My Account" instead of login. My account has dropdown to take them to either customer dashboard or employee dashboard -->
          <?php
            if (isset($_SESSION['employeeID'])) {
                echo '<li class="nav-item dropdown active">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        echo 'My Account <span class="sr-only">(current)</span>';
                    echo '</a>';
                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                    	echo '<p class="loggedinName">'.$_SESSION['employeeName'].'</p>';
                        echo '<a class="dropdown-item" href="employee_page.php">My Account</a>';
                    echo '</div>';
                echo '</li>';
                echo '<form action=" login_form_handler.php" method="post" id="profileLogout">';
                    echo '<button type="submit" name="logout" class="btn btn-outline-danger" id="logout">Logout</button>';
                echo '</form>';
            }

          ?>

        </ul>
      </div>
    </nav> <!-- end nav bar -->

    <div class="container-fluid">
    <div class="row" align="center">
      <div class="col-1">
      </div>
    <div class="col-10">

    <?php
      $customerName = mysqli_query($conn, "SELECT FirstName, LastName FROM Customer WHERE CustomerId=".$_GET['CustomerId']);
      $result = $customerName->fetch_assoc();

      echo '<h3>'.$result['FirstName'].' '.$result['LastName']."'s orders";
      echo '</br>';
      echo '</br>';

    ?>

    <!-- Table of invoices for this customer with tracks for each invoice -->
    <table class="table table-borderless" id="invoices" align="Center">
            <div class = 'tableContent'>
        <thead>
            <tr class="table-active">
                <th>Invoice ID</th>
                <th>Invoice Date</th>
                <th>Songs</th>
                <th>Total</th>
            </tr>
            </thead>
                    <tbody> 

                    <!-- Begin looping through all records in database to display all customers with SupportRepID == to employee ID -->
                    <?php

                        mysqli_begin_transaction($conn); // Start mySQLi transaction
                        $invoices = mysqli_query($conn, "SELECT InvoiceId, InvoiceDate, Total FROM Invoice WHERE CustomerId=".$_GET['CustomerId']);

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

                            echo '</ul>';
                            echo '</td>';
                            echo "<td>$".$invoiceRow['Total']."</td>";
                            echo "</tr>";
                        }

                        mysqli_close($conn);

                    ?>

                    </tbody>
                  </div>
                </table>
              </div>
            </div>
          </div>


  </body>
  </html>