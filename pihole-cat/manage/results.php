<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PI-Hole Black List Management</title>
<link rel="stylesheet" type="text/css" href="stylesheets/view.css" media="all">
<script type="text/javascript" src="view.js"></script>

</head>
<body id="main_body" >
	
	<img id="top" src="top.png" alt="">
	<div id="form_container">
	
		<h1><a>PiHole-Cat Category Management</a></h1>
		<form class="appnitro"  action="results.php" method="post" >
					<div class="form_description">
			<h2>PiHole-Cat Enable/Disable Category</h2>
			<p>Enable/Disable Categories Results. </p>
		</div>						
			<ul >

<label class="description">Enabled Categories: </label>
	
<div class="list">

<?php
if(isset($_POST['submit'])){
if(!empty($_POST['active_list'])) {
// Counting number of checked checkboxes.
$active_count = count($_POST['active_list']);
echo "You have selected following ".$active_count." Category(s): <br/>";
// Loop to store and display values of individual checked checkbox.
shell_exec ( "/usr/bin/rm -f ./data/list_active.txt");
shell_exec ( "/usr/bin/touch ./data/list_active.txt");
shell_exec ( "/usr/bin/rm -f ./categories/custom.list");
shell_exec ( "/usr/bin/touch ./categories/custom.list");
$enabled_category = "./data/list_active.txt";
$pihole_category = "./categories/custom.list";
$append = fopen( $enabled_category, "a" );
$append_pihole = fopen( $pihole_category, "a" );
foreach($_POST['active_list'] as $selected) {
fputs( $append, "$selected");
fputs( $append_pihole, "http://127.0.0.1/pihole-cat/manage/categories/$selected");
echo "<p>".$selected ."</p>";
}
fclose( $append );
fclose( $append_pihole );
$output = shell_exec ( "/var/www/cgi-bin/pihole_update.sh");
echo "<pre>$output</pre>";
}
else{
echo "<b>Please Select Atleast One Option.</b>";
}
}
?>

</div>		
	
<br> </br>

<li class="buttons">
<input type="hidden" name="form_id"/>
<INPUT id="saveForm" class="button_text" Type="button" VALUE="Go Back" onClick="location.href='select_category.php';"return true;">

<br> <br>

</li>
</ul>

		</form>	
		</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>
