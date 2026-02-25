<?php 

$page_name = 'cameras';
$doc_root = '../';
$lang = 'en';

include($doc_root . '../shared/include.php');
include(local_path('whatsnew.php'));

head($title);
banner($banner_alt, 200);
table_top();

left_cell();

paragraph('body', $supported_cameras_header, $supported_cameras);

include(local_path('camera_list.php'));

foreach($camera_list as $vendor => $vendor_array) {
	paragraph('sidebar', $vendor, NULL);
	unordered_list($vendor_array, 'whatsnew');
}

right_cell();

?>

&nbsp;

<?php 

table_bottom($page_name, $store_product); 

?>
