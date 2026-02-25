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

?>

<html>
<head>
	<title>License Manager</title>
	<link rel="stylesheet" type="text/css" href="../styles.css" />
</head>
<body>

<?php

echo('<h2>License Manager</h2>');
include('licenses.php');
include('../shared.php');

$name = array_key_exists('name', $_POST) ? $_POST['name'] : null;
$email = array_key_exists('email', $_POST) ? $_POST['email'] : null;
$computer_number = array_key_exists('computer_number', $_POST) ? $_POST['computer_number'] : null;
$program = array_key_exists('program', $_POST) ? $_POST['program'] : null;
$language = array_key_exists('language', $_POST) ? $_POST['language'] : null;
$purchase_email = array_key_exists('purchase_email', $_POST) ? $_POST['purchase_email'] : null;
/*
function popup_menu($name, $values, $selected) {
	$popup = "<select name=\"$name\">\n";
	
	foreach($values as $value => $text) {
		$sel = ($selected == $value) ? ' selected' : '';
		$popup .= "\t\t<option$sel value=\"$value\">$text</option>\n";
	}
	
	$popup .= "</select>";
	return $popup;
}
*/
function message_value($purchase_email, $key) {
	$start = strpos($purchase_email, $key);
	if ($start === FALSE) return NULL;
	$start += strlen($key);
	$end = strpos($purchase_email, "\n", $start);
	if ($end === FALSE) return NULL;
	return substr($purchase_email, $start, $end - $start);
}

function parse_email($purchase_email) {
	if (strpos($purchase_email, "Dear KavaSoft") !== FALSE) {
		$name = message_value($purchase_email, 'Buyer: ');
		if ($name) $GLOBALS['name'] = pretty_name(trim($name));
		
		$email = message_value($purchase_email, '(');
		$parenthesis = strpos($email, ')');
		$email = substr($email, 0, $parenthesis);
		if ($email) $GLOBALS['email'] = trim($email);
		
		$computer_number = message_value($purchase_email, 'Computer number: ');
		if (!$computer_number) $computer_number = message_value($purchase_email, 'Computer Number: ');
		if (!$computer_number) $computer_number = message_value($purchase_email, 'Registration code: ');
		$slash = strpos($email, '/');
		if ($slash) $email = sbstr($email, 0, $slash);
		if ($computer_number) $GLOBALS['computer_number'] = trim($computer_number);

		$language = message_value($purchase_email, 'Language: ');
		$comma = strpos($computer_number, ',');
		if ($comma) $code_for_langauge = sbstr($code_for_langauge, 0, $comma);
		$GLOBALS['language'] = code_for_langauge($language);
		
		$program = trim(message_value($purchase_email, 'Item/Product Name: '));
		$GLOBALS['program'] = get_program($program);
	} else if (strpos($purchase_email, "Payment fee received") !== FALSE) {
		$name = message_value($purchase_email, 'Registered-To: ');
		if ($name) $GLOBALS['name'] = pretty_name(trim($name));
		
		$email = message_value($purchase_email, 'Email: ');
		if ($email) $GLOBALS['email'] = trim($email);
		
		$computer_number = message_value($purchase_email, 'Computer-number: ');
		if (!$computer_number) $computer_number = message_value($purchase_email, 'Registration-Code: ');
		if ($computer_number) $GLOBALS['computer_number'] = trim($computer_number);

		$language = message_value($purchase_email, 'via KOOP ');
		$GLOBALS['language'] = code_for_language($language);
		
		$program = trim(message_value($purchase_email, 'Payment for '));
		$GLOBALS['program'] = get_kagi_program($program);
	}
}

parse_email($purchase_email);

if (array_key_exists('preview', $_POST)) {
	$subject = subject($program, $language);
	$message = message($name, $computer_number, $program, $language);
} else if (array_key_exists('mail', $_POST)) {
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$from = 'KavaSoft Store <store@kavasoft.com>';
	$bcc = 'store@kavasoft.com';

	str_replace("\\\"", "\"", $message);

	if (send_message("$name <$email>", $subject, $message, $from, $bcc))
		$status = "Message sent to $email.";
	else
		$status = "Message not sent.";
}

echo("<center>");
echo("<form action=\"manager.php\" method=\"post\">");

echo("<table border=\"0\" cellspacing=\"0\" cellpadding=\"2\">");
echo(tr(array(td('stuff', 'name', NULL, NULL, NULL, NULL, 'align="right"'),
	td('stuff', "<input type=\"text\" name=\"name\" size=\"20\" value=\"$name\">"),
	td('stuff', '&nbsp;&nbsp;&nbsp;payment email', NULL, NULL, NULL, NULL, 'align="right"'),
	td('stuff', "<textarea name=\"purchase_email\" rows=\"9\" cols=\"18\"></textarea>", NULL, NULL, NULL, 5, 'valign="top"'),)));
echo(tr(array(td('stuff', 'email', NULL, NULL, NULL, NULL, 'align="right"'),
	td('stuff', "<input type=\"text\" name=\"email\" size=\"20\" value=\"$email\">"),
	td('stuff', '', NULL, NULL, NULL, 4, 'align="right"'))));
echo(tr(array(td('stuff', 'computer number', NULL, NULL, NULL, NULL, 'align="right"'),
	td('stuff', "<input type=\"text\" name=\"computer_number\" size=\"20\" maxlength=\"19\"  value=\"$computer_number\">"))));
echo(tr(array(td('stuff', 'program', NULL, NULL, NULL, NULL, 'align="right"'),
	td('stuff', popup_menu('program', $programs, $program)))));
echo(tr(array(td('stuff', 'language', NULL, NULL, NULL, NULL, 'align="right"'),
	td('stuff', popup_menu('language', $languages, $language)))));
		
	$buttons = "<input type=\"submit\" name=\"preview\" value=\"Preview\">";
	if (isset($message)) $buttons .= "&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"mail\" value=\"Send\">";
	
echo(tr(array(td('stuff', $buttons, NULL, NULL, 4, NULL, 'align="center"'))));
	
if (isset($status)) 
	echo(tr(array(td('stuff', "<i>$status</i>", NULL, NULL, 4, NULL, 'align="center"'))));


if (isset($message)) {
	echo(tr(array(td('stuff', 'subject', NULL, NULL, NULL, NULL, 'align="right"'),
		td('stuff', "<input type=\"text\" name=\"subject\" size=\"70\" value=\"$subject\">", NULL, NULL, 3))));
	echo(tr(array(td('stuff', 'message', NULL, NULL, NULL, NULL, 'align="right" valign="top"'),
		td('stuff', "<textarea name=\"message\" rows=\"20\" cols=\"68\">" . $message . "</textarea>", NULL, NULL, 3))));
}

echo("</table>");
echo('</form>');

echo("<p class=\"footer\" align=center>&copy; 2002-2010 KavaSoft.<BR>All rights reserved.<BR>Unauthorized use prohibited.</p>");
echo("</center>");

?>

</body>
</html>
