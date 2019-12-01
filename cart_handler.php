<?php 	require_once('DBConn.php');

		session_start();

		// If user is adding an album
		if (isset($_POST['addToCart'])) {

			// Check to see if user already has a cart
			if (isset($_SESSION['itemsInCart'])) {
				// Check to see if user already added this to cart
				if (in_array($_POST['addToCart'], $_SESSION['itemsInCart'])) {
					// do nothing
				} else {
					array_push($_SESSION['itemsInCart'], $_POST['addToCart']); // Add this album to cart
				}
			} else {
				$_SESSION['itemsInCart'] = array($_POST['addToCart']); // Create new array and store it in session
			}
		}

		// If user is removing from cart
		if (isset($_POST['removeFromCart'])) {
			// find album id from cart then remove from session array containing cart items
			unset($_SESSION['itemsInCart'][array_search($_POST['removeFromCart'], $_SESSION['itemsInCart'])]);
		}

		header('Location: ' . $_SERVER['HTTP_REFERER']); // Go back to whereever we came from

?>