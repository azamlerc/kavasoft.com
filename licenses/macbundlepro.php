<?php

include('licenses.php');
require 'DB.php';
$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');

set_error_handler('handle_error');

function handle_error($errno, $error, $file, $line) {
	macbundlebox_log("Error: $error in $file:$line");
}

function macbundlebox_log($error) {
	if (strpos($error, 'references should be returned by reference')) return;
	error_log(date('m/d/Y H:i:s') . " $error\n", 3, 'logs/macbundlebox.txt');
}

function macbundlebox_error($error) {
	$message = "There was an error with the following purchase:\n\n$error\n\nmethod: PayPal\n";
	foreach ($_GET as $key => $value) $message .= "$key: $value\n";
	send_message('info@kavasoft.com', "Purchase error", $message);
	macbundlebox_log($error . ' (sent email)');
}

function get_value($key) {
	return array_key_exists($key, $_GET) ? urldecode($_GET[$key]) : null;	
}

function post_value($key) {
	return array_key_exists($key, $_POST) ? urldecode($_POST[$key]) : null;	
}

$item_name = "iConquer 4"; // get_value('product');
$payment_amount = 35; // get_value('price');
$full_name = get_value('name');
if (!$full_name) $full_name = post_value('name');
$payer_email =  get_value('email');
if (!$payer_email) $payer_email =  post_value('email');
$txn_id = "MBP" . rand(100000, 999999);

$program = get_program($item_name);
$language = 'English';

$language_code = 'en';
$version = '';

macbundlebox_log("");
macbundlebox_log("Processed $item_name order for $full_name <$payer_email>.");

if (!$program) { 
	macbundlebox_error("Invalid program: $item_name");
} else {
	$subject = macbundlepro_subject($language_code);
	$message = macbundlepro_message($full_name, $program, $payer_email, $language_code);
	send_message("$full_name <$payer_email>", $subject, $message);
	
	$date_paid = date('Y-m-d');
	
	$result = save_license($dbh, $full_name, $payer_email, $program, null, null,
		$date_paid, $payment_amount, 'MacBundlePro', $language, $version, null, $txn_id);

	macbundlebox_log("Emailed $payer_email.");
	
	echo("<html><body>");
	echo("Name: $full_name<br>");
	echo("Email: $payer_email<br>");
	echo("Product: $item_name<br>");
	echo("Price: $payment_amount<br>");
	echo("Transaction: $txn_id<br>");
	echo("<body><html>");
}

?>
