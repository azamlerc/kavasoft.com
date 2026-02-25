<html>
<head>
	<title>macupdate</title>
</head>
<body>
<form action="macupdate-add.php" method="post">
	<textarea name="customers" rows="9" cols="50"></textarea><br>
	<input type="submit" name="preview" value="Add">
</form>
<hr>
<?php

include('licenses.php');
require_once 'XPertMailer.php';
require 'DB.php';
$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');

set_error_handler('handle_error');

function handle_error($errno, $error, $file, $line) {
	macupdate_log("Error: $error in $file:$line");
}

function macupdate_log($error) {
	if (strpos($error, 'references should be returned by reference')) return;
	error_log(date('m/d/Y H:i:s') . " $error\n", 3, 'logs/macupdate-add.txt');
}

function macupdate_error($error) {
	$message = "There was an error with the following purchase:\n\n$error\n\nmethod: PayPal\n";
	foreach ($_GET as $key => $value) $message .= "$key: $value\n";
	send_message('info@kavasoft.com', "Purchase error", $message);
	macupdate_log($error . ' (sent email)');
}

function get_value($key) {
	return array_key_exists($key, $_POST) ? urldecode($_POST[$key]) : null;	
}

$customers = get_value('customers');
$customers_array = explode("\n", $customers);

$item_name = 'iConquer';
$program = 'iConquer';
$payment_amount = 0;
$language = 'English';
$language_code = 'en';
$version = '';

$subject = macupdate_subject($language_code);

function macupdate_transaction_exists($dbh, $email) {
	$email = $dbh->quote($email);
	$program = $dbh->quote('iConquer');
	$method = $dbh->quote('macupdate');
	
	$sql = "SELECT email FROM licenses WHERE email LIKE $email";
	$sql .= " AND program LIKE $program";
	$sql .= " AND method LIKE $method";
	
	$results = $dbh->getAll($sql);
	return count($results) > 0;
}

$existing = 0;
$emailed = 0;
$failed = 0;

foreach($customers_array as $line) {
	$customer_array = explode(',', $line);
	if (count($customer_array) == 2) {
		$full_name = trim($customer_array[0]);
		$payer_email = trim($customer_array[1]);
	
		set_time_limit(60);
	
		if (macupdate_transaction_exists($dbh, $payer_email)) {
			$existing++;
		} else {
			$txn_id = "MU" . rand(100000, 999999) . rand(100000, 999999);
			// echo("Doesn't exist: $full_name &lt;$payer_email&gt;<br>");

			$message = macupdate_message($full_name, $program, $payer_email, $txn_id, $language_code);
			xpertmail("$full_name <$payer_email>", $subject, $message);

			macupdate_log("Emailed $item_name order for $full_name <$payer_email>.");
			$emailed++;

			$date_paid = date('Y-m-d');
			$result = save_license($dbh, $full_name, $payer_email, $program, null, null,
				$date_paid, $payment_amount, 'MacUpdate', $language, $version, null, $txn_id);
		}
	}
}

echo("Existing: $existing<br>Emailed: $emailed");

?>
</body>
</html>