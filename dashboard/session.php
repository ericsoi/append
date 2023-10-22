<?php
	session_start();
	if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
		if (!parse_url($_SERVER['HTTP_REFERER'])['path'] == '/') {
			header('location: index.php');
			exit; // Optionally, you can add an exit statement to stop script execution after the redirect.
		}
	}

?>