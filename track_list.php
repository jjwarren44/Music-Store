<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Tracks</title>
	<link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/employee_page.css"> <!-- Custom css file -->

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
        	<?php
				echo '<h3>'.$_GET['AlbumName']." by ".$_GET['Artist']." songs</h3>";
        echo '</br>';
        echo '</br>';
			?>
        </div>
    </div>

	<div class="row" align="center">
	<div class="col-1">
    </div>
	<div class="col-10">
        <!--Will get switched to php code//placeholder -->
		<table class="table table-borderless" id="customers" align="Center">
            <div class = 'tableContent'>
				<thead>
						<tr class="table-active">
     					  <th>Song Name</th>
      					<th>Composer</th>
      					<th>Price</th>
     				</tr>
     				</thead>
                    <tbody> 

                    <!-- Begin looping through all records in database to display all customers with SupportRepID == to employee ID -->
                    <?php

                        mysqli_begin_transaction($conn); // Start mySQLi transaction
                        $result = mysqli_query($conn, "SELECT Name, Composer, UnitPrice FROM Track WHERE AlbumId=".$_GET['AlbumId']);

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='table-active'>";
                            echo "<td>".$row['Name']."</td>";
                            echo "<td>".$row['Composer']."</td>";
                            echo "<td>".$row['UnitPrice']."</td>";
                            echo "</tr>";
                        }

                        mysqli_close($conn);

                    ?>
    				</tbody>
                </div>
		</table>
	</div>

      <!-- Both login modals -->
      <?php include('login_modals.php'); ?>

	</div>

</body>

<script type="text/javascript" language="javascript" src="js/employee_page.js"></script>   <!-- javascript file -->

</html>
