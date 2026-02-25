<?php 

$page_name = 'store';
$doc_root = '../Shoebox/';

include('../shared.php');
include('../products.php'); 

$name = get_value('name');
$email = get_value('email');
$program = get_value('program');
$computernumber = get_value('computernumber');
$licensekey = get_value('licensekey');
$purchase = get_value('purchase');
$transfer = get_value('transfer');
$submit = $purchase || $transfer;

$args = array();

$got_info = $name && $email && $program && $computernumber && $licensekey;

$results = array();
$got_results = false;

$error = null;

$short_program = $program;
if ($program == 'Shoebox Pro' || $program == 'Shoebox Express') $short_program = 'Shoebox';
$window_name = $program ? "Buy $short_program" : 'Buy&hellip;';
$the_program = $program ? $short_program : 'the program';

if ($program && $purchase) {
	$total_price = 0;

	$args['cmd'] = "_xclick";
	$args['business'] = "info@kavasoft.com";
	$args['no_shipping'] = "1";
	$args['cn'] = "Notes";
	$args['on0'] = "Computer+number";
	$args['os0'] = "$computernumber/$licensekey";
	$args['on1'] = "Name";
	$args['os1'] = "$name, Email: $email";

	foreach ($products as $product_key => $feature) {
		if ($feature['name'] == $program) {
			$price = sprintf("%.2f", $feature['price'] * 0.50);
			$icon = $feature['icon'];
			$product_encoded = urlencode($feature['paypal_name']);
			$args['item_name'] = "$product_encoded additional license";
			$args['quantity'] = $quantity;
			$args['amount'] = '$' . $price;
			$args['image_url'] = "http://www.kavasoft.com/images/paypal/$icon.jpg";
			$args['return'] = "http://www.kavasoft.com/store/thanks.php/$product_encoded/$computernumber";
			
			break;
		}
	}

	if ($price > 0) {
		$action_url = 'https://www.paypal.com/cgi-bin/webscr';
		$redirect_path = path_with_args($action_url, $args);
		header("Location: $redirect_path");
		exit;
	}
} else if ($got_info && $transfer) {
	require 'DB.php';
	$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');
	$dbh->setFetchMode(DB_FETCHMODE_OBJECT);

	$wildcards = array('_' => '\_', '%' => '\%');

	$sql = 'SELECT computer_number,license_key,program,amount,date_paid,method,upgrade FROM licenses WHERE ';
	$terms = array();
	
	if ($name && $email) $terms[] = '(name LIKE ' . strtr($dbh->quote($name), $wildcards) .
		' OR email LIKE ' . strtr($dbh->quote($email), $wildcards) . ')';
	
	$terms[] = '(license_key LIKE ' . strtr($dbh->quote($licensekey), $wildcards) .
		' OR computer_number LIKE ' . strtr($dbh->quote($computernumber), $wildcards) . ')';
	
	if ($program == 'iTunes Catalog 2' || $program == 'KavaTunes')
		$terms[] = "(program LIKE 'iTunes Catalog 2' OR program LIKE 'KavaTunes')";
	else 
		$terms[] = 'program LIKE ' . strtr($dbh->quote($program), $wildcards);
		
	$sql .= join(' AND ', $terms);
	$results = $dbh->getAll($sql, $values);
	$got_results = count($results) > 0;
	
	if ($got_results) {
		foreach ($results as $license) {
			if ($license->license_key == $licensekey)
			 	if (!$old_license || $old_license->upgrade == 1 || $old_license->amount == 0)
					$old_license = $license;
		}
		
		if ($old_license) {
			foreach ($results as $license) {
				if ($license->computer_number == $computernumber)
				 	$new_license = $license;
			}
			
			if (!$new_license) {
				if ($old_license->upgrade != 1) {
					if ($old_license->amount > 0) {
						include('../licenses/licenses.php');
						
						$new_license_key = license_key($computernumber, $program);
						$subject = subject($program, 'en') . ' (Transfer)';
						$message = message($name, $computernumber, $program, 'en');
						$from = 'KavaSoft Store <store@kavasoft.com>';
						$bcc = 'store@kavasoft.com';

						$date_paid = date('Y-m-d');
						$email_sent = $date_paid;

						$result = save_license($dbh, $name, $email, $program, $computernumber, $new_license_key,
							$date_paid, 0, 'Resend', 'English', null, $email_sent, null);
						
						did_upgrade_from_key($dbh, $previous_license);
						disable_key($dbh, $previous_license);
						
						send_message("$name <$email>", $subject, $message, $from, $bcc);

						header("Location: orders.php?name=$name&email=$email&computernumber=$computernumber");
							
						// service_log("Resent $program license to $name <$email>.");
						
						exit;
					} else {
						$error = red("You can only transfer an original, full-price license using this form.");	
					}
				} else {
					$error = red("That license has already been transferred to a different computer.");
				}
			} else {
				// found existing license for that computer number
				header("Location: orders.php?name=$name&email=$email&computernumber=$computernumber");
				exit;
			}
		} else {
			$error = red("Sorry, no license with that license key could be found.");
		}
	} else {
		$error = red("Sorry, your previous license could not be found.");
	}
}

head('KavaSoft - Store - Customer Service', $folder);

// echo($sql);
	
table_single_1();

echo(spacer_img(10, 10) . $br);
echo(span('mainheader', 'KavaSoft ') . span('grayheader', 'Store') . $br);
echo(spacer_img(10, 20) . $br);

echo("</td><tr /><tr><td width=\"300\" align=\"left\"valign=\"top\">");

box('sidebar', 'Upgrades', hyperlink('upgrade.php?product=shoebox_pro_upgrade', 'Shoebox Express to Shoebox Pro', 'sidebar_link') . $br .
	hyperlink('upgrade.php?product=kavatunes_upgrade', 'iTunes Catalog 1.x to KavaTunes', 'sidebar_link') . $br .
	hyperlink('upgrade.php?product=kavaservices_cc_upgrade', 'Character Converter to KavaServices', 'sidebar_link') . $br .
	hyperlink('upgrade.php?product=kavaservices_ts_upgrade', 'Translation Service to KavaServices', 'sidebar_link'));

questions_box(array('store', 'orders', 'contact'));

table_2();

if ($error && strpos($error, '<font') !== false) $error .= "$br$br" . hyperlink($email_address . "?subject=$program%20Customer%20Service%20($computernumber/$licensekey)", "Click here to email customer service.", 'text_link');

box('text', 'Customer Service', $error ? $error : 'If you have upgraded to a new computer, or your logic board has been replaced, you can transfer your license for free. The license will no longer work on your old computer.<br><br>If you would like to use the program on another computer, you can purchase an additional license for half price. Your current license will continue to work on your original computer.');

echo('<form name="storeform" method="get" action="service.php">');

function all_programs($keys) {
	echo('<table class="box" width="600" border="0" cellpadding="0" cellspacing="0"><tr>');

	global $program;
	global $products;
	global $br;
	
	$icon_size = 108;

	foreach($keys as $i => $key) {
		$product = $products[$key];
		$product_name = $product['name'];
		$icon = $product['icon'];
		$slogan = $product['slogan'];
		$version = $product['version'];
		$price = $product['price'];
		$half_price = $price * 0.5;
		$price_string = "$half_price";
		if (strpos($price_string, ".5")) $price_string .= "0";
		
		echo('<td width="25%" class="sidebar" align="center" valign="top">');
		echo(hyperlink("../$icon/", img("/images/apps/$icon-128.png", 
			$product_name, $icon_size, $icon_size)));
		echo($br . hyperlink("../$icon/", $product_name, 'otherapps'));
		if (!$program || $program == 'Shoebox') $program = 'Shoebox Pro'; 
		$checked = ($program == $product_name) ? ' checked' : '';
		$radio_button = "<input type=\"radio\" value=\"$product_name\" name=\"program\"$checked>";
		echo($br . "$radio_button $$price_string");
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

$personal_info_text = "Please enter your full name, and the email address that you used with your order.";
if ($submit && !($name && $email)) $personal_info_text = red($personal_info_text);  
box('text', 'Personal Information', "$personal_info_text$br$br$personal_info_table");

$license_key_img = img('images/mail_window_kavatunes.png', 'Buy Window', 356, 142);
$licensekey_value = $licensekey ? " value=\"$licensekey\"" : '';
$license_key_text = 'Please locate the license key that you have already purchased.';
if ($submit && !$licensekey) $license_key_text = red($license_key_text);
box('text', 'License Key', "$license_key_text Open your email program, and find the license key message you received from KavaSoft:  $br <center> $license_key_img $br </center> Copy your old license key, and paste it here:&nbsp;&nbsp;&nbsp;<input type=\"text\"$licensekey_value name=\"licensekey\" size=\"21\" maxlength=\"19\">
");

$computer_number_img = img('images/buy_window.png', 'Buy Window', 356, 142);
$computernumber_value = $computernumber ? " value=\"$computernumber\"" : '';
$computer_number_text = 'Please locate the computer number for the Mac you would like to use the program on.';

if ($submit && !$computernumber) $computer_number_text = red($computer_number_text);
box('text', 'Computer Number', "$computer_number_text Download and launch $the_program. Choose &ldquo;$window_name&rdquo; from the application menu, and you'll see a window like this:  $br <center> $computer_number_img $br </center> Copy your new computer number, and paste it here:&nbsp;&nbsp;&nbsp;<input type=\"text\"$computernumber_value name=\"computernumber\" size=\"19\" maxlength=\"19\">
");

$transfer_button = '<input type="submit" name="transfer" value="&nbsp;&nbsp;&nbsp;Transfer License&nbsp;&nbsp;&nbsp;">';
$purchase_button = '<input type="submit" name="purchase" value="&nbsp;&nbsp;&nbsp;Purchase Additional License&nbsp;&nbsp;&nbsp;">';

echo(div("text box_header", 'Place Order'));
echo(div("text box", center($transfer_button . '&nbsp;&nbsp;or&nbsp;&nbsp;' . $purchase_button)));

echo('</form>');

table_3();

footer();

?>