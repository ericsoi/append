<?php
	session_start();
	if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
		// print_r(parse_url($_SERVER['HTTP_REFERER'])['path']);
		// print_r($_SERVER['SCRIPT_NAME'] == '/');
		if (!($_SERVER['SCRIPT_NAME'] == '/loan.php')) {
			header('location: index.php');
			// exit; // Optionally, you can add an exit statement to stop script execution after the redirect.
		}
	}

?>