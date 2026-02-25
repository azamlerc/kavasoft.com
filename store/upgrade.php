<?php 

$page_name = 'store';
$doc_root = '../Shoebox/';

include('../shared.php');
include('../products.php'); 

$payment = get_value('payment');
$computernumber = get_value('computernumber');
$licensekey = get_value('licensekey');

$is_paypal = $payment == 'paypal';
$is_kagi = $payment == 'kagi';

$args = array();

if ($is_paypal || $is_kagi) {
	$total_price = 0;

	if ($is_paypal) {
		$args['cmd'] = "_xclick";
		$args['business'] = "info@kavasoft.com";
		$args['no_shipping'] = "1";
		$args['cn'] = "Notes";
		$args['on0'] = "Computer+number";
		$args['os0'] = "$computernumber/$licensekey";
	} else {
		$args['storeID'] = "P2R_LIVE";
		$args['view'] = "cart";
		$args['order/javascript'] = "YES";
		$args['Keyword:+Computer-number+-'] = $computernumber;
		$args['Keyword:+Previous-license+-'] = $licensekey;
	}
	
	$kagi_products = '';
	foreach ($upgrade_products as $product_key => $feature) {
		if ($product_key == get_value('product')) {
			$price = $feature['price'];
			$icon = $feature['icon'];
			$extended_price = $price;
			$total_price += $price;
			
			if ($is_paypal) {
				$product_encoded = urlencode($feature['paypal_name']);
				$args['item_name'] = "$product_encoded license";
				$args['quantity'] = 1;
				$args['amount'] = '$' . $price;
				$args['image_url'] = "http://www.kavasoft.com/images/paypal/$icon.jpg";
				$args['return'] = "http://www.kavasoft.com/store/thanks.php/$product_encoded/$computernumber";
			} else {
				$kagi_id = $feature['kagi_id'];
				$args["product/$kagi_id/0/quantity"] = 1;
			}
		}
	}

	if ($total_price > 0) {
		$action_url = $is_paypal ? 'https://www.paypal.com/cgi-bin/webscr' :
							       'https://order.kagi.com/cgi-bin/store.cgi';
		$redirect_path = path_with_args($action_url, $args) . $kagi_products;
		header("Location: $redirect_path");
		exit;
	}
}

head('KavaSoft - Store', $folder);

table_single_1();

echo(spacer_img(10, 10) . $br);
echo(span('mainheader', 'KavaSoft ') . span('grayheader', 'Store') . $br);
echo(spacer_img(10, 20) . $br);

echo("</td><tr /><tr><td width=\"300\" align=\"left\"valign=\"top\">");

box('sidebar', 'How to Buy', 'You can upgrade by choosing “Buy...” from the application menu, or by filling out this form.');

$home_link = hyperlink('index.php', 'KavaSoft Store home page', 'sidebar_link');
box('sidebar', 'Full Versions', "You can purchase full versions of our software on the $home_link.");

box('sidebar', 'Order Status', hyperlink('orders.php', 'After you place your order, you can check your order status.', 'sidebar_link'));
table_2();

echo('<form name="storeform" method="get" action="upgrade.php">');

function all_programs($keys) {
	echo('<table class="box" width="600" border="0" cellpadding="0" cellspacing="0"><tr>');

	global $upgrade_products;
	global $br;
	
	$icon_size = 108;

	foreach($keys as $i => $key) {
		$product = $upgrade_products[$key];
		$name = $product['name'];
		$icon = $product['icon'];
		$slogan = $product['slogan'];
		$version = $product['version'];
		$price = $product['price'];
		
		echo('<td width="33%" class="sidebar" align="center" valign="top">');
		echo(hyperlink("../$icon/", img("/images/apps/$icon-128.png", 
			$name, $icon_size, $icon_size)));
		echo($br . hyperlink("../$icon/", $name, 'otherapps'));
		echo($br . 'from ' . $product['upgrade_from']);
		$product_key = get_value('product');
		if (!$product_key) $product_key = 'shoebox_pro_upgrade'; 
		$checked = ($product_key == $key) ? ' checked' : '';
		$radio_button = "<input type=\"radio\" value=\"$key\" name=\"product\"$checked>";
		echo($br . "$radio_button $$price");
		echo('</td>');
		
		if ($key == 'hyperimage_3_upgrade') 
			echo('</tr><tr><td height="7">' . spacer_img(15, 7) . '</td></tr><tr>');
	}

	echo('</tr></table>');
}

echo(div("$class box_header", 'Upgrades'));
all_programs(array('iconquer_4_upgrade', 'kavatunes_4_upgrade', 'hyperimage_3_upgrade', 'shoebox_pro_upgrade', 'kavaservices_cc_upgrade', 'kavaservices_ts_upgrade'));
echo(spacer_img(25, 25));

/*
echo(div("$class box_header", 'Upgrades to Shoebox 2'));
all_programs(array('shoebox_pro_version_upgrade', 'shoebox_express_version_upgrade'));
echo(spacer_img(25, 25));

echo(div("$class box_header", 'Upgrades to Shoebox Pro'));
all_programs(array('shoebox_pro_edition_upgrade', 'shoebox_pro_edition_version_upgrade'));
echo(spacer_img(25, 25));

echo(div("$class box_header", 'Upgrades'));
all_programs(array('kavatunes_upgrade', 'kavaservices_cc_upgrade', 'kavaservices_ts_upgrade',));
echo(spacer_img(25, 25));
*/
$paypal_image = img('images/paypal.png', 'PayPal', 134, 60);
$kagi_image = img('images/kagi.png', 'Kagi', 122, 60);

if (dutch()) {
	echo("<input type=\"hidden\" value=\"kagi\" name=\"payment\">");
} else {
	echo(div("$class box_header", 'Payment Method'));
	echo('<table class="box" width="600" border="0" cellpadding="0" cellspacing="0"><tr>');

	if ($payment != 'kagi') $payment = 'paypal';

	$checked = ($payment == 'paypal') ? ' checked' : '';
	$radio_button = "<input type=\"radio\" value=\"paypal\" name=\"payment\"$checked>";
	echo("<td width=\"60\" align=\"right\">$radio_button&nbsp;&nbsp;</td><td>$paypal_image</td>");

	$checked = ($payment == 'kagi') ? ' checked' : '';
	$radio_button = "<input type=\"radio\" value=\"kagi\" name=\"payment\"$checked>";
	echo("<td width=\"60\" align=\"right\">$radio_button&nbsp;&nbsp;&nbsp;</td><td>$kagi_image</td>");

	echo('</tr></table>');
	echo(spacer_img(25, 25));
}

$computer_number_img = img('images/buy_window.png', 'Buy Window', 356, 142);
$computernumber_value = $computernumber ? " value=\"$computernumber\"" : '';
box('text', 'Computer Number', "Please locate your KavaSoft computer number.
Download and launch the program you&rsquo;d like to buy. Choose &ldquo;Buy&hellip;&rdquo; from the application menu, and you'll see a window like this:  $br <center> $computer_number_img $br </center> Copy your computer number, and paste it here:&nbsp;&nbsp;&nbsp;<input type=\"text\"$computernumber_value name=\"computernumber\" size=\"19\" maxlength=\"19\">
");

$license_key_img = img('images/mail_window.png', 'Buy Window', 356, 142);
$licensekey_value = $licensekey ? " value=\"$licensekey\"" : '';
box('text', 'License Key', "Please locate the license key for the product you are upgrading from.
Open your email program, and find the license key message you received from KavaSoft:  $br <center> $license_key_img $br </center> Copy your license key, and paste it here:&nbsp;&nbsp;&nbsp;<input type=\"text\"$licensekey_value name=\"licensekey\" size=\"21\" maxlength=\"19\">
");

$buy_button = '<input type="submit" name="submit" value="&nbsp;&nbsp;&nbsp;Upgrade Now&nbsp;&nbsp;&nbsp;">';

echo(div("text box_header", 'Place Order'));
echo(div("text box", center($buy_button)));

echo('</form>');

table_3();

footer();

?>