<?php
	
	// Find out what page we are on
	if (basename($_SERVER['PHP_SELF']) == "index.php") {
		$currentPage = "index";
	} elseif (basename($_SERVER['PHP_SELF']) == "catalog.php" || basename($_SERVER['PHP_SELF']) == "track_list.php") {
		$currentPage = "catalog";
	} elseif (basename($_SERVER['PHP_SELF']) == "cart.php") {
		$currentPage = "cart";
	} elseif (basename($_SERVER['PHP_SELF']) == "employee_page.php" || basename($_SERVER['PHP_SELF']) == "customer_page.php") {
		$currentPage = "my_account";
	} 

    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
      echo '<a class="navbar-brand" href="index.php">Music Store</a>';
      echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">';
        echo '<span class="navbar-toggler-icon"></span>';
      echo '</button>';
      echo '<div class="collapse navbar-collapse" id="navbarNavDropdown">';
        echo '<ul class="navbar-nav">';

        // if on home page
        if ($currentPage == "index") {
        	echo '<li class="nav-item active">';   	
        } else {
        	echo '<li class="nav-item">';
        }
            echo '<a class="nav-link" href="index.php">Home</a>';
          echo '</li>';

        // if catalog page
        if ($currentPage == "catalog") {
        	echo '<li class="nav-item active">';   	
        } else {
        	echo '<li class="nav-item">';
        }
            echo '<a class="nav-link" href="catalog.php">Catalog</a>';
          echo '</li>';

          // If logged in, show "My Account" instead of login. My account has dropdown to take them to either customer dashboard or employee dashboard

            if (isset($_SESSION['employeeID'])) {

		        // if on my account page
		        if ($currentPage == "my_account") {
		        	echo '<li class="nav-item dropdown active">';   	
		        } else {
		        	echo '<li class="nav-item dropdown">';
		        }

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

            } elseif (isset($_SESSION['customerFirstName'])) {

		        // if on my account page
		        if ($currentPage == "my_account") {
		        	echo '<li class="nav-item dropdown active">';   	
		        } else {
		        	echo '<li class="nav-item dropdown">';
		        }

                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        echo 'My Account';
                    echo '</a>';
                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                        echo '<p class="loggedinName">'.$_SESSION['customerFirstName'].'</p>';
                        echo '<a class="dropdown-item" href="customer_page.php">My Account</a>';
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
       
        echo '</ul>';
      echo '</div>';
    echo '</nav>';

?>