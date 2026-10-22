<?php 
include('../../products.php');
$store_product = 'shoebox_pro';
include('../../shared.php');
include('whatsnew.php');
head('Shoebox - Download and Version History', 'Shoebox');
table_single_1();
box('text', 'Download Shoebox', hyperlink('/Shoebox.dmg', 'Download Shoebox') . $br . hyperlink('cameras.php', 'Supported RAW cameras'));
foreach ($versions_to_show as $version) {
    anchor('version' . $version);
    box('text', 'Version ' . $version, list_with_tag($whatsnew_arrays[$version], 'whatsnew', 'ul'));
}
table_single_2();
footer();
