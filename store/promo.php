<?php 

$page_name = 'store';
$doc_root = '../Shoebox/';

include('../shared.php');
include('../products.php'); 
include('../licenses/licenses.php'); 

$name = trim(get_value('name'));
$email = trim(get_value('email'));
$program = get_value('program');
$computernumber = get_value('computernumber');
$coupon = get_value('coupon');
if ($coupon) $coupon = strtoupper($coupon);
$submit = get_value('submit');

$args = array();

$got_info = $name && $email && $program && $computernumber && $coupon;
$method = 'Promo';

$valid_coupon = false;
if ($program == 'KavaMovies' && $coupon == 'KM11MACDEV3724') {
	$method = 'MacDeveloper';
	$version = '1.1';
	$valid_coupon = true;
} else if ($program == 'HyperImage' && $coupon == 'HI15MACDEV6429') {
	$method = 'MacDeveloper';
	$version = '1.5';
	$valid_coupon = true;
} else if ($coupon == 'PRESSEVAL') {
	$method = 'Press';
	$valid_coupon = true;
} else if ($coupon == 'COMUG') {
	$method = 'CoMUG';
	$valid_coupon = true;
}

$valid_computernumber = valid_computer_number($computernumber) || $computernumber == '--';

$results = array();
$got_results = false;

$error = null;

$short_program = $program;
if ($program == 'Shoebox Pro' || $program == 'Shoebox Express') $short_program = 'Shoebox';
$window_name = $program ? "Buy $short_program" : 'Buy&hellip;';
$the_program = $program ? $short_program : 'the program';

function handle_error($errno, $error, $file, $line) {
	promo_log("Error: $error in $file:$line");
}

function promo_log($error) {
	if (strpos($error, 'references should be returned by reference')) return;
	error_log(date('m/d/Y H:i:s') . " $error\n", 3, '../licenses/logs/promo.txt');
}

function promo_error($error) {
	$message = "There was an error with the following purchase:\n\n$error\n\nmethod: PayPal\n";
	foreach ($_GET as $key => $value) $message .= "$key: $value\n";
	send_message('info@kavasoft.com', "Purchase error", $message);
	promo_log($error . ' (sent email)');
}

if ($got_info && $valid_coupon && $valid_computernumber) {
	require 'DB.php';
	$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');
	$dbh->setFetchMode(DB_FETCHMODE_OBJECT);

	set_time_limit(60);

	$txn_id = $coupon . rand(100000, 999999);

	$language_code = 'en';
	$subject = subject($program, $language_code);
	$message = message($name, $computernumber, $program, $language_code);
	$from = 'KavaSoft Store <store@kavasoft.com>';
	$bcc = 'store@kavasoft.com';
	
	if ($computernumber = '--') {
		$computernumber = null;
		$licensekey = null;
	} else {
		$licensekey = license_key($computernumber, $program);
		send_message("$name <$email>", $subject, $message, $from, $bcc);
		promo_log("Emailed $program order for $name <$email>.");
		$emailed++;
	}
	$date_paid = date('Y-m-d');
	$result = save_license($dbh, $name, $email, $program, $computernumber, $licensekey,
		$date_paid, $payment_amount, $method, 'English', $version, null, $txn_id);

	header("Location: orders.php?email=$email");
	exit;
}

head('KavaSoft - Store - Free License', $folder);

// echo($sql);
	
table_single_1();

echo(spacer_img(10, 10) . $br);
echo(span('mainheader', 'KavaSoft ') . span('grayheader', 'Store') . $br);
echo(spacer_img(10, 20) . $br);

echo("</td><tr /><tr><td width=\"300\" align=\"left\"valign=\"top\">");

questions_box(array('store', 'orders', 'service', 'contact'));

table_2();

if ($error && strpos($error, '<font') !== false) $error .= "$br$br" . hyperlink($email_address . "?subject=$program%20Customer%20Service%20($computernumber/$licensekey)", "Click here to email customer service.", 'text_link');

box('text', 'Free License', $error ? $error : 'You can use this form to get a free license key, with our compliments.');

echo('<form name="storeform" method="get" action="promo.php">');

function all_programs($keys) {
	echo('<table class="box" width="600" border="0" cellpadding="0" cellspacing="0"><tr>');

	global $program;
	global $products;
	global $br;
	
	$icon_size = 108;

	foreach($keys as $i => $key) {
		$product = $products[$key];
		$name = $product['name'];
		$icon = $product['icon'];
		$slogan = $product['slogan'];
		$version = $product['version'];
		$price = $product['price'];
		
		echo('<td width="25%" class="sidebar" align="center" valign="top">');
		echo(hyperlink("../$icon/", img("/images/apps/$icon-128.png", 
			$name, $icon_size, $icon_size)));
		echo($br . hyperlink("../$icon/", $name, 'otherapps'));
		if (!$program || $program == 'Shoebox') $program = 'Shoebox Pro'; 
		$checked = ($program == $name) ? ' checked' : '';
		$radio_button = "<input type=\"radio\" value=\"$name\" name=\"program\"$checked>";
		echo($br . "$radio_button");
		echo('</td>');
		
		if ($key == 'kavamovies') 
			echo('</tr><tr><td height="20">' . spacer_img(15, 3) . '</td></tr><tr>');
	}

	echo('</tr></table>');
}

echo(div("$class box_header", 'Application'));
all_programs(array('shoebox_pro', 'shoebox_express', 'kavatunes', 'kavamovies', 
				   'iconquer', 'hyperimage', 'curator', 'kavaservices'));
echo(spacer_img(25, 25));

function order_row($label, $name, $value, $width, $maxwidth, $example) {
	return tr(array(td('features', "$label:&nbsp;&nbsp;&nbsp;", 130), 
		td('features', text_field($name, $value, $width, $maxwidth) . 
		gray("&nbsp;&nbsp;&nbsp; ($example)"))));
}

$personal_info_table = '<table border="0">';
$personal_info_table .= order_row('Full name', 'name', $name, 30, 255, 'Joe Smith');
$personal_info_table .= order_row('Email address', 'email', $email, 30, 255, 'joe@smith.com');
$personal_info_table .= '</table>';

$personal_info_text = "Please enter your full name and email address.";
if ($submit && !($name && $email)) $personal_info_text = red($personal_info_text);  
box('text', 'Personal Information', "$personal_info_text$br$br$personal_info_table");

$computer_number_img = img('images/buy_window.png', 'Buy Window', 356, 142);
$computernumber_value = $computernumber ? " value=\"$computernumber\"" : '';
$computer_number_text = 'Please locate your computer number.';

if ($submit && (!$computernumber || !$valid_computernumber)) $computer_number_text = red($computer_number_text);
box('text', 'Computer Number', "$computer_number_text Download and launch $the_program. Choose &ldquo;$window_name&rdquo; from the application menu, and you'll see a window like this:  $br <center> $computer_number_img $br </center> Copy your computer number, and paste it here:&nbsp;&nbsp;&nbsp;<input type=\"text\"$computernumber_value name=\"computernumber\" size=\"19\" maxlength=\"19\">
");

$coupon_text = 'Please enter your coupon code here:';
if ($submit && (!$coupon || !$valid_coupon)) $coupon_text = red($coupon_text);
$coupon_value = $coupon ? " value=\"$coupon\"" : '';
box('text', 'Coupon Code', "$coupon_text&nbsp;&nbsp;&nbsp;<input type=\"text\"$coupon_value name=\"coupon\" size=\"19\" maxlength=\"255\">");

$buy_button = '<input type="submit" name="submit" value="&nbsp;&nbsp;&nbsp;Get License&nbsp;&nbsp;&nbsp;">';

echo(div("text box_header", 'Get License'));
echo(div("text box", center($buy_button)));

echo('</form>');

table_3();

footer();

?>