<?php
	session_start();
	$username = "admin";
	$password = "picatadmin";
	
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		header("Location: index.php");
		}
	if (isset($_POST['username']) && isset($_POST['password'])) {
		if ($_POST['username'] == $username && $_POST['password'] == $password)
{
	$_SESSION['loggedin'] = true;
	header("Location: index.php");
}		
	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Pi-HOle Black List</title>
<link rel="stylesheet" type="text/css" href="manage/stylesheets/view.css" media="all">
<script type="text/javascript" src="view.js"></script>

</head>
<body id="main_body" >

        <img id="top" src="manage/top.png" alt="">
        <div id="form_container">

                <h1><a>PiHOle-Cat Manager</a></h1>
                <form class="appnitro" action="login.php" method="post">
                 <div class="form_description">
                        <h2>PiHOle-Cat Manager</h2>
                        <p>Login with Authorized Username and Password.</p>
                 </div>

<ul >
<br><br>


		Username:<br>
		<input type="text" name="username"><br>
		Password:<br>
		<input type="password" name="password"><br>
		<input class="button_text" type="submit" value="Login!">		

 
 
</ul>
        </form> 

	<div id="footer">
			Created by <a href="http://www.itech.ly">iTech Solutions</a>
		</div>
        </div>
        <img id="bottom" src="manage/bottom.png" alt="">

</body>
</html>
