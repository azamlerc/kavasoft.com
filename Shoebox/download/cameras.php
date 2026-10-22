<?php 
include('../../shared.php');
include('en/camera_list.php');
head('Shoebox - RAW Support', 'Shoebox');
table_single_1();
box('text', 'RAW Support', 'Shoebox can display RAW files from the following cameras:');
foreach ($camera_list as $vendor => $cameras) {
    box('text', $vendor, list_with_tag($cameras, 'whatsnew', 'ul'));
}
table_single_2();
footer();
