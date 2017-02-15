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
fputs( $append_pihole, "http://127.0.0.1/admin/manage/categories/$selected");
echo "<p>".$selected ."</p>";
}
fclose( $append );
fclose( $append_pihole );
$output = shell_exec ( "../../../cgi-bin/pihole_update.sh");
echo "<pre>$output</pre>";
}
else{
echo "<b>Please Select Atleast One Option.</b>";
}
}
?>
