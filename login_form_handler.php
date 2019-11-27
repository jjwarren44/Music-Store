<?php 	require_once('DBConn.php');

		session_start();

		//Employee attempting to login
		if(isset($_POST['employeeLoginSubmit'])) {
			$employeeID = $_POST['employeeID'];
			$employeeName = $_POST['employeeName'];
			$rowcount = 0; // To determine if employee exists

			mysqli_begin_transaction($conn); // Start mySQLi transaction
			$sql = "SELECT EmployeeId, FirstName FROM Employee WHERE EmployeeId='$employeeID'";
			
			if ($result=mysqli_query($conn,$sql))
			  {
			  // Return the number of rows in result set
			  $rowcount=mysqli_num_rows($result);
			  // Free result set
			  mysqli_free_result($result);
			  }

			// If employee does exist
			if ($rowcount > 0) {
				$_SESSION['employeeID'] = $employeeID;
				$_SESSION['employeeName'] = $employeeName;
				$_SESSION['failedLogin'] = null;
				echo "success";
			} else {
				$_SESSION['failedLogin'] = TRUE;
			}

		} elseif(isset($_POST['logout'])) { // User attempting to logout
    		$_SESSION = array(); // Clear all session variables
    		session_destroy();
    		header('Location: Index.php');
		}

		header('Location: ' . $_SERVER['HTTP_REFERER']);


?>