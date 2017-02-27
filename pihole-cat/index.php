<?php

	session_start();
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
		header("Location: login.php");	
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>PiHole-Cat</title>
	<meta name="robots" content="noindex, nofollow" />
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
</head>
		<frameset frameborder="0" framespacing="0" cols="200,*">
			<frame src="menu.html" name="menu" target="main" scrolling="auto"/>
			<frame src="main.html" name="main" id="main"/>
		</frameset>
	</frameset>
	<noframes>
		<body>
			<p>These pages require a browser which supports frames.</p>
		</body>
	</noframes>
</html>
