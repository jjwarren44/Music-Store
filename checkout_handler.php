<?php require_once('DBConn.php');

	session_start();

	if (isset($_POST['checkout'])) {

		try {
			// Start transaction
			mysqli_begin_transaction($conn);

			// Query to find customer address information
			$address_query = mysqli_query($conn, "SELECT Address, City, State, Country, PostalCode FROM Customer WHERE CustomerId=".$_SESSION['customerId']);
			$customer_address = $address_query->fetch_assoc();

			$address = $customer_address['Address'];
			$city = $customer_address['City'];
			$state = $customer_address['State'];
			$country = $customer_address['Country'];
			$postal_code = $customer_address['PostalCode'];

			// Find next InvoiceId
			$invoiceId_query = mysqli_query($conn, "SELECT MAX(InvoiceId) FROM Invoice");
			$new_invoiceId = mysqli_fetch_row($invoiceId_query)[0] + 1;

		    // Find total price of all albums
	        $sql_cartItems = implode(",", $_SESSION['itemsInCart']); // Create string of album IDs in cart -- example (56,42,10)
	        $result = mysqli_query($conn, "SELECT SUM(UnitPrice) FROM Track WHERE AlbumId IN (${sql_cartItems})");
	        $cartTotal = mysqli_fetch_row($result)[0];

	        $today = date("Y-m-d");

			// Insert order into Invoice table
			$insert_order = mysqli_query($conn, "INSERT INTO Invoice (InvoiceId, CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingCountry, BillingPostalCode, Total) VALUES ({$new_invoiceId}, {$_SESSION['customerId']}, '$today', '$address', '$city', '$state', '$country', '$postal_code', $cartTotal)");

			// Begin inserting each item into InvoiceLine table
			// Start by finding next InvoiceLineId to be storedd
			$max_invoiceLineId = mysqli_query($conn, "SELECT MAX(InvoiceLineId) FROM InvoiceLine");
			$new_invoiceLineId = mysqli_fetch_row($max_invoiceLineId)[0] + 1;

			// Loop through all items in cart and insert items into InvoiceLine table
			foreach ($_SESSION['itemsInCart'] as &$track) {
				$track_price_query = mysqli_query($conn, "SELECT TrackId, UnitPrice FROM Track WHERE AlbumId=".$track); // Find tracks of album
				
				while ($row = $track_price_query->fetch_assoc()) {
					// Insert into InvoiceLine table
					$insert_line_query = mysqli_query($conn, "INSERT INTO InvoiceLine (InvoiceLineId, InvoiceId, TrackId, UnitPrice, Quantity) VALUES ({$new_invoiceLineId}, {$new_invoiceId}, {$row['TrackId']}, {$row['UnitPrice']}, 1)");
					$new_invoiceLineId++; // increment invoice line id
				}

				mysqli_free_result($track_price_query);	 // free result set for next iteration
		
			}

			mysqli_free_result($invoiceId_query); // free results
			mysqli_commit($conn); // commit
			mysqli_close($conn); // close

			unset($_SESSION['itemsInCart']); // Remove items from cart
			$_SESSION['successfulOrder'] = TRUE; // Let user know order has been successful

			header('Location: index.php'); // Go back to homepage

		} catch (mysqli_sql_exception $e) {
			mysqli_rollback($conn);
			throw $e;
			mysqli_close($conn);
			header('Location: ' . $_SERVER['HTTP_REFERER']); // Go back to cart
		}


	}
	



?>