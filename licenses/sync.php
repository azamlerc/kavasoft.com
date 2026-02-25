<?php

require 'DB.php';
$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');
$dbh->setFetchMode(DB_FETCHMODE_OBJECT);

$email = $_GET['email'];
$days = $_GET['days'];
$password = $_GET['password'];

if ($email) {
	$results = $dbh->getAll('SELECT name,transaction_id,date_paid,email,email_sent,method,computer_number,language,amount,version,license_key,program FROM licenses WHERE email LIKE ?', array($email));
	$error_message = "Found " . count($results) . (count($results) == 1 ? " license." : " licenses.");
} else if ($days && $password == 'snarky') {
	if ($days > 100) $days = 100;
	$start_date = date('Y-m-d', time() - $days * 86400);
	$results = $dbh->getAll('SELECT name,transaction_id,date_paid,email,email_sent,method,computer_number,language,amount,version,license_key,program FROM licenses WHERE date_paid >= ? OR email_sent >= ?', array($start_date, $start_date));
	$error_message = "Found " . count($results) . (count($results) == 1 ? " license." : " licenses.");
}

function ascii_to_entities($str) {
   $count	= 1;
   $out	= '';
   $temp	= array();
	
   for ($i = 0, $s = strlen($str); $i < $s; $i++) {
	   $ordinal = ord($str[$i]);
	
	   if ($ordinal < 128) {
		   $out .= $str[$i];
	   } else { // if ($ordinal < 224) { // just ignore high characters for now
		   if (count($temp) == 0) {
			   $count = ($ordinal < 224) ? 2 : 3;
		   }
		
		   $temp[] = $ordinal;
		
		   if (count($temp) == $count) {
			   $number = ($count == 3) ? (($temp['0'] % 16) * 4096) + (($temp['1'] % 64) * 64) + ($temp['2'] % 64) : (($temp['0'] % 32) * 64) + ($temp['1'] % 64);

			   $out .= '&#'.$number.';';
			   $count = 1;
			   $temp = array();
		   }
	   }
   }

   return $out;
}

echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">\n");
?><!DOCTYPE plist PUBLIC "-//Apple Computer//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>Message</key>
	<string><?php echo($error_message); ?></string>
	<key>Licenses</key>
<?php
if (count($results)) 
	echo("\t<array>\n");
else
	echo("\t<array/>\n");

if (is_array($results)) {
	foreach ($results as $license) {
		$name = htmlentities(ascii_to_entities($license->name));
		$email = htmlentities(ascii_to_entities($license->email));
		
		echo("\t\t<dict>\n\t\t\t<key>Name</key>\n\t\t\t<string>" . $name . "</string>\n\t\t\t<key>Email</key>\n\t\t\t<string>" . $email . "</string>\n\t\t\t<key>Program</key>\n\t\t\t<string>" . $license->program . "</string>\n\t\t\t<key>Date Paid</key>\n\t\t\t<string>" . $license->date_paid . "</string>\n\t\t\t<key>Computer Number</key>\n\t\t\t<string>" . $license->computer_number . "</string>\n\t\t\t<key>License Key</key>\n\t\t\t<string>" . $license->license_key . "</string>\n\t\t\t<key>Amount</key>\n\t\t\t<string>" . $license->amount . "</string>\n\t\t\t<key>Language</key>\n\t\t\t<string>" . $license->language . "</string>\n\t\t\t<key>Version</key>\n\t\t\t<string>" . $license->version . "</string>\n\t\t\t<key>Transaction ID</key>\n\t\t\t<string>" . $license->transaction_id . "</string>\n\t\t\t<key>Method</key>\n\t\t\t<string>" . $license->method . 
"</string>\n\t\t\t<key>Email Sent</key>\n\t\t\t<string>" . $license->email_sent . 
"</string>\n\t\t</dict>\n");
	}
}
if (count($results)) 
	echo("\t</array>\n");
?></dict>
</plist>