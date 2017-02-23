
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Pi-HOle Black List</title>
<link rel="stylesheet" type="text/css" href="stylesheets/view.css" media="all">
<script type="text/javascript" src="view.js"></script>

</head>
<body id="main_body" >

        <img id="top" src="top.png" alt="">
        <div id="form_container">

                <h1><a>Pi-HOle Black List</a></h1>
                <form id="form_9277" class="appnitro" action="pihole.php" method="post">
                 <div class="form_description">
                        <h2>Pi-HOle Black List</h2>
                        <p>Use this form to add new DNS into Pi-HOle Blacklist Category.</p>
                 </div>

<ul >
 <INPUT id="saveForm" class="button_text" Type="button" VALUE="Go Back" onClick="location.href='index.html';"return true;">
<br><br>
<?php

$DN = $_POST['element_1'];              # DNS Name to Block
$CA = $_POST['element_2'];              # Category Name
$AC = $_POST['element_3'];              # Action to Apply


$output = shell_exec ( "/var/www/cgi-bin/pihole.sh -h \"$DN\" -c \"$CA\" -a $AC ");
echo "<pre>$output</pre>";

?>

 
 <INPUT id="saveForm" class="button_text" Type="button" VALUE="Go Back" onClick="location.href='index.html';"return true;">
 
</ul>
        </form> 

        </div>
        <img id="bottom" src="bottom.png" alt="">

</body>
</html>
