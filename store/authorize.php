<?php

require 'DB.php';
$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');
$dbh->setFetchMode(DB_FETCHMODE_OBJECT);

$computer_number = $_GET['computer_number'];
$license_key = $_GET['license_key'];
$program = $_GET['program'];

$error_message = NULL;

if (strlen($license_key) == 19) {
	$license_key_lookup = true;
} else if (strlen($computer_number) == 19) {
	$computer_number_lookup = true;
} else {
	$error_message = "Did not get a valid computer number or license key.";
}

$fp = fopen("../licenses/keys/private.key","r"); 
$priv_key = fread($fp,8192); 
fclose($fp);
$priv_key_res = openssl_get_privatekey($priv_key); 

$fields = "name,computer_number,license_key,program,upgrade,disabled";
if ($computer_number_lookup) {
	$results = $dbh->getAll("SELECT $fields FROM licenses WHERE computer_number LIKE ?", array($computer_number));
	$error_message = "Found " . count($results) . (count($results) == 1 ? " license." : " licenses.");
} else	if ($license_key_lookup) {
	$results = $dbh->getAll("SELECT $fields FROM licenses WHERE license_key LIKE ?", array($license_key));
	$error_message = "Found " . count($results) . (count($results) == 1 ? " license." : " licenses.");
}
 
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">\n");
?><!DOCTYPE plist PUBLIC "-//Apple Computer//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
<?php

if ($computer_number_lookup) echo("\t<key>Computer Number</key>\n\t<string>$computer_number</string>\n");
if ($license_key_lookup) echo("\t<key>License Key</key>\n\t<string>$license_key</string>\n");
echo("\t<key>Message</key>\n\t<string>$error_message</string>\n");
echo("\t<key>Licenses</key>\n");

function asciify($string) {
	$length = strlen($string);
	$output = '';
	
	for ($i = 0; $i < $length; $i++) {
		$c = $string[$i];
		$n = ord($c);
		
		if ($n > 127) {

			if (192 <= $n && $n <= 197) $c = 'A';
			else if (198 == $n) $c = 'AE';
			else if (199 == $n) $c = 'C';
			else if (200 <= $n && $n <= 203) $c = 'E';
			else if (204 <= $n && $n <= 207) $c = 'I';
			else if (208 == $n) $c = 'D';
			else if (209 == $n) $c = 'N';
			else if (210 <= $n && $n <= 214) $c = 'O';
			else if (216 == $n) $c = 'O';
			else if (217 <= $n && $n <= 220) $c = 'U';
			else if (221 == $n) $c = 'Y';
			else if (222 == $n) $c = 'Th';
			else if (223 == $n) $c = 'ss';
			
			else if (224 <= $n && $n <= 229) $c = 'a';
			else if (230 == $n) $c = 'ae';
			else if (231 == $n) $c = 'c';
			else if (232 <= $n && $n <= 235) $c = 'e';
			else if (236 <= $n && $n <= 239) $c = 'i';
			else if (240 == $n) $c = 'd';
			else if (241 == $n) $c = 'n';
			else if (242 <= $n && $n <= 246) $c = 'o';
			else if (248 == $n) $c = 'o';
			else if (249 <= $n && $n <= 252) $c = 'u';
			else if (253 == $n) $c = 'y';
			else if (254 == $n) $c = 'th';
			else if (255 == $n) $c = 'y';

			else $c = '?';
		}
		
		$output .= $c;
	}
	
	return $output;
}

if (count($results)) 
	echo("\t<array>\n");
else
	echo("\t<array/>\n");
	
if (is_array($results)) {
	foreach ($results as $license) {
		$plaintext = $license->computer_number . '|' . $license->license_key;
		openssl_private_encrypt($plaintext, $thumbprint, $priv_key_res);
		$hexprint = bin2hex($thumbprint);

		echo("\t\t<dict>\n");
		echo("\t\t\t<key>Name</key>\n\t\t\t<string>" . asciify($license->name) . "</string>\n");
		echo("\t\t\t<key>Program</key>\n\t\t\t<string>" . $license->program . "</string>\n");
		echo("\t\t\t<key>Computer Number</key>\n\t\t\t<string>" . $license->computer_number . "</string>\n");
		echo("\t\t\t<key>License Key</key>\n\t\t\t<string>" . $license->license_key . "</string>\n");
		echo("\t\t\t<key>Thumbprint</key>\n\t\t\t<string>" . $hexprint . "</string>\n");
		if ($license->disabled) echo("\t\t\t<key>Disabled</key>\n\t\t\t<true/>\n");
		if ($license->upgrade) echo("\t\t\t<key>Upgrade</key>\n\t\t\t<true/>\n");
		echo("\t\t</dict>\n");
	}
}
if (count($results)) 
	echo("\t</array>\n");

/*		
	// how to public decrypt data
	$fp = fopen("../licenses/keys/public.key","r"); 
	$pub_key = fread($fp,8192); 
	fclose($fp);
	$pub_key_res = openssl_get_publickey($pub_key); 
	$data = pack('H*', $thumbprint);
	openssl_public_decrypt($data, $decrypt, $pub_key_res);
*/		

?></dict>
</plist>
