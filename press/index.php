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
	$coming_soon = $product['coming_soon'];
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

$key = $_GET['product'];
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

$reviewer = $_GET['name'];
$names = explode(' ', $reviewer);
$first_name = $names[0];
$email = $_GET['email'];
$publication = $_GET['publication'];
$website = $_GET['website'];
$computernumber = $_GET['computernumber'];
$program = $_GET['program'];

if ($reviewer && $email && $publication && $website && $computernumber) {
	echo("Thank you for your interest in reviewing $program. Your details have been received, and we will email you an evaluation license key shortly. If you have any questions, you can email us at <a class=\"otherapps\" href=\"&#109;&#97;&#105;&#108;&#116;&#111;&#58;press&#64;&#107;&#97;&#118;&#97;&#115;&#111;&#102;&#116;&#46;&#99;&#111;&#109;\">press&#64;&#107;&#97;&#118;&#97;&#115;&#111;&#102;&#116;&#46;&#99;&#111;&#109;</a>.");
	
	$headers = 'From: KavaSoft <press@kavasoft.com>' . "\r\n" .
			   'Bcc: press@kavasoft.com' . "\r\n";

	$subject = "$name Review Request";
	$message = "Dear $first_name,\n\nThank you for your interest in reviewing $program. Your details have been received, and we will email you an evaluation license key shortly. If you have any questions, you can email us at press@kavasoft.com.\n\nBest regards,\n\nAndrew\nKavaSoft\n\n\nName: $reviewer\nEmail address: $email\nPublication: $publication\nWebsite address: $website\nComputer number: $computernumber";

	mail("$reviewer <$email>", $subject, $message, $headers);

	
} else {

	echo("Thank you for your interest in reviewing $name. Please fill in the following information, and we will send you a license key so that you may fully evaluate the program. $br$br");

	echo("<center>
<table border=\"0\" cellpadding=\"0\" cellspacing=\"2\">
<form name=\"storeform\" method=\"get\" action=\"index.php\">
<input type=\"hidden\" name=\"product\" value=\"$key\">
<tr><td align=\"right\">Your name:&nbsp;</td><td><input type=\"text\" name=\"name\" size=\"30\" maxlength=\"60\"></td>
<tr><td align=\"right\">Email address:&nbsp;</td><td><input type=\"text\" name=\"email\" size=\"30\" maxlength=\"60\"></td>
<tr><td align=\"right\">Publication:&nbsp;</td><td><input type=\"organization\" name=\"publication\" size=\"30\" maxlength=\"60\"></td>
<tr><td align=\"right\">Website address:&nbsp;</td><td><input type=\"website\" name=\"website\" size=\"30\" maxlength=\"60\"></td>
<tr><td align=\"right\">Computer number:&nbsp;</td><td><input type=\"computer-number\" name=\"computernumber\" size=\"30\" maxlength=\"19\"></td>
	<tr><td colspan=\"2\"><br>$instructions2$br$br</td>
	<tr><td colspan=\"2\" align=\"center\">
		<input type=\"hidden\" name=\"program\" value=\"$name\">
		<input type=\"submit\" name=\"submit\" value=\"&nbsp;&nbsp;&nbsp;Submit Review Request&nbsp;&nbsp;&nbsp;\"></td></tr>
</form>
</table>");
}

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
