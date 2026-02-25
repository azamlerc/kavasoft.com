<html><head><title>Mail Test</title></head><body>
<?php

require '../shared.php';

require_once 'XPertMailer.php';

$subject = "Mail test";
$message = "This is a test. Cool.";
$to = "andrew@zamler-carhart.com";
$from = "KavaSoft Store <store@kavasoft.com>";

if (send_message($subject, $message, $from, $to)) {
	echo("<p>Message successfully sent!</p>");
} else {
	echo("<p>Message delivery failed...</p>");
}

/*
set_time_limit(0);

$mail = new XpertMailer(SMTP_RELAY_CLIENT, 'mail.kavasoft.com');

// $mail->auth($from, 'WwcbD4P;', AUTH_DETECT, SSL_TRUE, 465);
$mail->auth($from, 'WwcbD4P;', AUTH_DETECT, SSL_FALSE, 25);

$mail->from($from, 'KavaSoft');

$value = $mail->send($toaddress, $subject, $message);

if ($value) 
	echo 'Sent mail.';
else
	echo 'Didn\'t send.';
*/
?>
</body></title>