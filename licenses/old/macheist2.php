<html>
<head>
	<title>MacHeist</title>
</head>
<body>
<form action="macheist2.php" method="post">
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
	macheist_log("Error: $error in $file:$line");
}

function macheist_log($error) {
	if (strpos($error, 'references should be returned by reference')) return;
	error_log(date('m/d/Y H:i:s') . " $error\n", 3, 'logs/macheist-add.txt');
}

function macheist_error($error) {
	$message = "There was an error with the following purchase:\n\n$error\n\nmethod: PayPal\n";
	foreach ($_GET as $key => $value) $message .= "$key: $value\n";
	send_message('info@kavasoft.com', "Purchase error", $message);
	macheist_log($error . ' (sent email)');
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

$subject = macheist_subject($language_code);

function macheist_transaction_exists($dbh, $email) {
	$email = $dbh->quote($email);
	$program = $dbh->quote('iConquer');
	$method = $dbh->quote('MacHeist');
	
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
	
		if (macheist_transaction_exists($dbh, $payer_email)) {
			$existing++;
		} else {
			$txn_id = "MH" . rand(100000, 999999) . rand(100000, 999999);
			// echo("Doesn't exist: $full_name &lt;$payer_email&gt;<br>");
			

			$message = macheist_message($full_name, $program, $payer_email, $txn_id, $language_code);
			xpertmail("$full_name <$payer_email>", $subject, $message);

			macheist_log("Emailed $item_name order for $full_name <$payer_email>.");
			$emailed++;

			$date_paid = date('Y-m-d');
			$result = save_license($dbh, $full_name, $payer_email, $program, null, null,
				$date_paid, $payment_amount, 'MacHeist', $language, $version, null, $txn_id);
		}
	}
}

echo("Existing: $existing<br>Emailed: $emailed");

?>
</body>
</html>