<?php

function validate($user, $pass) {
	return $user == 'kavasoft' && MD5($pass) == '8f393ce17cf4d13486b2d710caed555c';
}

if (!validate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
	header('WWW-Authenticate: Basic realm="System"');
	header('HTTP/1.0 401 Unauthorized');
	echo("Please enter a name and password.");
	exit();
}

?><html>
<head>
	<title>License Manager</title>
	<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body><form action="test.php" method="post">
<?php

include('licenses.php');
include('layout.php');

function popup($name, $values, $selected) {
	$popup = "<select name=\"$name\">\n";
	
	foreach($values as $value => $text) {
		$sel = ($selected == $value) ? ' selected' : '';
		$popup .= "\t\t<option$sel value=\"$value\">$text</option>\n";
	}
	
	$popup .= "</select>";
	return $popup;
}
 
$name = array_key_exists('name', $_POST) ? $_POST['name'] : null;
$email = array_key_exists('email', $_POST) ? $_POST['email'] : null;
$program = array_key_exists('program', $_POST) ? $_POST['program'] : null;
$computer_number = array_key_exists('computer_number', $_POST) ? $_POST['computer_number'] : null;
$date_paid = array_key_exists('date_paid', $_POST) ? $_POST['date_paid'] : null;
$amount = array_key_exists('amount', $_POST) ? $_POST['amount'] : null;
$method = array_key_exists('method', $_POST) ? $_POST['method'] : null;
$language = array_key_exists('language', $_POST) ? $_POST['language'] : null;
$version = array_key_exists('version', $_POST) ? $_POST['version'] : null;
$email_sent = array_key_exists('email_sent', $_POST) ? $_POST['email_sent'] : null;
$transaction_id = array_key_exists('transaction_id', $_POST) ? $_POST['transaction_id'] : null;

echo("<table border=\"0\" cellspacing=\"0\" cellpadding=\"2\">");
echo(tr(array(td('stuff', "Name:"), td('stuff', "<input type=\"text\" name=\"name\" size=\"30\" value=\"$name\">"))));
echo(tr(array(td('stuff', "Email:"), td('stuff', "<input type=\"text\" name=\"email\" size=\"30\" value=\"$email\">"))));
echo(tr(array(td('stuff', "Program:"), td('stuff', popup('program', $programs, $program)))));
echo(tr(array(td('stuff', "Computer number:"), td('stuff', "<input type=\"text\" name=\"computer_number\" size=\"30\" value=\"$computer_number\">"))));
echo(tr(array(td('stuff', "Date paid:"), td('stuff', "<input type=\"text\" name=\"date_paid\" size=\"30\" value=\"$date_paid\">"))));
echo(tr(array(td('stuff', "Amount:"), td('stuff', "<input type=\"text\" name=\"amount\" size=\"30\" value=\"$amount\">"))));
echo(tr(array(td('stuff', "Method:"), td('stuff', "<input type=\"text\" name=\"method\" size=\"30\" value=\"$method\">"))));
echo(tr(array(td('stuff', "Language:"), td('stuff', "<input type=\"text\" name=\"language\" size=\"30\" value=\"$language\">"))));
echo(tr(array(td('stuff', "Version:"), td('stuff', "<input type=\"text\" name=\"version\" size=\"30\" value=\"$version\">"))));
echo(tr(array(td('stuff', "Email sent:"), td('stuff', "<input type=\"text\" name=\"email_sent\" size=\"30\" value=\"$email_sent\">"))));
echo(tr(array(td('stuff', "Transaction ID:"), td('stuff', "<input type=\"text\" name=\"transaction_id\" size=\"30\" value=\"$transaction_id\">"))));
echo("</table>");

if ($name && $email && $program && $computer_number) {
	$license_key = license_key($computer_number, $program);
	
	echo($name . ', ' . $email . ', ' . $program . ', ' . $computer_number . ', ' . $license_key . ', ' . $date_paid . ', ' . $amount . ', ' . $method . ', ' . $language . ', ' . $version . ', ' . $email_sent . ', ' . $transaction_id . "<br><br>");

	$result = save_license($name, $email, $program, $computer_number, $license_key, $date_paid, $amount, $method, $language, $version, $email_sent, $transaction_id);

	if ($result) {
		echo('Saved license.');
	} else {
		echo('Failed to save license.');
	}
}

/*
$first_name = 'Andrew';
$full_name = 'Andrew Zamler-Carhart';
$payer_email = 'andrew@zamler-carhart.com';

$program = 'iConquer';

$language = 'en';
$computer_number = '5368-4402-3780-6581';
$license_key = license_key($computer_number, $program);

$subject = subject($program, $language);
$message = message($full_name, $payer_email, $computer_number, $program, $language);

$headers = 'From: KavaSoft <info@kavasoft.com>' . "\r\n" .
		   'Bcc: info@kavasoft.com';


echo('<pre>');

echo($subject . "\n\n");

echo($message . "\n");

echo('</pre>');

*/

// mail("$full_name <$payer_email>", $subject, $message, $headers);


/*
$key = 'PNVI-MGDE-UWRX-NWQE';

if (file_contains_key('keys/used.txt', $key)) {
	echo("File contains $key!");
} else {
	echo("File doesn't contain $key!");	
}

file_append_key('keys/used.txt', $key);
*/
?>
</form></body></html>