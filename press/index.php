<?php 

include('../products.php'); 
include('../shared.php');

head('KavaSoft - Press Info', $folder);

table_single_1();

echo(spacer_img(10, 10) . $br);
echo(span('mainheader', 'KavaSoft ') . span('grayheader', 'Press Info') . $br);
echo(spacer_img(10, 20) . $br);

echo(div("$class box_header", 'Applications'));
echo('<table class="box" width="925" border="0" cellpadding="10" cellspacing="0"><tr>');
if ($title == 'Shoebox') $title = "Shoebox Pro";
global $products;
foreach($products as $key => $product) {
	if ($key == 'shoebox_pro') $key = 'shoebox';
	$name = $product['name'];
	$icon = $product['icon'];
	$coming_soon = $product['coming_soon'] ?? false;
	if ($name != 'Shoebox Express' && !$coming_soon) {
		if ($name == 'Shoebox Pro') $name = 'Shoebox';
		if ($name == 'Translation Service') $name = 'Translation&nbsp;Service';
		if ($name == 'Character Converter') $name = 'Character&nbsp;Converter';
		echo('<td align="center" valign="top">');
		echo(hyperlink("index.php?product=$key", img("/images/apps/$icon-128.png", 
			$name, 105, 105)));
		echo(hyperlink("index.php?product=$key", $name, 'otherapps') . $br);
/*		echo(hyperlink("index.php?product=$key&content=release", 
			'press release', 'sidebar_link') . $br);
		echo(hyperlink("index.php?product=$key&content=screenshot", 
			'screenshot', 'sidebar_link') . $br);
		echo(hyperlink("index.php?product=$key&content=icon", 
			'application icon', 'sidebar_link') . $br);
		echo(hyperlink("index.php?product=$key&content=review", 
			'review request', 'sidebar_link') . $br);
*/		echo('</td>');
	}
}

echo('</tr></table>');

echo(spacer_img(25, 25));

$key = ($_GET['product'] ?? null);
if (!$key) $key = $new_products[0];
if ($key == 'shoebox') $key = 'shoebox_pro';
$product = $products[$key];
$name = $product['name'];
if ($name == 'Shoebox Pro') $name = 'Shoebox';
$icon = $product['icon'];
$release = $product['release'];

echo("<table class=\"main\" width=\"925\" border=\"0\" 
	cellpadding=\"0\" cellspacing=\"0\">");
echo("<tr><td width=\"300\" align=\"left\" valign=\"top\">");

box('text', 'Links', hyperlink("../$icon/", 'Home Page', 'sidebar_link') . $br .
	hyperlink("../$icon.dmg", 'Download', 'sidebar_link'));

$image = popup("/images/apps/$icon-512.png", 'icon', 512, 512, 
	img("/images/apps/$icon-256.png", "$name icon", 256, 256));
box('text', 'Application Icon', center($image));

$image = popup("../$icon/images/screenshot-large.jpg", 'icon', $product['screenshot_width'], $product['screenshot_height'], 
	img("../$icon/images/screenshot-600.jpg", "$name screenshot", 280));
box('text', 'Screenshot', center($image));

table_2();

$instructions2 = "To find your computer number, <a class=\"otherapps\" href=\"/$icon.dmg\">download</a> and launch $name. The sixteen-digit computer number will be displayed at the bottom of the &ldquo;Buy $name&rdquo; window.";

echo(div("$class box_header", 'Review Request'));
echo('<div class="box">');

echo('This is an archived site. Review requests and evaluation licenses are no longer available.');

echo('</div>');
echo(spacer_img(25, 25));

if ($release && file_exists($release)) {
	$release_text = file_get_contents($release);
	$release_text = str_replace("\n", "<br />", $release_text);
	box('text', 'Press Release', $release_text);
}

table_3();

footer();

?>
