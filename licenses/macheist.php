<?php

include('licenses.php');
require 'DB.php';
$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');

set_error_handler('handle_error');

function handle_error($errno, $error, $file, $line) {
	macheist_log("Error: $error in $file:$line");
}

function macheist_log($error) {
	if (strpos($error, 'references should be returned by reference')) return;
	error_log(date('m/d/Y H:i:s') . " $error\n", 3, 'logs/macheist.txt');
}

function macheist_error($error) {
	$message = "There was an error with the following purchase:\n\n$error\n\nmethod: PayPal\n";
	foreach ($_GET as $key => $value) $message .= "$key: $value\n";
	send_message('info@kavasoft.com', "Purchase error", $message);
	macheist_log($error . ' (sent email)');
}

function get_value($key) {
	return array_key_exists($key, $_GET) ? urldecode($_GET[$key]) : null;	
}

$item_name = 'KavaTunes';
$payment_amount = 0.00;
$full_name = get_value('name');
$payer_email =  get_value('email');

$txn_id = "MH" . rand(100000, 999999) . rand(100000, 999999);

$program = get_program($item_name);
$language = 'English';

$language_code = 'en';
$version = '';

macheist_log("Processed $item_name order for $full_name <$payer_email>.");

if ($program != 'KavaTunes') { 
	macheist_error("Invalid program: $item_name");
} else {
	// $subject = macheist_subject($language_code);
	// $message = macheist_message($full_name, $program, $payer_email, $txn_id, $language_code);
	// send_message("$full_name <$payer_email>", $subject, $message);
	
	$date_paid = date('Y-m-d');
	
	$result = save_license($dbh, $full_name, $payer_email, $program, null, null,
		$date_paid, $payment_amount, 'MacHeist', $language, $version, null, $txn_id);

	macheist_log("Added license for $payer_email.");
	
	echo("<html><body>");
	echo("Name: $full_name<br>");
	echo("Email: $payer_email<br>");
	echo("Product: $item_name<br>");
	echo("Price: $payment_amount<br>");
	echo("Transaction: $txn_id<br>");
	echo("<body><html>");
}

?>
