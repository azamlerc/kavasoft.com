<?php

$bits = 32; 
$int_range = pow(2, $bits);
$max_int = pow(2, $bits - 1) - 1;
$min_int = -1 * pow(2, $bits - 1);

$programs = array(
	'Character Converter' => 'Character Converter',
	'Curator' => 'Curator',
	'HyperImage 3' => 'HyperImage 3',
	'HyperImage' => 'HyperImage',
	'iConquer 4' => 'iConquer 4',
	'iConquer' => 'iConquer',
	'iTunes Catalog 2' => 'iTunes Catalog 2',
	'iTunes Catalog' => 'iTunes Catalog',
	'KavaMovies' => 'KavaMovies',
	'KavaTunes 4' => 'KavaTunes 4',
	'KavaTunes' => 'KavaTunes',
	'KavaServices' => 'KavaServices',
	'Shoebox Express 2' => 'Shoebox Express 2',
	'Shoebox Express' => 'Shoebox Express',
	'Shoebox Pro 2' => 'Shoebox Pro 2',
	'Shoebox Pro' => 'Shoebox Pro',
	'Translation Service' => 'Translation Service',
);

$keys = array(
	'iTunes Catalog 2' => array(86, 94, 245),
	'iTunes Catalog' => array(248, 86),
	'Curator' => array(95, 32, 312),
	'iConquer' => array(347, 23),
	'iConquer 4' => array(84, 79, 612, 47),
	'Translation Service' => array(237, 27),
	'Character Converter' => array(129, 33),
	'HyperImage' => array(65, 44, 581),
	'HyperImage 3' => array(42, 91, 340, 17),
	'Shoebox Express 2' => array(68, 77, 179),
	'Shoebox Express' => array(952, 71),
	'Shoebox Pro 2' => array(98, 42, 854),
	'Shoebox Pro' => array(1025, 81),
	'KavaTunes' => array(86, 94, 245),
	'KavaTunes 4' => array(74, 112, 63),
	'KavaMovies' => array(96, 237, 144),
	'KavaServices' => array(95, 43, 62),
);

$allowable_discount = 0.60;

$minimum_prices = array(
	'KavaTunes' => 35.00,
	'KavaTunes 4' => 35.00,
	'KavaMovies' => 25.00,
	'KavaServices' => 20.00,
	'iTunes Catalog 2' => 24.99,
	'iTunes Catalog' => 9.99,
	'Curator' => 17.99,
	'iConquer' => 12.99,
	'iConquer 4' => 35.00,
	'Translation Service' => 4.99,
	'Character Converter' => 4.99,
	'Shoebox Express' => 29.99,
	'Shoebox Pro' => 79.99,
	'HyperImage' => 25.00,
	'HyperImage 3' => 25.00,
);

$upgrade_prices = array(
	'iTunes Catalog 2' => 9.99,
	'KavaTunes 4' => 10.00,
	'KavaTunes' => 15.00,
	'Shoebox Pro' => 40.00,
	'KavaServices' => 10.00,
	'HyperImage 3' => 10.00,
	'iConquer 4' => 15.00,
);

$allowed_upgrades = array(
	'HyperImage 3' => array('HyperImage'),
	'iConquer 4' => array('iConquer'),
	'KavaTunes 4' => array('KavaTunes', 'iTunes Catalog 2', 'iTunes Catalog'),
	'KavaTunes' => 'iTunes Catalog',
	'iTunes Catalog 2' => 'iTunes Catalog',
	'Shoebox Pro' => 'Shoebox Express',
	'KavaServices' => array('Translation Service', 'Character Converter'),
);

$languages = array(
	'en' => 'English',
	'fr' => 'Francais',
	'de' => 'Deutsch',
	'ja' => 'Japanese',
	'it' => 'Italiano',
	'nl' => 'Nederlands',
);

function valid_computer_number($computer_number) {
	if ($computer_number == null) return false;
	if ($computer_number == '0000-0000-0000-0000') return false;
	if ($computer_number == '1234-5678-1234-5678') return false;
	if (strlen($computer_number) != 19) return false;
	return preg_match('/[0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]/', $computer_number);
}

function wrap_integer($number) {
	
	while ($number > $GLOBALS['max_int']) {
		$number -= $GLOBALS['int_range'];
	}

	while ($number < $GLOBALS['min_int']) {
		$number += $GLOBALS['int_range'];
	}

	return $number;
}

function classic_hash($contents) {
	$length = strlen($contents);
	$result = $length;
	
    if ($length <= 16) {
    	$count = 0;
    	while ($count < $length) {
    		$result = wrap_integer($result * 257 + ord($contents[$count]));
    		$count++;
    	}
    } else {
    	$count = 0;
    	while ($count < 8) {
    		$result = wrap_integer($result * 257 + ord($contents[$count]));
    		$count++;
    	}

    	$count = $length - 8;
    	while ($count < $length) {
    		$result = wrap_integer($result * 257 + ord($contents[$count]));
    		$count++;
    	}
    }

	$result += $result * pow(2, ($length % 32));
	$result = wrap_integer($result);

	return $result;
}

function license_key($computer_number, $program) {
	if (!$program) return NULL;
	if (strlen($computer_number) != 19) return NULL;
	if ($computer_number == '1234-5678-1234-5678') return NULL;
	
	$keys = $GLOBALS['keys'][$program];
	$key_one = $keys[0];
	$key_two = $keys[1];
	$key_three = count($keys) > 2 ? $keys[2] : null;
	$key_four = count($keys) > 3 ? $keys[3] : null;
	
	$license_key = '';

	if ($key_four) {
		$cypher = MD5($computer_number . $key_three . 'NGmA');

		$counter = $key_one;

		for ($i = 0; $i < 16; $i++) {
			$letter_one = ord($cypher[2 * $i]);
			$letter_two = ord($cypher[31 - (2 * $i)]);

			$counter = wrap_integer(($counter + $letter_one - $key_four) * 372 + $key_two);

			$license_key .= chr((abs($counter + $letter_two + $i) % 26) + ord('A'));
			if ($i == 3 || $i == 7 || $i == 11) $license_key .= '-';
		}
	} else if ($key_three) {
			$cypher = MD5($computer_number . $key_three . 'WlJ!');

			$counter = $key_one;

			for ($i = 0; $i < 16; $i++) {
				$letter_one = ord($cypher[2 * $i]);
				$letter_two = ord($cypher[31 - (2 * $i)]);

				$counter = wrap_integer(($counter + $letter_one) * 257 + $key_two);

				$license_key .= chr((abs($counter + $letter_two + $i) % 26) + ord('A'));
				if ($i == 3 || $i == 7 || $i == 11) $license_key .= '-';
			}
	} else {
		$hash = classic_hash($computer_number) + $key_one;
		
		for ($i = 0; $i < 16; $i++) {
			$license_key .= chr(((abs($hash) / ($i + $key_two)) % 26) + ord('A'));
			if ($i == 3 || $i == 7 || $i == 11) $license_key .= '-';
		}
	
	}
	
	return $license_key;
}

function subject($program, $language) {
	include('../licenses/messages/' . $language . '.php');
	return sprintf($subject, $program);
}


function message($name, $computer_number, $program, $language) {
	$names = explode(' ', $name);
	$first_name = $names[0];
	$license_key = license_key($computer_number, $program);
	if (!$license_key) return NULL;
	$short_program = $program;
	if (strpos($program, 'Shoebox') === 0) $short_program = 'Shoebox';

	include('../licenses/messages/' . $language . '.php');

	$extra = array_key_exists($program, $extras) ? $extras[$program] : '';
	
	return sprintf($message_text, $first_name, $program, $license_key, $short_program, $short_program, $extra);
}

function no_computer_number_subject($language) {
	include('../licenses/messages/' . $language . '.php');
	return $no_computer_number_subject;
}


function no_computer_number_message($name, $program, $email, $transaction_id, $language) {
	$names = explode(' ', $name);
	$first_name = $names[0];
	$short_program = $program;
	if (strpos($program, 'Shoebox') === 0) $short_program = 'Shoebox';

	include('../licenses/messages/' . $language . '.php');

	return sprintf($no_computer_number_message, $first_name, $program, 
		$short_program, $short_program, $email, $transaction_id);
}

function macupdate_subject($language) {
	include('../licenses/messages/' . $language . '.php');
	return $macupdate_subject;
}


function macupdate_message($name, $program, $email, $language) {
	$names = explode(' ', $name);
	$first_name = $names[0];
	$short_program = $program;

	include('../licenses/messages/' . $language . '.php');

	return sprintf($macupdate_message, $first_name, $program, 
		$short_program, $short_program, $email);
}

function maczot_subject($language) {
	include('../licenses/messages/' . $language . '.php');
	return $maczot_subject;
}


function maczot_message($name, $program, $email, $language) {
	$names = explode(' ', $name);
	$first_name = $names[0];
	$short_program = $program;

	include('../licenses/messages/' . $language . '.php');

	return sprintf($maczot_message, $first_name, $program, 
		$short_program, $short_program, $email);
}

function macbundlebox_subject($language) {
	include('../licenses/messages/' . $language . '.php');
	return $macbundlebox_subject;
}


function macbundlebox_message($name, $program, $email, $language) {
	$names = explode(' ', $name);
	$first_name = $names[0];
	$short_program = $program;

	include('../licenses/messages/' . $language . '.php');

	return sprintf($macbundlebox_message, $first_name, $program, 
		$short_program, $short_program, $email);
}

function macfriendly_subject($language) {
	include('../licenses/messages/' . $language . '.php');
	return $macfriendly_subject;
}


function macfriendly_message($name, $program, $email, $language) {
	$names = explode(' ', $name);
	$first_name = $names[0];
	$short_program = $program;
	if (strpos($program, ' ') > 0)
		$short_program = substr($program, 0, strpos($program, ' '));

	include('../licenses/messages/' . $language . '.php');

	return sprintf($macfriendly_message, $first_name, $program, 
		$short_program, $short_program, $email);
}

function macbundlepro_subject($language) {
	include('../licenses/messages/' . $language . '.php');
	return $macbundlepro_subject;
}


function macbundlepro_message($name, $program, $email, $language) {
	$names = explode(' ', $name);
	$first_name = $names[0];
	$short_program = $program;
	if (strpos($program, ' ') > 0)
		$short_program = substr($program, 0, strpos($program, ' '));

	include('../licenses/messages/' . $language . '.php');

	return sprintf($macbundlepro_message, $first_name, $program, 
		$short_program, $short_program, $email);
}

function macheist_subject($language) {
	include('../licenses/messages/' . $language . '.php');
	return $macheist_subject;
}


function macheist_message($name, $program, $email, $transaction_id, $language) {
	$names = explode(' ', $name);
	$first_name = $names[0];
	$short_program = $program;

	include($_GLOBALS['messages_dir'] . $language . '.php');

	return sprintf($macheist_message, $first_name, $program, 
		$short_program, $short_program, $email, $transaction_id);
}

function send_message($to, $subject, $message, $from = 'KavaSoft <info@kavasoft.com>', $bcc = null) {
	$headers = "From: $from";
	if ($bcc) $headers .= "\r\nBcc: $bcc";
	return mail($to, $subject, $message, $headers);
}

function code_for_langauge($language) {
	foreach($GLOBALS['languages'] as $code => $name) {
		if (strpos($language, $code) !== FALSE) return $code;
	}
	return 'en';
}

function get_program($program) {
	foreach($GLOBALS['programs'] as $code => $name) {
		if (strpos($program, $name) !== FALSE) return $code;
	}
	return null;
}

function get_kagi_program($program) {
	foreach($GLOBALS['programs'] as $code => $name) {
		if (strpos(strtolower($program), str_replace(' ', '_', strtolower($name))) !== FALSE) return $code;
	}
	return null;
}

function pretty_name($name) {
	if (strtolower($name) == $name || strtoupper($name) == $name || TRUE)
		return ucwords(strtolower($name));
	else
		return $name;
}

function save_license($dbh, $name, $email, $program, $computer_number, $license_key, $date_paid, $amount, $method, $language, $version, $email_sent, $transaction_id) {
	$prh = $dbh->prepare('INSERT INTO licenses (name,email,program,computer_number,license_key,date_paid,amount,method,language,version,email_sent,transaction_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
	$sth = $dbh->execute($prh, array($name, $email, $program, $computer_number, $license_key, $date_paid, $amount, $method, $language, $version, $email_sent, $transaction_id));
	return $dbh->affectedRows() == 1;
}

function transaction_id_exists($dbh, $transaction_id, $program = null) {
	$transaction_id = $dbh->quote($transaction_id);
	if ($program) $program = $dbh->quote($program);
	
	$sql = "SELECT transaction_id FROM licenses WHERE transaction_id LIKE $transaction_id";
	if ($program) $sql .= " AND program LIKE $program";
	
	$results = $dbh->getAll($sql);
	return count($results) > 0;
}

function existing_license_key($dbh, $program, $computer_number) {
	$wildcards = array('_' => '\_', '%' => '\%');
	$program_term = strtr($dbh->quote($program), $wildcards);
	$computer_number_term = strtr($dbh->quote($computer_number), $wildcards);
	
	$sql = "SELECT program,license_key FROM licenses WHERE program LIKE $program_term && computer_number LIKE $computer_number_term";
	
	$results = $dbh->getAll($sql);
	if (count($results) == 0) return null;
	$license = $results[0];
	return $license->license_key;
}

function license_key_exists($dbh, $program, $license_key) {
	$wildcards = array('_' => '\_', '%' => '\%');
	$license_key_term = strtr($dbh->quote($license_key), $wildcards);
	
	if (is_array($program)) {
		if (count($program) == 2) {
			$program0 = strtr($dbh->quote($program[0]), $wildcards);
			$program1 = strtr($dbh->quote($program[1]), $wildcards);
			$program_qualifier = "(program LIKE $program0 OR program LIKE $program1)";
		} else if (count($program) == 3) {
			$program0 = strtr($dbh->quote($program[0]), $wildcards);
			$program1 = strtr($dbh->quote($program[1]), $wildcards);
			$program2 = strtr($dbh->quote($program[2]), $wildcards);
			$program_qualifier = "(program LIKE $program0 OR program LIKE $program1 OR program LIKE $program2)";
		}
	} else {
		$program_term = strtr($dbh->quote($program), $wildcards);
		$program_qualifier = "program LIKE $program_term";
	}
	
	$sql = "SELECT program,license_key FROM licenses WHERE $program_qualifier && license_key LIKE $license_key_term";
	
	$results = $dbh->getAll($sql);
	return count($results) > 0;
}

function can_upgrade_from_key($dbh, $program, $license_key) {
	$wildcards = array('_' => '\_', '%' => '\%');
	$license_key_term = strtr($dbh->quote($license_key), $wildcards);
	
	if (is_array($program)) {
		$program0 = strtr($dbh->quote($program[0]), $wildcards);
		$program1 = strtr($dbh->quote($program[1]), $wildcards);
		$program_qualifier = "(program LIKE $program0 OR program LIKE $program1)";
	} else {
		$program_term = strtr($dbh->quote($program), $wildcards);
		$program_qualifier = "program LIKE $program_term";
	}
	
	$sql = "SELECT program,license_key,upgrade FROM licenses WHERE $program_qualifier && license_key LIKE $license_key_term && upgrade IS NULL";
	
	$results = $dbh->getAll($sql);
	return count($results) > 0;
}

function did_upgrade_from_key($dbh, $license_key) {
	$wildcards = array('_' => '\_', '%' => '\%');
	$license_key_term = strtr($dbh->quote($license_key), $wildcards);
	
	$sql = "UPDATE licenses SET upgrade = 1 WHERE license_key LIKE $license_key_term";
	
	$results = $dbh->query($sql);
}

function disable_key($dbh, $license_key) {
	$wildcards = array('_' => '\_', '%' => '\%');
	$license_key_term = strtr($dbh->quote($license_key), $wildcards);
	
	$sql = "UPDATE licenses SET disabled = 1 WHERE license_key LIKE $license_key_term";
	
	$results = $dbh->query($sql);
}

function count_for_method($dbh, $method, $program = null) {
	$sql = "SELECT method FROM licenses WHERE method LIKE '$method'";
	if ($program) $sql .= " && program LIKE '$program'";
	
	$results = $dbh->getAll($sql);
	return count($results);
}

/*
function file_contains_key($filename, $key) {
	$file = fopen($filename, 'r');
	if ($file === false) return false;
	
	while(!feof($file)) {
		if ($line = fgets($file)) {
			if ($line == $key . "\n") {
				$file = fclose($file);
				return true;
			}
		}
	}

	$file = fclose($file) or die($php_errormsg);
	return false;
}

function file_append_key($filename, $key) {
	$file = fopen($filename, 'a+');

	fwrite($file, $key . "\n");

	$file = fclose($file);
}
*/

?>