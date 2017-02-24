<?php
	session_start();
	session_destroy();
	echo '<h2>You have logged out.</h2>'
	header("Location: login.php");

?>