<?php

// header('Content-type: text/text');

include('licenses.php');
require 'DB.php';
$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');

set_error_handler('handle_error');

function handle_error($errno, $error, $file, $line) {
	kagi_log("Error: $error in $file:$line");
}

function kagi_log($error) {
	if (strpos($error, 'references should be returned by reference')) return;
	error_log(date('m/d/Y H:i:s') . " $error\n", 3, 'logs/kagi.txt');
}

function kagi_error($error) {
	$message = "There was an error with the following purchase:\n\n$error\n\nmethod: Kagi\n";
	foreach ($_POST as $key => $value) {
		if (substr($key, 0, 4) == 'ACG:') $key = substr($key, 4); 
		$message .= "$key: $value\n";
	}
	send_message('info@kavasoft.com', "Purchase error", $message, 'store@kavasoft.com');
	kagi_log($error . ' (sent email)');
}

foreach ($_POST as $key => $value) {
	$value = stripslashes($value);
	// kagi_log("    $key: $value");
}

function post_value($key) {
	$key = "ACG:$key";
	return array_key_exists($key, $_POST) ? urldecode($_POST[$key]) : null;	
}

// assign posted variables to local variables
$product_name = post_value('ProductName');
$item_number = post_value('QuantityOrdered');
$payment_amount = post_value('UnitPayment');
$transaction_id = post_value('TransactionID');
$payer_email = post_value('PurchaserEmail');

$full_name = post_value('PurchaserName');

$computer_number = '';
$previous_license = '';
$language = 'English';
$version = '';

kagi_log("");
kagi_log("Processing $product_name order for $full_name <$payer_email>.");

$custom_values = explode(',', post_value('CustomerSeed'));
foreach ($custom_values as $custom_value) {
	$values = explode(' - ', trim($custom_value));
	if (count($values) == 2) {
		$key = $values[0];
		$value = $values[1];
		if (strpos($key, 'Keyword: ') === 0)
			$key = substr($key, 9);
		
		kagi_log("    $key: $value");
		
		if ($key == 'Computer-number')
			$computer_number = $value;
		if ($key == 'Previous-license')
			$previous_license = $value;
		if ($key == 'Language')
			$language = $value;
		if ($key == 'Version')
			$version = $value;
	}
}

$program = get_kagi_program($product_name);
$is_upgrade = strpos($product_name, 'pgrade') !== false;

$language_code = 'en';

$allowed_upgrade = null;
if ($is_upgrade) {
	if (array_key_exists($program, $allowed_upgrades)) $allowed_upgrade = $allowed_upgrades[$program];
	
	$minimum_prices = $upgrade_prices;
}

if (!$program) { 
	kagi_error("Invalid program: $product_name");
} else if ($payment_amount < $minimum_prices[$program] * $allowable_discount) {
	kagi_error("Amount too small for $program: $payment_amount");
} else if (!valid_computer_number($computer_number)) {
	$subject = no_computer_number_subject($language_code);
	$message = no_computer_number_message($full_name, $program, $payer_email, $transaction_id, $language_code);
	$date_paid = date('Y-m-d');
	
	$from = 'KavaSoft Store <store@kavasoft.com>';
	$bcc = 'store@kavasoft.com';
	send_message("$full_name <$payer_email>", $subject, $message, $from, $bcc);
	
	$result = save_license($dbh, $full_name, $payer_email, $program, null, null,
		null, $payment_amount, 'Kagi', $language, $version, null, $transaction_id);
		
	kagi_error("Invalid computer number: $computer_number. Emailed $payer_email.");
} else if ($is_upgrade && strlen($previous_license) != 19) {
	kagi_error("Invalid previous license: $previous_license");
} else if ($is_upgrade && $previous_license == 'XXXX-XXXX-XXXX-XXXX') {
	kagi_error("Invalid previous license: $previous_license");
} else if ($is_upgrade && !license_key_exists($dbh, $allowed_upgrade, $previous_license)) {
	kagi_error("Previous license not found: $previous_license");
} else if ($is_upgrade && !can_upgrade_from_key($dbh, $allowed_upgrade, $previous_license)) {
	kagi_error("Previous license already used: $previous_license");
} else {
	kagi_log("Adding to database: $program");
	
	$license_key = license_key($computer_number, $program);
	$subject = subject($program, $language_code);
	$message = message($full_name, $computer_number, $program, $language_code);

	$date_paid = date('Y-m-d');
	$email_sent = $date_paid;
	
	$result = save_license($dbh, $full_name, $payer_email, $program, $computer_number, $license_key, 
		$date_paid, $payment_amount, 'Kagi', $language, $version, $email_sent, $transaction_id);
	kagi_log(($result ? "Added" : "Failed to add") . " record to database for $transaction_id.");
	if ($is_upgrade) did_upgrade_from_key($dbh, $previous_license);

	$from = 'KavaSoft Store <store@kavasoft.com>';
	$bcc = 'store@kavasoft.com';
	if (send_message("$full_name <$payer_email>", $subject, $message, $from, $bcc))
		kagi_log("Sent $program license to $full_name <$payer_email>.");
	else
		kagi_log("Failed to send $program license to $full_name <$payer_email>.");
}

echo("kagiRemotePostStatus=GOOD, message=Processed transaction.\r\n\r\n");

?>
