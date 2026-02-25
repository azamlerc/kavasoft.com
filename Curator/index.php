<?php

include($doc_root . '../products.php');

# Page title
$page_name = 'home';
$doc_root = './';
$title = 'Curator';
$folder = 'Curator';
$store_product = 'curator';
$slogan = "The iTunes artwork manager.";

include($doc_root . '../shared.php');

head($title, $folder);

table_1();

tour_box();
download_box("English, German, French,$br&nbsp;&nbsp;Japanese, Italian &amp; Dutch");
buy_box();

require('quotes.php');
box('sidebar', 'Quote', quote($quotes[0]));

whatsnew_box();
requirements_box(array('leopard', 'universal', 'itunes', 'compatibility'));
questions_box(array('faq', 'help', 'orders', 'service', 'pr', 'contact'));

table_2(); 

box('text', 'About Curator', "Curator makes adding artwork to your iTunes music easy. Just click to download artwork for all of your music and copy it to iTunes. Curator gives you fine control over the process, showing you which artists and albums have artwork.");

screenshot(600, 394, 1040, 683);

features_box();

table_3(); 

other_programs($title);

footer(); 

?>

