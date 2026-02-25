<?php

# Page title
$title = "Shoebox - Download";

# Banner alternate text
$banner_alt = "Download Shoebox $version";

$size = $disk_image_size_megs . $decimal_separator . $disk_image_size_decimal;
$disk_image_size = "$size MB disk image";

$whats_new = "What&rsquo;s new?";

$download_content = array(
	'Download' => array(
		array(
			'icon' => 'diskimage.png',
			'title' => "Shoebox " . $version,
			'text' => $disk_image_size,
			'link' => "../../Shoebox.dmg"
		),
		array(
			'icon' => 'international.png',
			'title' => "",
			'text' => "Includes English, French, German, $br Dutch, Italian and Japanese languages",
		),
	),
	'Requirements' => array(
		array(
			'icon' => 'mac.png',
			'title' => "Mac OS X",
			'text' => "Version 10.4 or later",
		),
		array(
			'icon' => 'universal.png',
			'title' => "Universal",
			'text' => "Runs natively on Intel and PowerPC",
		),
		array(
			'icon' => 'network.png',
			'title' => "Web Server",
			'text' => "<a href=\"javascript: popup = window.open('phpsupport.php','phpsupport','width=440,height=310'); window.name = 'home';\">With PHP support</a>",
		),
	),
	'Instructions' => array(
		array(
			'icon' => 'diskimage.png',
			'text' => "1. Click the disk image icon to download Shoebox",
			'link' => "../../Shoebox.dmg"
		),
		array(
			'icon' => 'mountedimage.png',
			'text' => "3. Double-click the Shoebox disk on your desktop"
		),
		array(
			'icon' => 'diskimage.png',
			'text' => "2. Double-click the Shoebox.dmg file on $br &nbsp;&nbsp;&nbsp;&nbsp;your computer to mount the disk image",
			'link' => "../../Shoebox.dmg"
		),
		array(
			'icon' => 'applications.png',
			'text' => "4. Drag the Shoebox application icon $br &nbsp;&nbsp;&nbsp;&nbsp;to your Applications folder",
		),
	),
);

$php_support_title = 'Shoebox - PHP';

$what_is_php_header = 'What is PHP?';
$what_is_php_text = "Shoebox creates dynamic catalogs that use the PHP scripting language. To serve these catalogs, your web server needs to support PHP.";

$support_php_header = 'Does my web server support PHP?';
$support_php_text = "Personal Web Sharing supports PHP, so you can use any Mac as a web server. $br$br If you have professional web hosting, your server probably supports PHP. Check with your server administrator if you're not sure. They may need to turn it on for you. $br$br If you have basic web hosting, check with your provider. At this time .Mac does not support PHP.";

$get_hosting_header = 'How can I get web hosting with PHP support?';
$get_hosting_text = "KavaSoft's partner <a href=\"http://secure.hostforweb.com/ua/clickthru.cgi/kavasoft\" target=\"hostforweb\">Host For Web</a> offers professional web hosting, including PHP and FTP support, starting at $4.95/month. Personalized domain names are also available.";

?>