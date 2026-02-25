<?php

include($doc_root . '../products.php');

# Page title
$page_name = 'home';
$doc_root = './';
$title = 'KavaTunes';
$folder = 'KavaTunes';
$store_product = 'kavatunes';
$slogan = "The web jukebox for iTunes.";

include($doc_root . '../shared.php');

head($title, $folder);

table_1();

tour_box();
download_box("English, German, French,$br&nbsp;&nbsp;Japanese, Italian &amp; Dutch");
buy_box("Upgrade from KavaTunes&nbsp;3 or iTunes&nbsp;Catalog for $15", "/store/upgrade.php?product=kavatunes_4_upgrade");
whatsnew_box();
quotes_box('sidebar');
requirements_box(array('leopard', 'universal', 'itunes', 'php', 'compatibility'));
questions_box(array('faq', 'help', 'orders', 'service', 'pr', 'contact'));

table_2(); 

box('text', 'About KavaTunes', "KavaTunes creates interactive websites that look and work just like iTunes. Browse, search, play and download all your music and videos. Catalogs stream your favorite playlists using your computer&rsquo;s built-in web server. KavaTunes can also add artwork to your music.");

screenshot(600, 390, 1200, 781);

$size = 170;
$examples = tr(array(
	td('foo', popup('/KavaTunes/example/', 'Catalog', 1050, 800, 
		img('images/example-1.jpg', 'Example', $size, $size, 'class="box no_padding"') . 
		$br . 'Home Page', 'text_link'), null, null, null, null, 'align="center"'), 
	td('foo', popup('/KavaTunes/example/index.php?genre=rock', 'Catalog', 1050, 800, 
		img('images/example-2.jpg', 'Example', $size, $size, 'class="box no_padding"') .
		$br . 'iTunes Browser', 'text_link'), null, null, null, null, 'align="center"'), 
	td('foo', popup('/KavaTunes/example/ipod?model=video&color=black', 'iPod', 570, 650, 
		img('images/example-3.jpg', 'Example', $size, $size, 'class="box no_padding"') . 
		$br . 'iPod Browser', 'text_link'), null, null, null, null, 'align="center"'), 
));

echo(div("text box_header", 'Example Websites'));
echo(div("text box no_side_padding", "<table border=\"0\" width=\"100%\">$examples</table>"));
echo(spacer_img(25, 25));

features_box();

table_3(); 

other_programs($title);

footer(); 

?>

