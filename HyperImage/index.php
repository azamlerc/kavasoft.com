<?php

include($doc_root . '../products.php');

# Page title
$page_name = 'home';
$doc_root = './';
$title = 'HyperImage';
$folder = 'HyperImage';
$store_product = 'hyperimage';
$slogan = "Download web photo galleries.";

include($doc_root . '../shared.php');

head($title, $folder);
banner_table_1();

tour_box();
app_download_box("English$br$br");
buy_box("Upgrade from previous versions for $15", "/store/upgrade.php?product=hyperimage_3_upgrade");
whatsnew_box();

box('sidebar', 'Webmasters &amp; Bloggers', hyperlink("webmasters/", "Give us a plug on your website, enable your viewers to download content, and earn money through our affiliate program.", 'sidebar_link'));

quotes_box();


requirements_box(array('snow leopard', '64bit', 'compatibility'));
questions_box(array('faq', 'help', 'orders', 'service', 'pr', 'contact'));

table_2(); 

box('text', 'About HyperImage', "There are millions of images on the web, but how do you find and download them without clicking on them one at a time? HyperImage is an industrial-strength tool for searching the web and downloading entire websites worth of pictures. Just enter an address or keyword, and watch as thousands of pictures stream down to your computer.<br>
<br>
HyperImage is also a full-featured Tumblr client. Download the contents of any blog, or download your entire dashboard to see the latest posts from all the blogs you're following. Build your own blog by reblogging pictures from Tumblr, sharing pictures from other sites, and uploading pictures from your computer. Backup your own blog to keep it permanent.
");

screenshot(600, 375, 1460, 913);
features_box();

table_3(); 
other_programs($title);
footer(); 

?>

