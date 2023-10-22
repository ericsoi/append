<?php
	session_start();
	if(!($_SESSION['user_id'])){
		$_SESSION['user_id'] = '1234';
		header('location:index.php');
	}
?>