<!DOCTYPE html>
<html>
<head>
<title>PiHole: Category Filter Management</title>
<link rel="stylesheet" href="pihole_category_view.css" />
</head>
<body>
<div class="container">
<div class="main">
<h2>PiHole: Category Filter Management</h2>
<form action="pihole_category.php" method="post">
<br>
<label class="heading">Choose the categories you want to block.:</label>
<div class="list">
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

#foreach($list_all as $notactive) {
#if (!in_array($notactive,$list_active)){ 
#echo '<input type="checkbox" name="active_list[]" value="'.$notactive.'"><label>'.$notactive.'</label>';
#}
#}

?>
</div>
<br> </br>

<input type="submit" name="submit" Value="Submit"/>
<br> </br>
<!----- Including PHP Script ----->
<?php include 'pihole_category_modify.php';?>
</form>
</div>
</div>
</body>
</html>

