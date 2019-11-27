<?php
require_once('DBConn.php');
?>
<!DOCTYPE HTML?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	 <title>Catalog</title>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="css/table.css"> <!-- Custom css file -->
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
                $_SESSION['failedlogin'] = null;
            }

        ?>

    <!-- Nav bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="Index.php">Music Store</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="Index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="table.php">Catalog</a>
          </li>

          <!-- If logged in, show "My Account" instead of login. My account has dropdown to take them to either customer dashboard or employee dashboard -->

          <?php
            if (isset($_SESSION['employeeID'])) {
                echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        echo 'My Account';
                    echo '</a>';
                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                        echo '<a class="dropdown-item" href="employee_page.php">My Account</a>';
                    echo '</div>';
                echo '</li>';

            } elseif (isset($_SESSION['customerID'])) {
                echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        echo 'My Account';
                    echo '</a>';
                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                        echo '<a class="dropdown-item" href="#">My Account</a>';
                        echo '<a class="dropdown-item" href="#">Logout</a>';
                    echo '</div>';
                echo '</li>';
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
    </nav>

	<div class="container-fluid">
        <div class="row" align="center">
            <div class=col-4>
            </div>
            <div class="col-4" align="center">
                <div class="form-group" align="center">
                    <input type="text" class="form-control" onkeyup="search()" placeholder="Search Album or Artist" id="searchBar" align="center">
                </div>
            </div>
        </div>
		<div class="row" align="center">
			<div class="col-1">
            </div>
			<div class="col-10">
                <!--Will get switched to php code//placeholder -->
				<table class="table table-borderless" id="albums" align="Center">
                    <div class = 'tableContent'>
        				<thead>
        						<tr class="table-active">
             					<th>Album</th>
              					<th>Artist</th>
             				</tr>
             				</thead>
                            <tbody> 

                            <!-- Begin looping through all records in database to display albums and artist -->
                            <?php

                                mysqli_begin_transaction($conn); // Start mySQLi transaction
                                $result = mysqli_query($conn, "SELECT Name, Title FROM Artist, Album WHERE Artist.ArtistId = Album.ArtistId ORDER BY AlbumId");

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr class='table-active'>";
                                    echo "<td>".$row['Title']."</td>";
                                    echo "<td>".$row['Name']."</td>";
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

<script type="text/javascript" language="javascript" src="js/table.js"></script>   <!-- javascript file -->

</html>