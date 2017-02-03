
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PI-HOle Black List</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>

</head>
<body id="main_body" >

        <img id="top" src="top.png" alt="">
        <div id="form_container">

                <h1><a>PI-HOle Black List</a></h1>
                <form id="form_9277" class="appnitro" action="pihole.php" method="post">
                <div class="form_description">
                        <h2>Pi-HOle Black List</h2>
                        <p>Use this form to add new DNS into Pi-HOle Blacklist Category.</p>
                </div>
 <FORM><INPUT Type="button" VALUE="Go Back" onClick="location.href='index.php';"return true;"></FORM>
               <ul >

<?php

$DN = $_POST['element_1'];              # DNS Name to Block
$CA = $_POST['element_2'];              # Category Name
$AC = $_POST['element_3'];              # Action to Apply

#$user_name_var = $_SERVER['PHP_AUTH_USER'];
$output = shell_exec ( "../../../cgi-bin/pihole.sh -h \"$DN\" -c \"$CA\" -a $AC ");
echo "<pre>$output</pre>";
#shell_exec ( "/bin/echo test >> pihole.log" );

?>

 <FORM><INPUT Type="button" VALUE="Go Back" onClick="location.href='index.php';"return true;"></FORM>
                        </ul>
                </form> 
                <div id="footer">
                        Created By <a href="http://itech.ly/">JElayeb</a>
                </div>
        </div>
        <img id="bottom" src="bottom.png" alt="">
        </body>
</html>
