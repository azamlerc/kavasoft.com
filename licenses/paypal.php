<?php

include('licenses.php');
require 'DB.php';
$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');

set_error_handler('handle_error');

function handle_error($errno, $error, $file, $line) {
	paypal_log("Error: $error in $file:$line");
}

function paypal_log($error) {
	if (strpos($error, 'references should be returned by reference')) return;
	error_log(date('m/d/Y H:i:s') . " $error\n", 3, 'logs/paypal.txt');
}

function paypal_error($error) {
	$message = "There was an error with the following purchase:\n\n$error\n\nmethod: PayPal\n";
	foreach ($_POST as $key => $value) $message .= "$key: $value\n";
	send_message('info@kavasoft.com', "Purchase error", $message, 'store@kavasoft.com');
	paypal_log($error . ' (sent email)');
}

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
	// paypal_log("    $key: $value\n");
}

function post_value($key) {
	return array_key_exists($key, $_POST) ? urldecode($_POST[$key]) : null;	
}

// assign posted variables to local variables
$item_name = post_value('item_name');
$item_number = post_value('item_number');
$payment_status = post_value('payment_status');
$payment_amount = post_value('mc_gross');
$payment_currency = post_value('mc_currency');
$txn_id = post_value('txn_id');
$receiver_email =  post_value('receiver_email');
$payer_email = post_value('payer_email');

$first_name = post_value('first_name');
$last_name = post_value('last_name');
$full_name = "$first_name $last_name";

$computer_number = post_value('option_selection1');
$language_version = post_value('option_selection2');
$previous_license = '';

$program = get_program($item_name);
$is_upgrade = strpos($item_name, 'pgrade') !== false;
$is_additional = strpos($item_name, 'dditional') !== false;
$language = 'English';

/*
$version_offset = strpos($language_version, 'Version: ');
$language_code = code_for_langauge($language_version);
$version = '';
if ($version_offset) {
	$version = substr($language_version, $version_offset + length('Version: '));
}
*/

$language_code = 'en';
$version = '';

paypal_log("");
paypal_log("Processing $item_name order for $full_name <$payer_email>.");

// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$server = ($payer_email == 'andrew@zamler-carhart.com') ? 'www.sandbox.paypal.com' : 'www.paypal.com';
$fp = fsockopen ("ssl://".$server, 443, $errno, $errstr, 30);

$allowed_upgrade = null;
if ($is_upgrade || $is_additional) {
	if (strlen($computer_number) == 39) {
		$previous_license = substr($computer_number, 20, 19);
		$computer_number = substr($computer_number, 0, 19);
	}
}
	
if ($is_upgrade) {
	if (array_key_exists($program, $allowed_upgrades)) $allowed_upgrade = $allowed_upgrades[$program];
	
	$minimum_prices = $upgrade_prices;
}

if ($is_additional) {
	$allowable_discount = 0.5;
	$allowed_upgrade = $program['name'];
}

if (!$fp) {
	paypal_log("HTTP error");
} else {
	fputs ($fp, $header . $req);
	while (!feof($fp)) {
		$res = fgets ($fp, 1024);
		if (strcmp($res, "VERIFIED") == 0) {
			if ($payment_status != 'Completed' && $payment_status != 'Pending') { 
				paypal_log("Incomplete payment: $payment_status");
			} else if (transaction_id_exists($dbh, $txn_id)) { 
				paypal_log("Transaction ID already used: $txn_id"); // no email for this
			} else if (!$program) { 
				paypal_error("Invalid program: $item_name");
			} else if ($receiver_email != 'info@kavasoft.com' && $receiver_email != 'azc@mac.com') {
				paypal_error("Receiver email: $receiver_email");
			} else if ($payment_currency != 'USD') {
				paypal_error("Not in dollars: $payment_currency");
			} else if ($payment_amount < $minimum_prices[$program] * $allowable_discount) {
				paypal_error("Amount too small for $program: $payment_amount");
			} else if (!valid_computer_number($computer_number)) {
				$subject = no_computer_number_subject($language_code);
				$message = no_computer_number_message($full_name, $program, $payer_email, $txn_id, $language_code);
				$from = 'KavaSoft Store <store@kavasoft.com>';
				$bcc = 'store@kavasoft.com';
				send_message("$full_name <$payer_email>", $subject, $message, $from, $bcc);
				
				$result = save_license($dbh, $full_name, $payer_email, $program, null, null,
					null, $payment_amount, 'PayPal', $language, $version, null, $txn_id);

				paypal_error("Invalid computer number: $computer_number. Emailed $payer_email.");
			} else if (($is_upgrade || $is_additional) && strlen($previous_license) != 19) {
				paypal_error("Invalid previous license: $previous_license");
			} else if (($is_upgrade || $is_additional) && $previous_license == 'XXXX-XXXX-XXXX-XXXX') {
				paypal_error("Invalid previous license: $previous_license");
			} else if (($is_upgrade || $is_additional) && !license_key_exists($dbh, $allowed_upgrade, $previous_license)) {
				paypal_error("Previous license not found: $previous_license");
			} else if (($is_upgrade || $is_additional) && !can_upgrade_from_key($dbh, $allowed_upgrade, $previous_license)) {
				paypal_error("Previous license already used: $previous_license");
			} else {
				$license_key = license_key($computer_number, $program);
				$subject = subject($program, $language_code);
				$message = message($full_name, $computer_number, $program, $language_code);
				$from = 'KavaSoft Store <store@kavasoft.com>';
				$bcc = 'store@kavasoft.com';

				$date_paid = date('Y-m-d');
				$email_sent = $date_paid;
				
				$result = save_license($dbh, $full_name, $payer_email, $program, $computer_number, $license_key,
					$date_paid, $payment_amount, 'PayPal', $language, $version, $email_sent, $txn_id);
				paypal_log(($result ? "Added" : "Failed to add") . " record to database for $txn_id.");
				if (($is_upgrade || $is_additional)) did_upgrade_from_key($dbh, $previous_license);

				if (send_message("$full_name <$payer_email>", $subject, $message, $from, $bcc))
					paypal_log("Sent $program license to $full_name <$payer_email>.");
				else
					paypal_log("Failed to send $program license to $full_name <$payer_email>.");
			}
		} else if (strcmp ($res, "INVALID") == 0) {
			paypal_error("Invalid transaction ($server)");
		}
	}

	fclose ($fp);
}

?>
