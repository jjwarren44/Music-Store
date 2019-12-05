<?php 	require_once('DBConn.php');

		session_start();

		// Customer attempting to login
		if (isset($_POST['customerLoginSubmit'])) {
			try {
				$email = $_POST['email'];
				$password = $_POST['pwrd'];
				$rowcount = 0; // To determine if customer exists

				mysqli_begin_transaction($conn); // Start mySQLi transaction
				$sql = "SELECT CustomerId, Email, Password, FirstName FROM Customer WHERE Email='$email'";

				if ($result = mysqli_query($conn, $sql)) {
					$rowcount = mysqli_num_rows($result);
				}

				// if customer exist, check to see if correct information was provided
				if ($rowcount > 0) {
					$customerInfo = $result->fetch_assoc();

					if ($password == $customerInfo['Password']) { // Correct password provided
						$_SESSION['customerId'] = $customerInfo['CustomerId'];
						$_SESSION['customerFirstName'] = $customerInfo['FirstName'];
						$_SESSION['failedLogin'] = null; // successful login

					} else { // incorrect password
						$_SESSION['failedLogin'] = TRUE;
					}

				} else { // Customer not found, failed login
					$_SESSION['failedLogin'] = TRUE;
				}

				mysqli_commit($conn); // commit transaction
				mysqli_close(); // close connection
				header('Location: ' . $_SERVER['HTTP_REFERER']); // Go back to whereever we came from

			} catch (mysqli_sql_exception $e) { // if exeption thrown
				mysqli_rollback($conn); // rollback changes
				mysqli_close($conn); // close connection
				$_SESSION['failedLogin'] = TRUE; // failed login
				header('Location: ' . $_SERVER['HTTP_REFERER']); // Go back to whereever we came from
			}

		}

		// Employee attempting to login
		elseif (isset($_POST['employeeLoginSubmit'])) {
			try {
				$employeeID = $_POST['employeeID'];
				$enteredEmployeeName = $_POST['employeeName'];
				$rowcount = 0; // To determine if employee exists

				mysqli_begin_transaction($conn); // Start mySQLi transaction
				$sql = "SELECT EmployeeId, FirstName FROM Employee WHERE EmployeeId='$employeeID'";
				
				if ($result = mysqli_query($conn, $sql))
				  {
				  // Return the number of rows in result set
				  $rowcount = mysqli_num_rows($result);

				  }

				// If employee does exist, check to see if name entered matches employee name
				if ($rowcount > 0) {
					$sql_employeeName = $result->fetch_assoc()['FirstName'];
					if ($sql_employeeName == $enteredEmployeeName) {
						$_SESSION['failedLogin'] = null; // successful login
						$_SESSION['employeeID'] = $employeeID;
						$_SESSION['employeeName'] = $sql_employeeName;
					} else {
						$_SESSION['failedLogin'] = TRUE;
					}

				} else { // No employee found, failed login
					$_SESSION['failedLogin'] = TRUE;
				}

				mysqli_commit($conn); // commit transaction
				mysqli_close(); // close connection
				header('Location: ' . $_SERVER['HTTP_REFERER']); // Go back to whereever we came from

			} catch (mysqli_sql_exception $e) {
				mysqli_rollback($conn);
				mysqli_close($conn);
				$_SESSION['failedLogin'] = TRUE;
				header('Location: ' . $_SERVER['HTTP_REFERER']); // Go back to whereever we came from
			}

		}  

		// If user is trying to register
		elseif(isset($_POST['register'])) {
			try {
				mysqli_begin_transaction($conn);

				// All variables for registeration
				$firstName = $_POST['Fname'];
				$lastName = $_POST['Lname'];
				$address = $_POST['address'];
				$city = $_POST['city'];
				$state = $_POST['state'];
				$country = $_POST['country'];
				$postalCode = $_POST['postalcode'];
				$phone = $_POST['phone'];
				$email = $_POST['email'];
				$password = $_POST['password'];

				// Find next CustomerId to be registerd
				$customerId_query = mysqli_query($conn, "SELECT MAX(CustomerId) FROM Customer");
				$new_customerId = mysqli_fetch_row($customerId_query)[0] + 1;

				// Insert new user into customer table
				$register_query = mysqli_query($conn, "INSERT INTO Customer (CustomerId, FirstName, LastName, Address, City, State, Country, PostalCode, Phone, Email, Password) VALUES ({$new_customerId}, '$firstName', '$lastName', '$address', '$city', '$state', '$country', '$postalCode', '$phone', '$email', '$password')");

				$_SESSION['customerId'] = $new_customerId;
				$_SESSION['customerFirstName'] = $firstName;

				mysqli_commit($conn); // Commit changes
				mysqli_close($conn);
				header('Location: index.php'); // Go back to homepage

			} catch (mysqli_sql_exception $e) {
				mysqli_rollback($conn); // undo changes
				mysqli_close($conn); // close connection
				header('Location: ' . $_SERVER['HTTP_REFERER']); // Go back to whereever we came from
			}
		}

		// If user is logging out
		elseif(isset($_POST['logout'])) { // User attempting to logout
    		$_SESSION = array(); // Clear all session variables
    		session_destroy();
    		header('Location: index.php'); // Go back to homepage
		}

?>