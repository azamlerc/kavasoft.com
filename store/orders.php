<?php 

include('../shared.php');
include('../products.php');
include('../licenses/licenses.php');

head('KavaSoft - Store - Order Status', $folder);

table_single_1();

echo(spacer_img(10, 10) . $br);
echo(span('mainheader', 'KavaSoft ') . span('grayheader', 'Store') . $br);
echo(spacer_img(10, 20) . $br);

echo("</td><tr /><tr><td width=\"300\" align=\"left\"valign=\"top\">");

$name = get_value('name');
$email = get_value('email');
$computernumber = get_value('computernumber');
$newcomputernumber = get_value('newcomputernumber');
$transactionid = get_value('transactionid');
$submit = get_value('submit');

if ($computernumber == '0000-0000-0000-0000') unset($computernumber);
if ($computernumber == '1234-5678-1234-5678') unset($computernumber);

// log this stuff

$got_info = $email || $computernumber || $transactionid;

$results = array();
$got_results = false;

if ($got_info) {
	require 'DB.php';
	$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');
	$dbh->setFetchMode(DB_FETCHMODE_OBJECT);

	$wildcards = array('_' => '\_', '%' => '\%');

	$sql = 'SELECT name,computer_number,license_key,program,amount,date_paid,method,transaction_id,upgrade FROM licenses WHERE ';
	$terms = array();
	
	if ($email) $terms[] = 'email LIKE ' . strtr($dbh->quote($email), $wildcards);
	if ($computernumber) $terms[] = 'computer_number LIKE ' . strtr($dbh->quote($computernumber), $wildcards);
	if (strtolower($transactionid) != 'macheist')
		if ($transactionid) $terms[] = 'transaction_id LIKE ' . strtr($dbh->quote($transactionid), $wildcards);

	$results = $dbh->getAll($sql . join(' OR ', $terms), $values);
	$got_results = count($results) > 0;
}

box('sidebar', 'Automatic Registration', "After you have placed your order, simply launch the program to complete your purchase. The program will look up your license key and register itself automatically."); 

if (!$got_results) box('sidebar', 'Computer Number', hyperlink('service.php', 'If you did not include your computer number, look up your order by entering your email address or transaction ID. Then you\'ll be able to complete your order.', 'sidebar_link'));

questions_box(array('store', 'service', 'contact'));

table_2();

if (!$got_results) echo('<form name="storeform" method="get" action="orders.php">');

$purchased_keys = array();

function program_info($program) {
	global $purchased_keys;
	
	if ($program == 'HTML Character Converter') $program = 'Character Converter';
	if ($program == 'iTunes Catalog 2') $program = 'iTunes Catalog';
	if ($program == 'Shoebox Pro 2') $program = 'Shoebox Pro';
	if ($program == 'Shoebox Express 2') $program = 'Shoebox Express';
	if ($program == 'iConquer 4') $program = 'iConquer';
	if ($program == 'HyperImage 3') $program = 'HyperImage';
	if ($program == 'KavaTunes 4') $program = 'KavaTunes';
	if ($program == 'KavaMovies 2') $program = 'KavaMovies';
	
	foreach ($GLOBALS['products'] as $product_info) {
		if ($product_info['name'] == $program) {
			$purchased_keys[] = $key;
			return $product_info;
		}
	}
	
	foreach ($GLOBALS['discontinued_products'] as $key => $product_info) {
		if ($product_info['name'] == $program) {
			$purchased_keys[] = $key;
			return $product_info;
		}
	}
	
	return array();
}

$first_title = null;
$displayed_upgrade_keys = array();

if ($got_info && $got_results) {
	$thanks_message = count($results) > 1 ? "Thanks again for your purchases. Here are the details for your orders." : 
											"Thanks again for your purchase. Here are the details for your order.";
	box('text', "Thank you!", $thanks_message);

	$results_table = '<table border="0">';

	foreach ($results as $license) {
		$program = $license->program;
		$program_info = program_info($program);
		
		$icon = $program_info['icon'];
		$download = '../' . $program_info['icon'] . '.dmg';
		if ($program == 'iTunes Catalog 2') $icon = 'KavaTunes';
		if ($program == 'iTunes Catalog') $icon = 'iTunesCatalog';
		if ($icon) $icon = img('../images/apps/' . $icon . '-128.png', $program_info['name'], 128, 128);

		if (!$first_title) $first_title = $program_info['name'];
		if ($first_title == 'iTunes Catalog') $first_title = 'KavaTunes';
		if ($first_title == 'Character Converter') $first_title = 'KavaServices';
		if ($first_title == 'Translation Service') $first_title = 'KavaServices';

		$link = '../' . $program_info['link'];
		$program_link = hyperlink($link, $program, 'selected');
		if ($icon) $icon = hyperlink($link, $icon);
		
		if ($license->date_paid) {
			$date = strftime("%B %1d, %Y",strtotime($license->date_paid));
			$date = str_replace(' 0', ' ', $date);
		}
		
		$method = $license->method;
		if ($method == 'Resend') $method = 'Transfer';
		$amount = $license->amount;
		
		$order_info = $program_link;
		if ($date) $order_info .= "$br" . $date;
		if ($amount && $method) {
			if ($amount === 17.5) $extra_zero = '0';
			$order_info .= "$br$$amount$extra_zero via $method";
		}
		else if ($method) $order_info .= "$br$method";
		
		$txn_id = $license->transaction_id;
		$license_key = $license->license_key;
		
		if (strlen($license->computer_number) == 19 && !$computernumber)
			$computernumber = $license->computer_number; // fill in computer number from previous orders
		
		if (!$license_key && $newcomputernumber && $transactionid && $transactionid == $txn_id && valid_computer_number($newcomputernumber)) {
			$license_key = license_key($newcomputernumber, $program);
			$license->computer_number = $newcomputernumber;
			$email_sent = date('Y-m-d');
			
			$prh = $dbh->prepare('UPDATE licenses SET computer_number = ?, license_key = ?, email_sent = ? WHERE transaction_id = ? AND email = ?');
			$sth = $dbh->execute($prh, array($newcomputernumber, $license_key, $email_sent, $transactionid, $email));
			$success = $dbh->affectedRows();
			
			if ($success) {
				$subject = subject($program, 'en');
				$message = message($license->name, $newcomputernumber, $program, 'en') . "\n\n---\n\n$newcomputernumber";
				$from = 'KavaSoft Store <store@kavasoft.com>';
				$bcc = 'store@kavasoft.com';
				
				send_message("{$license->name} <$email>", $subject, $message, $from, $bcc);
			}
		}
		
		$protocol = array_key_exists('protocol', $program_info) ? $program_info['protocol'] : null;
		if ($license_key != null && $protocol != null) 
			$license_key_link = hyperlink("$protocol://localhost/license", $license_key, 'selected');
		else
			$license_key_link = $license_key;

		if ($license_key) {
			$numbers = '<table border="0" cellspacing="0" cellpadding="0">' . tr(array(td('features', "Computer number:&nbsp;&nbsp;"), td('features', $license->computer_number))) . tr(array(td('features', "License key: "), td('features', $license_key_link))) . '</table>';
		} else {
			$short_program = $program;
			if (strpos($program, 'Shoebox') === 0) $short_program = 'Shoebox';

			$computer_number_img = img('images/buy_window.png', 'Buy Window', 356, 142);
			$download_link = hyperlink($download, "downloading $short_program here", 'selected'); 
			$complete_button = center('<input type="submit" name="submit" value="&nbsp;&nbsp;&nbsp;Complete Order&nbsp;&nbsp;&nbsp;">');
			
			$numbers = $br . spacer_img(10, 10) . $br . "To complete your order, we'll need your computer number.$br Start by $download_link. When you launch the program, you'll see a window that looks like this: $br" . spacer_img(10, 5) . "<center> $computer_number_img $br </center> <form name=\"completeform\" method=\"get\" action=\"orders.php\">Copy your computer number here:&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"newcomputernumber\" value=\"$computernumber\" size=\"19\" maxlength=\"19\"><input type=\"hidden\" name=\"name\" value=\"$name\"><input type=\"hidden\" name=\"email\" value=\"$email\"><input type=\"hidden\" name=\"transactionid\" value=\"$txn_id\">$br$br$complete_button</form>";
		}
		
		$results_table .= tr(array(td('features', $icon, 140, null, null, null, 'valign="top"'), td('features', "$order_info$br" . spacer_img(10, 5) . "$numbers")));
		
		$upgrade_key = upgrade_key($program);
		if ($license_key && $upgrade_key && $license->upgrade != 1 && array_search($upgrade_key, $displayed_upgrade_keys) === false) {
			$displayed_upgrade_keys[] = $upgrade_key;
			$upgrade = $upgrade_products[$upgrade_key];
			$icon = $upgrade['icon'];
			$link = '../' . $upgrade['link'];
			$program_link = hyperlink($link, $upgrade['name'], 'selected');
			if ($icon) $icon = img('../images/apps/' . $icon . '-128.png', $upgrade['name'], 128, 128);
			if ($icon) $icon = hyperlink($link, $icon);
			$price = $upgrade['price'];
			$upgrade_url = "upgrade.php?product=$upgrade_key&computernumber=$computernumber&licensekey=$license_key";
			$upgrade_button = img('../images/buttons/upgrade_now.png', 'Upgrade Now', 121, 23, 'align="left"');
			$upgrade_button = hyperlink($upgrade_url, $upgrade_button);
			$upgrade_link = hyperlink($upgrade_url, "Upgrade for $$price", 'mainheader');
			$results_table .= tr(array(td('features', $icon, 140), td('features', 
				"You can upgrade to $program_link for $$price. $br$br $upgrade_button")));
		}
		
	}

	$results_table .= '</table>';
	
	box('text', 'Orders', $results_table);
	
	if ($method == 'MacHeist') {
		$computernumber = $license->computer_number;
		$upgrade_url = "index.php?computernumber=$computernumber&coupon=macheist";
		$upgrade_button = img('../images/buttons/buy_now.png', 'Buy Now', 93, 23);
		$upgrade_button = hyperlink($upgrade_url, $upgrade_button);			
		$results_table = '<table border="0">' . tr(array(td('features', $upgrade_button, 140, null, null, null, 'align="center"'), td('features', 
			hyperlink($upgrade_url, "As an extra holiday present from KavaSoft, you can enjoy<br>a 20% discount on our entire range of software with<br> coupon code MACHEIST!", 'text_link')))) . '</table>';
		box('text', 'Holiday Special', $results_table);
	}
	
} else {

	function order_row($label, $name, $value, $maxwidth, $example) {
		return tr(array(td('features', "$label:&nbsp;&nbsp;&nbsp;", 130), 
			td('features', text_field($name, $value, 19, $maxwidth) . 
			gray("&nbsp;&nbsp;&nbsp; ($example)"))));
	}

	$order_info_table = '<table border="0">';
	$order_info_table .= order_row('Email address', 'email', $email, 255, 'joe@smith.com');
	$order_info_table .= order_row('Transaction ID', 'transactionid', $transactionid, 19, '7W8109754E5303021');
	$order_info_table .= order_row('Computer number', 'computernumber', $computernumber, 19, '0000-0000-0000-0000');
	$order_info_table .= '</table>';

	$instructions = "You can look up your order history by filling out this form.";
	
	if ($got_info) {
		$no_orders_found = "No orders were found with ";
		if ($email) 
			$no_orders_found .= "the email address &ldquo;$email.&rdquo;";
		else if ($computernumber) 
			$no_orders_found .= "the computer number &ldquo;$computernumber.&rdquo;";
		else if ($transactionid) 
			$no_orders_found .= "the transaction ID &ldquo;$transactionid.&rdquo;";
		$instructions = red($no_orders_found);
	}
	
	$instructions .= "$br$br Please enter your email address, transaction ID or computer number,$br exactly as displayed in your order confirmation from PayPal or Kagi.";

	box('text', 'Order Status', "$instructions$br$br$order_info_table$br" . 
		center(submit_button('submit', 'Order Status')));
}

table_3(); 

if (!$got_results) echo('</form>');

if ($first_title) other_programs($first_title);

footer();

?>
