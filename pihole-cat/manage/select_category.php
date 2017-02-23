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
			<p>Select all required categories to block. </p>
		</div>						
			<ul >

<label class="description">Active Categories: </label>
	
<div class="list">
<!--
<input type="checkbox" name="active_list" value="Cat01" checked> <label>Cat01</label>
<input type="checkbox" name="active_list" value="Cat02" checked> <label>Cat02</label>
<input type="checkbox" name="active_list" value="Cat03" checked> <label>Cat03</label>
<br><br>
<label class="description">All Categories: </label>

<input type="checkbox" name="active_list" value="Cat01" > <label>Cat01</label>
<input type="checkbox" name="active_list" value="Cat02" > <label>Cat02</label>
<input type="checkbox" name="active_list" value="Cat03" > <label>Cat03</label>
-->
<?php
$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=$url1");

$list_active = file('./data/list_active.txt');
$list_all = file('./data/list_all.txt');
echo '<p>Blocked Categories:</p>';
foreach($list_active as $active) {
echo '<input type="checkbox" name="active_list[]" value="'.$active.'"checked="checked"><label>'.$active.'</label>';
}
echo '<br><br>';

echo '<p>All Categories:</p>';

$z = array_diff($list_all, $list_active);
foreach($z as $notactive) {
echo '<input type="checkbox" name="active_list[]" value="'.$notactive.'"><label>'.$notactive.'</label>';
}

?>
</div>		
	
<br> </br>

<li class="buttons">
<input type="hidden" name="form_id"/>
<input id="saveForm" class="button_text" type="submit" name="submit" Value="Submit"/>	
<br> <br>

</li>
</ul>
		</form>	
		</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>
