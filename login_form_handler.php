<?php 	require_once('DBConn.php');

		session_start();

		//Employee attempting to login
		if(isset($_POST['employeeLoginSubmit'])) {
			$employeeID = $_POST['employeeID'];
			$enteredEmployeeName = $_POST['employeeName'];
			$rowcount = 0; // To determine if employee exists

			mysqli_begin_transaction($conn); // Start mySQLi transaction
			$sql = "SELECT EmployeeId, FirstName FROM Employee WHERE EmployeeId='$employeeID'";
			
			if ($result=mysqli_query($conn,$sql))
			  {
			  // Return the number of rows in result set
			  $rowcount=mysqli_num_rows($result);
			  // Free result set
			  // mysqli_free_result($result);
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

			header('Location: ' . $_SERVER['HTTP_REFERER']); // Go back to whereever we came from

		} elseif(isset($_POST['logout'])) { // User attempting to logout
    		$_SESSION = array(); // Clear all session variables
    		session_destroy();
    		header('Location: Index.php'); // Go back to homepage
		}

?>