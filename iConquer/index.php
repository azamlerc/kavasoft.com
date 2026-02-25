<?php

include($doc_root . '../products.php');

# Page title
$page_name = 'home';
$doc_root = './';
$title = 'iConquer';
$folder = 'iConquer';
$store_product = 'iconquer';
$slogan = "iCame, iSaw, iConquered.";

include($doc_root . '../shared.php');

head($title, $folder, null, null, ' onload="window.setInterval(\'runSlideShow()\', SlideShowSpeed);"');

?>

<script type="text/javascript"><!-- 
var stopShow = 0;
var SlideShowSpeed = 5000;
var CrossFadeDuration = 3;
var Picture = new Array();

Picture[1]  = 'images/iconquer_paris.jpg';
Picture[2]  = 'images/iconquer_newyork.jpg';
Picture[3]  = 'images/iconquer_4_is_here.png';
Picture[4]  = 'images/iconquer_london.jpg';

var tss;
var iss;
var jss = 1;
var pss = Picture.length-1;

var preLoad = new Array();
for (iss = 1; iss < pss+1; iss++){
preLoad[iss] = new Image();
preLoad[iss].src = Picture[iss];}

function runSlideShow(){
    if (document.all){
	    document.images.PictureBox.style.filter="blendTrans(duration=2)";
	    document.images.PictureBox.style.filter="blendTrans(duration=CrossFadeDuration)";
	    document.images.PictureBox.filters.blendTrans.Apply();
	}
    document.images.PictureBox.src = preLoad[jss].src;
    if (document.all) document.images.PictureBox.filters.blendTrans.Play();
    jss = jss + 1;
    if (jss > (pss)) jss=1;
}

//--></script>
<?php

include('plugins/data.php');

$plugin_links = '';
$plugin_names = array();
foreach($plugins as $index => $plugin) {
	$name = $plugin['CFBundleName'];
	$parenthesis = strpos($name, ' (');
	if ($parenthesis) $name = substr($name, 0, $parenthesis);
	if (array_search($name, $plugin_names) === false) {
		$identifier = $plugin['CFBundleIdentifier'];
		$plugin_links .= $name; // hyperlink("plugins/index.php", $name, 'sidebar_link');
		if ($name != 'United States') $plugin_links .= ' &bull; ';
		$plugin_names[] = $name;
	}
}

function my_table_1($width = 300, $total_width = 925, $image = null) {
	global $folder;
	global $title;
	global $slogan;
	global $br;
	global $doc_root;
	global $plugin_links;
	
	$border = 0;
	
	echo("<table class=\"main\" width=\"$total_width\" border=\"$border\" 
		cellpadding=\"0\" cellspacing=\"0\">");
	echo("<tr><td width=\"$totalwidth\" align=\"left\" valign=\"top\" colspan=\"3\">");

	echo(spacer_img(15, $vertical_space));
	echo(hyperlink($doc_root . 'index.php', img('images/iconquer_london.jpg', 'iConquer 4 is here.', 925, 400, 'id="PictureBox" name="PictureBox"')));

	echo("</td></tr><tr><td colspan=\"3\">" . spacer_img(25, $vertical_space) . 
		"</td></tr><tr><td width=\"$width\" align=\"left\"valign=\"top\">");
}

my_table_1();

tour_box();

app_download_box("English, German, French,$br Japanese, Italian &amp; Dutch");
buy_box("Upgrade from previous versions for $15", "/store/upgrade.php?product=iconquer_4_upgrade");

whatsnew_box();

requirements_box(array('leopard', '64bit', 'compatibility'));

table_2(); 

box('text', 'About iConquer', "iConquer is the original game of world conquest for the Mac. Take over every country on the map and eliminate your opponents to win. iConquer comes with gorgeous high-definition maps of cities, countries, continents and the world. Challenge yourself by playing against eleven kinds of computer players, or play your friends over the network.");

screenshot(600, 415, 1150, 796);

echo(spacer_img(25, 25));

table_3(); 

function another_table_1($width = 300, $total_width = 925, $image = null) {
	global $folder;
	global $title;
	global $slogan;
	global $br;
	global $doc_root;
	global $plugin_links;
	
	$border = 0;
	
	echo("<table class=\"main\" width=\"$total_width\" border=\"$border\" 
		cellpadding=\"0\" cellspacing=\"0\">");
	echo("<tr><td width=\"$totalwidth\" align=\"left\" valign=\"top\" colspan=\"3\">");

	echo(div("$class box_header", 'Maps'));
	echo('<iframe src="imageflow/index.html" width="927" height="425" frameborder="0" scrolling="no" marginwidth="0" marginheight="0"></iframe>');
	echo(div("text box", $plugin_links));

	echo("</td></tr><tr><td colspan=\"3\">" . spacer_img(25, $vertical_space) . 
		"</td></tr><tr><td width=\"$width\" align=\"left\"valign=\"top\">");
}

another_table_1();

quotes_box();

questions_box(array('help', 'orders', 'service', 'developer', 'pr', 'contact'));

table_2(); 

features_box();

table_3(); 

other_programs($title);

footer(); 

?>

