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

	<div class="container-fluid">
        <div class="row" align="center">
            <div class=col-4>
            </div>
            <div class="col-4" align="center">
                <div class="form-group" align="center">
                    <input type="text" class="form-control" onkeyup="search()" placeholder="Search Album or Artist" id="searchBar" align="center">
                </div>
                <p>Click album to see songs in the album</p>
            </div>
        </div>
		<div class="row" align="center">
			<div class="col-1">
            </div>
			<div class="col-10">
               
				<table class="table table-borderless" id="albums" align="Center">
                    <div class = 'tableContent'>
        				<thead>
                            <col width='30%'>
                            <col width='30%'>
                            <col width='20%'>
                            <col width='10%'>
        						<tr class="table-active">
             					<th>Album</th>
              					<th>Artist</th>
                                <th>Price</th>
                                <th></th>
             				</tr>
             				</thead>
                            <tbody> 

                            <!-- Begin looping through all records in database to display albums and artist -->
                            <?php

                                mysqli_begin_transaction($conn); // Start mySQLi transaction
                                $result = mysqli_query($conn, "SELECT AlbumId, Name, Title FROM Artist, Album WHERE Artist.ArtistId = Album.ArtistId ORDER BY AlbumId");

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr class='table-active clickable-row' album-link='track_list.php?AlbumId=".$row['AlbumId']."&AlbumName=".$row['Title']."&Artist=".$row['Name']."'>";
                                    echo "<td>".$row['Title']."</td>";
                                    echo "<td>".$row['Name']."</td>";

                                    // Find price of album
                                    $price_query = mysqli_query($conn, "SELECT SUM(UnitPrice) FROM Track WHERE AlbumId=".$row['AlbumId']);
                                    echo "<td>$".mysqli_fetch_row($price_query)[0]."</td>";

                                    echo "<td align='right'><form action='cart_handler.php' method='post' id='addToCart'>";
                                        echo "<button type='submit' name='addToCart' value='".$row['AlbumId']."' class='btn btn-outline-info'>Add to cart</button>";
                                    echo "</form></td>";
                                    echo "</tr>";
                                }

                                mysqli_close($conn);

                            ?>
            				</tbody>
                        </div>
    			</table>
    		</div>
    	</div>

        <!-- Both login modals -->
        <?php include('login_modals.php'); ?>

    </div>
</body>

<script type="text/javascript" language="javascript" src="js/catalog.js"></script>   <!-- javascript file -->

</html>