<?php

include($doc_root . '../products.php');

# Page title
$page_name = 'home';
$doc_root = './';
$title = 'Shoebox 2';
$folder = 'Shoebox';
$store_product = 'shoebox_pro';
$express_product = 'shoebox_express';
$express_price = $products[$express_product]['price'];
$slogan = "Organize your photos by content. <br /> Create interactive photo websites.";

include($doc_root . '../shared.php');

head($title, $folder);

table_1();

tour_box();

download_box("English, German, French,$br&nbsp;&nbsp;Japanese, Italian &amp; Dutch");

box('sidebar', 'Buy Now',  hyperlink("/store/index.php?shoebox_express=1", img('/images/buttons/buy_now_tall.png', 'Download', 93, 35, 'align="left"')) . hyperlink("/store/index.php?shoebox_express=1", "Buy Shoebox Express", 'sidebar_link') . " for $$express_price $br <font color=\"gray\">(up to 10,000 photos)</font> $br" . spacer_img(10, 5) . "$br". hyperlink("/store/index.php?$store_product=1", img('/images/buttons/buy_now_tall.png', 'Download', 93, 35, 'align="left"')) . hyperlink("/store/index.php?$store_product=1", "Buy Shoebox Pro", 'sidebar_link') . " for $$product_price $br <font color=\"gray\">(unlimited photos)</font>");

box('sidebar', 'KavaLife', hyperlink("/store/index.php?kavalife=1", "Organize your photos, music and movies!<br>Buy Shoebox Express together with KavaTunes and KavaMovies for just $80.", 'sidebar_link'));

include('quotes.php');
$quote = $quotes[rand(0, count($quotes) - 1)];

box('sidebar', 'Quotations', img('images/macworld.png', 'Macworld 4&frac12; mice', 96, 70, 'align="right"') . quote($macworld_quote) . "$br$br" . quote($quote));

whatsnew_box();

box('sidebar', 'Scrapbooking', hyperlink('http://www.jessicasprague.com/index.php?page=shop.product_details&product_id=13&flypage=flypage-ask.tpl&pop=0&option=com_virtuemart&Itemid=49', img('images/jessicasprague.png', 'Jessica Sprague', 272, 29) . 'Take an online course on using Shoebox for digital scrapbooking at JessicaSprague.com!', 'sidebar_link', 'target="jessicasprague"'));

include('categories/examples.php');
$category_links = '';
foreach($all_categories as $type => $categories) {
	foreach($categories as $category) {
		
		$name = $category['name'];
		$filename = $category['filename'];
		$example = $category['example'];
		$description = $category['description'];
		
		$category_links .= hyperlink("categories/index.php", $name, 'sidebar_link');
		if ($name != 'Sports Teams') $category_links .= ' &bull; '; 
	}
}

box('sidebar', 'Download Categories', $category_links);

requirements_box(array('universal', 'tiger', 'compatibility'));

questions_box(array('faq', 'help', 'orders', 'service', 'pr', 'contact'));

table_2(); 

box('text', 'About Shoebox', "Shoebox is the solution for organizing all of your photos by content. You add photos to categories, which describe everything in your photographic world. Categorizing is as simple as a few key clicks, and then you can browse and search your photos by content.");

screenshot(600, 372, 1225, 759);

features_box();
/*
// $autocomplete = img('images/autocomplete.png', 'Autocomplete', 155, 57, 'align="right"');
box('text', 'Categories', "Categories are like keywords on steroids. Shoebox is built to have thousands of hierarchical keywords. You describe the relationship between dates, people, places and things in your world, and Shoebox learns how everything is connected. The more you teach Shoebox, the more it will seem to think for itself. 
$br$br 
Categories answer the who, what, where and when. You don't have to choose whether or organize your photos this way or that way, because you can organize them in many ways at the same time. Catagorizing is fast, fun, and easy as addressing an email message: select some photos, type a few letters, and Shoebox knows what you want.
$br$br
$autocomplete For example, suppose you have a photo of Notre Dame cathedral in Paris. Just type N-O-T and hit return. Then if you search for buildings in Europe, you'll find the photo because Shoebox knows Notre Dame is in Paris, Paris is in France, a cathedral is a church, etc. ");

box('text', 'Organizing', "Shoebox can download photos from all popular cameras, including RAW files. You can browse photos directly on the camera before downloading, and then watch a fullscreen slideshow while downloading.");

box('text', 'Navigating', "Shoebox has a beautiful, clutter-free interface that lets you focus on your photos. Browse by category, folder, or search, even photos directly on your camera.");

box('text', 'Complete Storage Solution', "Sheobox is optimized for enormous photo collections. You can catalog photos in any folder, on any disk, and Shoebox won't move your files around. Burn photos to CD or DVD, and Shoebox remembers which photos are on which disc. You can even shrink photos to save disk space. When you insert a disc or plug in an external drive, Shoebox will seamlessly display original photos at full quality.");
*/

table_3(); 

other_programs($title);

footer(); 

?>

