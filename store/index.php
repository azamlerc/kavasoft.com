<?php 

$doc_root = '../Shoebox/';

include('../products.php'); 
include('../shared.php');

$payment = get_value('payment');
$computernumber = get_value('computernumber');
$coupon = get_value('coupon');
if ($coupon) $coupon = strtoupper($coupon);

$is_paypal = $payment == 'paypal';
$is_kagi = $payment == 'kagi';

$args = array();

if ($is_paypal || $is_kagi) {
	$total_price = 0;

	// if there's more than one product, we have to use Kagi
	$num_products = 0;
	$total_quantity = 0;
	
	$all_products = array_merge($products, $bundle_products);
	
	foreach ($products as $product_key => $feature) {
		$quantity = get_value($product_key);
		if ($quantity > 0) {
			$num_products++;
			$total_quantity += $quantity;
		}
	}

	foreach ($bundle_products as $product_key => $feature) {
		$quantity = get_value($product_key);
		if ($quantity > 0) {
			$num_products++;
			// $total_quantity += $quantity; // no additional discount
		}
	}

	$multiple_purchase = $total_quantity > 1;
	if ($num_products > 1) {
		$is_paypal = false;
		$is_kagi = true;
	}
	
	if ($is_paypal) {
		$args['cmd'] = "_xclick";
		$args['business'] = "info@kavasoft.com";
		$args['no_shipping'] = "1";
		$args['cn'] = "Notes";
		$args['on0'] = "Computer+number";
		$args['os0'] = $computernumber;
	} else {
		$args['storeID'] = "P2R_LIVE";
		$args['view'] = "cart";
		$args['order/javascript'] = "YES";
		$args['Keyword:+Computer-number+-'] = $computernumber;
	}
	
	$kagi_products = '';
	foreach ($all_products as $product_key => $feature) {
		$quantity = get_value($product_key);
		
		if ($quantity > 0) {
			$price = $feature['price'];
			$icon = $feature['icon'];

			if ($coupon) {
				$coupon_info = $coupons[$coupon];
				$allowed = $coupon_info['allowed'];
				if ($coupon_info && ($allowed[0] == 'all' || array_search($product_key, $allowed) !== false)) {
					$discount = $coupon_info['discount'];
					$price *= $discount;
				} else {
					unset($coupon);
				}
			} else if ($multiple_purchase) {
				$price -= 5;
			}

			$extended_price = $quantity * $price;
			$total_price += $extended_price;
			$custom_price = $coupon || $multiple_purchase;
			
			if ($is_paypal) {
				$product_encoded = urlencode($feature['paypal_name']);
				$args['item_name'] = "$product_encoded license";
				$args['quantity'] = $quantity;
				$args['amount'] = '$' . $price;
				$args['image_url'] = "http://www.kavasoft.com/images/paypal/$icon.jpg";
				$args['return'] = "http://www.kavasoft.com/store/thanks.php/$product_encoded/$computernumber";
			} else {
/*				$kagi_product = $feature['kagi_name'];
				$currency = 'US$';
				$kagi_products .= '&Product=' . urlencode("$currency $extended_price - $quantity * $kagi_product");
*/				$kagi_id = $feature['kagi_id'];
				if ($custom_price)
					$args["product/$kagi_id/0/price"] = $price;
				else 
					$args["product/$kagi_id/0/quantity"] = $quantity;
			}
			
			if ($custom_price && $is_kagi)
				$args["currency"] = 'USD';
		}
	}

	if ($total_price > 0) {
		$action_url = $is_paypal ? 'https://www.paypal.com/cgi-bin/webscr' :
							       'https://order.kagi.com/cgi-bin/store.cgi';
		$redirect_path = path_with_args($action_url, $args) . $kagi_products;
		// echo($redirect_path);
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

box('sidebar', 'How to Buy', 'You can purchase our software by choosing “Buy...” from the application menu, or by filling out this form.');

box('sidebar', 'Multiple Purchases', 'If you purchase two or more program licenses at the same time, you&rsquo;ll receive a $5 discount on each of them automatically.');

box('sidebar', 'Upgrades', 
//	hyperlink('upgrade.php?product=shoebox_pro_version_upgrade', 'Shoebox 1.x to Shoebox 2', 'sidebar_link') . $br .
//	hyperlink('upgrade.php?product=shoebox_pro_edition_upgrade', 'Shoebox Express to Shoebox Pro', 'sidebar_link') . $br .
	hyperlink('upgrade.php?product=iconquer_4_upgrade', 'iConquer 4', 'sidebar_link') . $br .
	hyperlink('upgrade.php?product=kavatunes_4_upgrade', 'KavaTunes 4', 'sidebar_link') . $br .
	hyperlink('upgrade.php?product=hyperimage_3_upgrade', 'HyperImage 3', 'sidebar_link') . $br .
	hyperlink('upgrade.php?product=shoebox_pro_upgrade', 'Shoebox Pro from Shoebox Express', 'sidebar_link') . $br .
	hyperlink('upgrade.php?product=kavaservices_cc_upgrade', 'KavaServices from Character Converter', 'sidebar_link') . $br .
	hyperlink('upgrade.php?product=kavaservices_ts_upgrade', 'KavaServices from Translation Service', 'sidebar_link'));

box('sidebar', 'Order Status', hyperlink('orders.php', 'After you place your order, you can find your license key by checking your order status.', 'sidebar_link'));

box('sidebar', 'Additional License', hyperlink('service.php', 'If you would like to use the program on another computer, you can use this form to purchase an additional license for half price.', 'sidebar_link'));

table_2();

echo('<form name="storeform" method="get" action="index.php">');

function all_programs($keys) {
	echo('<table class="box" width="600" border="0" cellpadding="0" cellspacing="0"><tr>');

	global $coupon;
	global $coupons;
	global $products;
	global $br;
	
	$icon_size = 108;

	foreach($keys as $key) {
		$product = $products[$key];
		$name = $product['name'];
		$icon = $product['icon'];
		$slogan = $product['slogan'];
		$version = $product['version'];
		$price = $product['price'];
		$old_price = null;
		
		if ($coupon) {
			$coupon_info = $coupons[$coupon];
			$allowed = $coupon_info['allowed'];
			if ($coupon_info && ($allowed[0] == 'all' || array_search($key, $allowed) !== false)) {
				$discount = $coupon_info['discount'];
				$old_price = $price;
				$price *= $discount;
			}
		}
		
		if ($name == 'KavaTunes') $name = 'KavaTunes 4';
		if ($name == 'HyperImage') $name = 'HyperImage 3';
		if ($name == 'iConquer') $name = 'iConquer 4';
		
		echo('<td class="sidebar" align="center" valign="top">');
		echo(hyperlink("../$icon/", img("/images/apps/$icon-128.png", 
			$name, $icon_size, $icon_size)));
		echo($br . hyperlink("../$icon/", $name, 'otherapps'));
		$quantity = get_value($key);
		$quantity_value = $quantity ? " value=\"$quantity\"" : '';
		$field = "<input type=\"text\"$quantity_value name=\"$key\" 
				size=\"2\" maxlength=\"2\" style=\"text-align: right\">";
		if ($old_price) echo($br . "$field @ " . span('oldprice', "$$old_price") . ' ' . span('saleprice', "$$price"));
		else echo($br . "$field @ $$price");
		echo('</td>');
		
		if ($key == 'kavamovies') 
			echo('</tr><tr><td height="20">' . spacer_img(15, 20) . '</td></tr><tr>');
	}

	echo('</tr></table>');
}

function bundle_programs($keys) {
	echo('<table class="box" width="600" border="0" cellpadding="0" cellspacing="0"><tr>');

	global $products;
	global $bundle_products;
	global $br;
	
	$icon_size = 40;

	foreach($keys as $key) {
		$product = $bundle_products[$key];
		$name = $product['name'];
		$icon = $product['icon'];
		$price = $product['price'];
		$discount = $product['discount'];
		
		echo('<td class="sidebar" align="center" valign="top">');
		// echo(hyperlink("../$icon/", img("/images/apps/$icon-128.png", 
		// 	$name, $icon_size, $icon_size)));

		foreach($product['products'] as $bundled_key) {
			$bundled_product = $products[$bundled_key];
			$icon = $bundled_product['icon'];
			echo(hyperlink("../$icon/", img("/images/apps/$icon-64.png", $name, $icon_size, $icon_size)));
			echo('&nbsp;');
		} 
		
		echo($br);
		echo(hyperlink("../$icon/", $name, 'otherapps') . $br);
		
		$count = count($product['products']);
		$regular_price = 0;
		$i = 0;
		foreach($product['products'] as $bundled_key) {
			$bundled_product = $products[$bundled_key];
			$regular_price += $bundled_product['price'];
			$i++;
			$icon = $bundled_product['icon'];
			echo(hyperlink("../$icon/", $bundled_product['name'], 'text_link'));
			if ($i < $count - 1) echo(', ');
			if ($count == 3 && $i == 1) echo($br);
			if ($count == 6 && $i == 3) echo($br);
			if ($i == $count - 1) echo(' &amp; ');
		} 
		
		$quantity = get_value($key);
		$quantity_value = $quantity ? " value=\"$quantity\"" : '';
		$field = "<input type=\"text\"$quantity_value name=\"$key\" 
				size=\"2\" maxlength=\"2\" style=\"text-align: right\">";
		$savings = $regular_price - $price;
		echo($br . "$field @ $$price (save $$savings)");
		// echo($br . "$field @ " . span('oldprice', "$$regular_price") . ' '. span('newprice', "$$price"));
		echo('</td>');
	}

	echo('</tr></table>');
}

echo(div("$class box_header", 'Applications'));
all_programs(array('shoebox_pro', 'shoebox_express', 'kavatunes', 'kavamovies', 
				   'iconquer', 'hyperimage', 'kavaservices', 'curator'));

echo(spacer_img(25, 25));

/*
echo(div("$class box_header", 'Bundles'));
bundle_programs(array('kavalife', 'kavalife_pro'));
*/
echo(spacer_img(25, 25));

$paypal_image = img('images/paypal.png', 'PayPal', 134, 60);
$kagi_image = img('images/kagi.png', 'Kagi', 122, 60);

if (dutch()) {
	echo("<input type=\"hidden\" value=\"kagi\" name=\"payment\">");
} else {
	echo(div("$class box_header", 'Payment Method'));
	echo('<table class="box" width="600" border="0" cellpadding="0" cellspacing="0"><tr>');

	if ($payment != 'kagi') $payment = 'paypal';

	$checked = ($payment == 'paypal') ? 'checked="checked"' : '';
	$radio_button = "<input type=\"radio\" value=\"paypal\" name=\"payment\"$checked>";
	echo("<td width=\"60\" align=\"right\">$radio_button&nbsp;&nbsp;</td><td>$paypal_image</td>");

	$checked = ($payment == 'kagi') ? 'checked="checked"' : '';
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

$coupon_value = $coupon ? " value=\"$coupon\"" : '';
box('text', 'Coupon Code', "If you have a coupon code, you can enter it here:&nbsp;&nbsp;&nbsp;<input type=\"text\"$coupon_value name=\"coupon\" size=\"19\" maxlength=\"255\">");

$buy_button = '<input type="submit" name="submit" value="&nbsp;&nbsp;&nbsp;Buy Now&nbsp;&nbsp;&nbsp;">';

echo(div("text box_header", 'Place Order'));
echo(div("text box", center($buy_button)));

table_3();
echo('</form>');

footer();

?>
