<!DOCTYPE HTML?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Employee Dashboard</title>
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
      <a class="navbar-brand" href="Index.php">Music Store</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="Index.php">Home</a>
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
        <div class=col-4>
        </div>
        <div class="col-4" align="center">
        	<?php
				echo '<h3>'.$_SESSION['employeeName']."'s customers</h3>";
				echo "<p>Click customer to that customer's invoices</p>";
			?>
            <div class="form-group" align="center">
                <input type="text" class="form-control" onkeyup="search()" placeholder="Search Customer Name" id="searchBar" align="center">
            </div>
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
     					<th>Name</th>
      					<th>Phone</th>
      					<th>Email</th>
     				</tr>
     				</thead>
                    <tbody> 

                    <!-- Begin looping through all records in database to display all customers with SupportRepID == to employee ID -->
                    <?php

                        mysqli_begin_transaction($conn); // Start mySQLi transaction
                        $result = mysqli_query($conn, "SELECT CustomerId, FirstName, LastName, Phone, Email FROM Customer WHERE SupportRepId=".$_SESSION['employeeID']);

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='table-active clickable-row' customer-link='customer-invoices.php?CustomerId=".$row['CustomerId']."'>";
                            echo "<td>".$row['FirstName']." ".$row['LastName']."</td>";
                            echo "<td>".$row['Phone']."</td>";
                            echo "<td>".$row['Email']."</td>";
                            echo "</tr>";
                        }

                        mysqli_close($conn);

                    ?>
    				</tbody>
                </div>
		</table>
	</div>
	</div>

</body>

<script type="text/javascript" language="javascript" src="js/employee_page.js"></script>   <!-- javascript file -->

</html>
