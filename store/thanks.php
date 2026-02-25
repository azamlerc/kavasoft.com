<?php

// rewrite the URL so it forms proper form data
$request_parts = explode('/', $_SERVER['REQUEST_URI']);
if (count($request_parts) == 5 && $request_parts[2] == 'thanks.php') {
	$program = $request_parts[3];
	$computer_number = $request_parts[4];
	header("Location: /store/thanks.php?program=$program&computernumber=$computer_number");
}

include('../shared.php');
include('../products.php');

$program = get_value('program');
$computer_number = get_value('computernumber');
$tries = get_value('tries');
if (!$tries) $tries = 0;

$refresh = null;
$refresh_url = null;
$got_query = $program && $computer_number && strlen($computer_number) == 19;
$results = array();
$got_results = false;
$license = null;
$email = null;

global $selected_key;

function program_info($program) {
	global $selected_key;

	if ($program == 'HTML Character Converter') $program = 'Character Converter';
	if ($program == 'iTunes Catalog 2') $program = 'iTunes Catalog';
	
	foreach ($GLOBALS['products'] as $key => $product_info) {
		if ($product_info['name'] == $program) {
			$selected_key = $key;
			return $product_info;
		}
	}
	
	foreach ($GLOBALS['discontinued_products'] as $key => $product_info) {
		if ($product_info['name'] == $program) {
			$selected_key = $key;
			return $product_info;
		}
	}
	
	return array();
}

if ($got_query && $tries < 10) {
	require 'DB.php';
	$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');
	$dbh->setFetchMode(DB_FETCHMODE_OBJECT);

	$wildcards = array('_' => '\_', '%' => '\%');
	$program_term = strtr($dbh->quote($program), $wildcards);
	$computer_number_term = strtr($dbh->quote($computer_number), $wildcards);
	
	$sql = "SELECT name,email,computer_number,license_key,program,amount,date_paid,method,upgrade FROM licenses WHERE program LIKE $program_term && computer_number LIKE $computer_number_term";
	
	$results = $dbh->getAll($sql);
	$got_results = count($results) > 0;
	
	if ($got_results) {
		$license = $results[count($results) - 1];
		$email = $license->email;
	} else {
		$refresh = ($tries < 4) ? 5 : 10;
		$tries++;
		$program_encoded = urlencode($program);
		$refresh_url = "/store/thanks.php?program=$program_encoded&computernumber=$computer_number&tries=$tries";
	}
}

head('KavaSoft - Store - Thank You!', $folder, $refresh, $refresh_url);

table_single_1();

echo(spacer_img(10, 10) . $br);
echo(span('mainheader', 'KavaSoft ') . span('grayheader', 'Store') . $br);
echo(spacer_img(10, 20) . $br);

echo("</td><tr /><tr><td width=\"300\" align=\"left\"valign=\"top\">");

box('sidebar', 'Automatic Registration', "After you have placed your order, simply launch the program to complete your purchase. The program will look up your license key and register itself automatically."); 

box('sidebar', 'KavaSoft Store', hyperlink('index.php', 'You can order our software from the KavaSoft store home page.', 'sidebar_link'));

questions_box(array('orders', 'contact'));

table_2();

$status = 'manual';

if ($program) {
	if (strlen($computer_number) != 19) {
		$status = 'invalid number';
	} else {
		if (count($results)) {
			$status = 'got license';
		} else {
			if ($refresh) {
				$status = 'please wait';
			} else {
				$status = 'not found';
			}
		}
	}
}

$program_info = program_info($program);
$program_link = $program;
$title = $program_info['name'];
$link = '../' . $program_info['link'];
$icon = $program_info['icon'];
$protocol = array_key_exists('protocol', $program_info) ? $program_info['protocol'] : null;
if ($icon) $icon = img('../images/apps/' . $icon . '-128.png', $program_info['name'], 128, 128);
$program_link = hyperlink($link, $title, 'selected');
if ($icon) $icon = hyperlink($link, $icon);

$thank_you = $program ? "Thank you for purchasing $program_link!" : "Thank you for your purchase!";
$short_program = $program;
if ($program == 'Shoebox Express' || $program == 'Shoebox Pro') $short_program = 'Shoebox';
if ($program == 'HTML Character Converter') $short_program = 'Character Converter';
if ($program == 'iTunes Catalog 2') $short_program = 'iTunes Catalog';

function icon_table($icon, $text, $progress_icon = null) {
	$table = "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"140\" valign=\"top\">$icon</td><td valign=\"middle\">$text</td>";
	if ($progress_icon) $table .= "<td valign=\"middle\" width=\"32\">$progress_icon</td>";
	$table .= "</tr></table>";
	return $table;
}

if ($status == 'please wait') {
	$progress_icon = img('../images/icons/progress.gif', 'progress', 32, 32);
	$thank_you .= "$br$br We are currently processing your order. Just a moment...";

	box('text', 'Just a moment&hellip;', icon_table($icon, $thank_you, $progress_icon));
		
} else if ($status == 'got license') {
	$thank_you .= " $br$br Your order has been processed successfully. A confirmation email has been sent to $email.";

	box('text', 'Thank You!', icon_table($icon, $thank_you));

	$license_key = $license->license_key;
	$computernumber = $license->computer_number;
	if ($protocol != null) $license_key_link = hyperlink("$protocol://localhost/license", $license_key, 'selected');
	else $license_key_link = $license_key;
	$message = "Your $program license key is: <blockquote>" . $license_key . "</blockquote>";
	
	$message .= "Click the link above to automatically enter your license key, or follow these steps:";
	$instructions_array = array("Open $short_program.",
		"Choose &ldquo;Buy $short_program&rdquo; from the application menu.",
		"Click the &ldquo;Enter Licence Key&rdquo; button.",
		"Enter your name and license key, and click OK.");
	$message .= list_with_tag($instructions_array, 'body', 'ol');
	
	box('text', 'License Key', $message);
} else if ($status == 'invalid number') {
	box('text', 'Invalid number', $thank_you);
	
} else if ($status == 'not found') {
	$thank_you .= " $br$br We are currently processing your order, and you will receive an email with your license key shortly.";

	box('text', 'Thank You!', icon_table($icon, $thank_you));

		$license_key = $license->license_key;
	if ($protocol != null) $license_key = hyperlink("$protocol://localhost/license", $license_key);
	$message = "When you receive your license key:";
	$instructions_array = array("Open $short_program.",
		"Choose &ldquo;Buy $short_program&rdquo; from the application menu.",
		"Click the &ldquo;Enter Licence Key&rdquo; button.",
		"Enter your name and license key, and click OK.");
	$message .= list_with_tag($instructions_array, 'body', 'ol');
	
	box('text', 'License Key', $message);
		
} else if ($status == 'manual') {
	box('text', 'Thank you!', $thank_you);
}

if ($status == 'got license') {
	$upgrade_key = upgrade_key($program);
	if ($upgrade_key && $license->upgrade != 1) {
		$results_table = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
		$displayed_upgrade_keys[] = $upgrade_key;
		$upgrade = $upgrade_products[$upgrade_key];
		$icon = $upgrade['icon'];
		$link = '../' . $upgrade['link'];
		$program_link = hyperlink($link, $upgrade['name'], 'selected');
		if ($icon) $icon = img('../images/apps/' . $icon . '-128.png', $upgrade['name'], 128, 128);
		if ($icon) $icon = hyperlink($link, $icon);
		$price = $upgrade['price'];
		$upgrade_url = "upgrade.php?product=$upgrade_key&computernumber=$computernumber&licensekey=$license_key";
		$upgrade_button = img('../images/buttons/upgrade_now.png', 'Upgrade Now', 121, 23, 'align="left"');
		$upgrade_button = hyperlink($upgrade_url, $upgrade_button);
		$upgrade_link = hyperlink($upgrade_url, "Upgrade for $$price", 'mainheader');
		$results_table .= tr(array(td('features', $icon, 140), td('features', 
			"You can upgrade to $program_link for $$price. $br$br $upgrade_button")));
		$results_table .= '</table>';
	
		box('text', 'Upgrade', $results_table);
	}
}

table_3();

if ($program) other_programs($program);

footer();

?>
