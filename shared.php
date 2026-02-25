<?php

$br = '<br />';
$submenu = '<font size=-1>&#9654;</font>';
$email_address = '&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#105;&#110;&#102;&#111;&#64;'.
				 '&#107;&#97;&#118;&#97;&#115;&#111;&#102;&#116;&#46;&#99;&#111;&#109;';

// date_default_timezone_set('Europe/Amsterdam');
$year = '2011'; // date('Y');
$copyright = "&copy; 2002&ndash;$year KavaSoft.";
$all_rights_reserved = 'All rights reserved.';

$product_version = $products[$store_product]['version'];
$product_price = $products[$store_product]['price'];
$product_size = $products[$store_product]['size'];
$whatsnew = $products[$store_product]['whatsnew'];

function gray($text) {
	return "<font color=\"gray\">$text</font>";
}

function red($text) {
	return "<font color=\"red\">$text</font>";
}

function bold($text) {
	return "<b>$text</b>";
}

function italic($text) {
	return "<i>$text</i>";
}

function center($stuff) {
	return("<center>$stuff</center>");
}

function anchor($name) {
	echo("<a id=\"$name\" name=\"$name\"></a>\n");
}

function anchor_link($name) {
	return "<a id=\"$name\" name=\"$name\"></a>\n";
}

function div($class, $text) {
	return ("<div class=\"$class\">$text</div>\n");
}

function get_value($key) {
	return array_key_exists($key, $_GET) ? $_GET[$key] : null;
}

function text_field($name, $value, $size, $maxlength = 255) {
	if ($value) $value = " value=\"$value\"";
	return "<input type=\"text\"$value name=\"$name\" size=\"$size\" maxlength=\"$maxlength\">";
}

function text_area($name, $value, $cols, $rows = 1) {
	return "<textarea name=\"$name\" cols=\"$cols\" rows=\"$rows\">$value</textarea>";
}

function popup_menu($name, $values, $selected) {
	$popup = "<select name=\"$name\">\n";
	foreach($values as $value => $text) {
		$sel = ($selected == $value) ? ' selected' : '';
		$popup .= "\t\t<option$sel value=\"$value\">$text</option>\n";
	}
	return $popup . "</select>";
}

function submit_button($name, $label) {
	return "<input type=\"submit\" name=\"$name\" value=\"&nbsp;&nbsp;&nbsp;$label&nbsp;&nbsp;&nbsp;\">";
}

/**
 * Composes a GET URL from a path, arguments, and optionally an anchor. 
 *
 * For example, if $string is 'file.php' and $args are { 'artist' => 'pink_floyd', 'album' => 'pulse' }, 
 * will return 'file.php?artist=pink_floyd&artist=pulse'
 *
 * @param string the path to the file
 * @param array a keyed array
 * @param string an anchor to append to the end, e.g. '#selected'
 * @return string the full path
 */
function path_with_args($path, $args, $anchor = '') {
	$separator = '?';
	if ($args) {
		foreach($args as $key => $value) {
			$path .= $separator . $key . '=' . $value;
			$separator = '&';
		}
	}
	$path .= $anchor;
	return $path;
}

# returns a hyperlink linking $text to $path 
function hyperlink($path, $text, $class = '', $stuff = '') {
	if ($stuff) $stuff = ' ' . $stuff;
	return "<a href=\"$path\" class=\"$class\"$stuff>$text</a>";
}

#returns a popup link
function popup($path, $windowname, $width, $height, $text, $stuff = '') {
	$path = "javascript:window.open('$path','$windowname','width=$width,HEIGHT=$height')";
	return hyperlink($path, $text, $stuff);
}

# returns an image
function img($path, $alt, $width = 0, $height = 0, $stuff = '') {
	if ($width) $width = " width=\"$width\""; else $width = '';
	if ($height) $height = " height=\"$height\""; else $height = '';
	if ($stuff) $stuff = ' ' . $stuff;
	return "<img src=\"$path\" alt=\"$alt\" border=\"0\"$width$height$stuff />";
}

function input($type, $name, $value) {
	echo("\t<input type=\"$type\" name=\"$name\" value=\"$value\">\n");
}

function span($class, $text) {
	return "<span class=\"$class\">\n$text</span>\n";
}

function paragraph($class, $text) {
	echo("<p class=\"$class\">\n$text</p>\n");
}

function td($class, $content, $width = NULL, $height = NULL, $colspan = 1, $rowspan = 1, $stuff = '') {
	if ($stuff) $stuff = ' ' . $stuff;
	if ($class) $stuff .= " class=\"$class\"";
	if ($width) $stuff .= " width=\"$width\"";
	if ($height) $stuff .= " height=\"$height\"";
	if ($colspan > 1) $stuff .= " colspan=\"$colspan\"";
	if ($rowspan > 1) $stuff .= " rowspan=\"$rowspan\"";
	return "<td$stuff>$content</td>";
}

function tr($rows, $class = null) {
	if ($class) $class = " class=\"$class\"";
	$tr = "<tr$class>";
	foreach($rows as $row) $tr .= "\t" . $row . "\n";
	return $tr . '</tr>';
}

function ordered_list($items, $class) {
	echo(list_with_tag($items, $class, 'ol'));
}

function unordered_list($items, $class) {
	echo(list_with_tag($items, $class, 'ul'));
}

function list_with_tag($items, $class, $tag) {
	$list = "<$tag>\n";
	foreach ($items as $i => $item) {
		if (is_array($item)) {
			$list .= list_with_tag($item, $class, $tag);
		} else {
			$list .= "\t<li class=\"$class\">$item";
		}
		
		if (count($items) == ($i + 1) || !is_array($items[$i + 1])) $list .= "</li>";
		$list .= "\n";
	}
	$list .= "</$tag>\n";
	return $list;
}

function head($title, $folder, $refresh = null, $refresh_url = null, $body_stuff = null) {
	$stylesheet = '/styles.css';
	$favicon = "/images/apps/$folder-16.png";
	
	header("Content-type: text/html; charset=utf-8");
	echo("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" " .
		"\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n");
	echo("<html xmlns=\"http://www.w3.org/1999/xhtml\">\n");
	echo("<head>\n\t<title>$title</title>\n"); 
	if ($refresh && $refresh_url) echo("\t<meta http-equiv=\"refresh\" content=\"$refresh;url=$refresh_url\">");
	echo("\t<meta name=\"generator\" content=\"TextMate 1.5\" />\n");
	echo("\t<link rel=\"shortcut icon\" href=\"$favicon\" type=\"image/x-icon\" />\n");
	echo("\t<link rel=\"stylesheet\" type=\"text/css\" href=\"$stylesheet\" media=\"screen\" />\n");
	echo("</head>\n<body$body_stuff>\n<center>\n");
}

function spacer_img($width, $height) {
	return img('/images/spacer.gif', '', $width, $height);
}

function right_cell() {
	$right_width = 200;
	
	echo("</td><td width=\"20\"></td><td width=\"$right_width\" valign=top>");
}

function text_toolbar($current_page, $dir = './', $product_name) {
	$page_names = $GLOBALS['page_names'];
	
	echo("<p align=\"center\" class=\"footer\">");
	
	foreach (array_keys($GLOBALS['page_names']) as $i => $name) {
		$selected = $name == $current_page;
		if ($i) {
			echo("&nbsp;|&nbsp;");
		}
		if ($selected) {
			echo($page_names[$name]);
		} else {
			if ($name == 'home') {
				$link_path = $dir . 'index';
			} else if ($name == 'buy') {
				$link_path = $dir . '../store/index';
			} else {
				$link_path = $dir . $name . '/index';
			}
			
			if ($name == 'tour') {
				$link = local_popup($link_path, 'tour', 670, 540, $page_names[$name]);
			} else if ($name == 'buy') {
				$link = local_link($link_path, $page_names[$name], NULL, NULL, "$product_name=1");
			} else {
				$link = local_link($link_path, $page_names[$name]);
			}
			
			echo($link);
		}
	}
	
	echo("</p>");
}

function box($class, $header, $text, $show_spacer = true) {
	if ($header) echo(div("$class box_header", $header));
	echo(div("$class box", $text));
	if ($show_spacer) echo(spacer_img(25, 25));
}


function quote($quote) {
	return '<span class="quote">&ldquo;</quote>' . $quote['quote'] . '&rdquo; &nbsp;&nbsp;&mdash;&nbsp;' .
	 	$quote['author'];
}

function quotes_box($class = 'sidebar') {
	include('quotes.php');
	global $br;
	
	$quote_keys = array_rand($quotes, 2);
	while ($quotes[$quote_keys[0]]['author'] == $quotes[$quote_keys[1]]['author']) 
		$quote_keys = array_rand($quotes, 2); # prevent two quotes from the same person
		
	box($class, 'Quotes', quote($quotes[$quote_keys[0]]) . $br . $br . quote($quotes[$quote_keys[1]]));
}

function tour_box() {
/*	global $title;
	global $folder;
	global $br;
	
	box('sidebar', 'Guided Tour', hyperlink("/$folder/tour/", 
		img('/images/buttons/tour.png', 'Download', 90, 80, 'align="left"')) . 
		hyperlink("/$folder/tour/", "Take a guided tour of all the features of $title $br$br$br", 'sidebar_link'));
*/
}

function features_box() {
	include('tour/content.php');
	global $br;
	$cols = 4;
	$size = 120;
	
	$tour_table = '';
	foreach($pages as $index => $page) {
		if ($index % $cols == 0) $tour_table .= '<tr>';
		$link = "tour/index.php?page=" . ($index + 1);
		$image_path = './tour/thumbnails/' . $page['image'];
		if (!file_exists($image_path)) $image_path = './tour/images/' . $page['image'];
		$image = img($image_path, $page['title'], $size, $size, 'class="box no_padding"');
		$spacer = img('/images/spacer.gif', '', $size + 2, 5);
		$brs = ($index < count($pages) - $cols) ? "$br$br" : '';
		$tour_table .= td('foo', hyperlink($link, $image . $br . $spacer . $br .
			$page['title'], 'text_link') . $brs, 190, null, null, null, 
			'align="center" valign="top"');
		if ($index % $cols == $cols - 1) $tour_table .= '</tr>';
	}

	echo(div("text box_header", 'Guided Tour'));
	echo(div("text box no_side_padding", "<table border=\"0\" width=\"100%\">$tour_table</table>"));
	echo(spacer_img(25, 25));
}

function buy_box($upgrade_text = null, $upgrade_link = null) {
	global $store_product;
	global $title;
	global $product_price;
	global $coupons;
	global $br;
	
	$link = "/store/index.php?$store_product=1";

	$coupon = $_GET['coupon'];
	if ($coupon) {
		$coupon = strtoupper($coupon);
		$coupon_info = $coupons[$coupon];
		$allowed = $coupon_info['allowed'];
		if ($coupon_info && ($allowed[0] == 'all' || array_search($store_product, $allowed) !== false)) {
			$discount = $coupon_info['discount'];
			$old_price = $product_price;
			$product_price *= $discount;
			$link .= "&coupon=$coupon";
		}
	}
	
	if ($old_price) $text = "Buy $title for just $br" . /* span('oldprice', "$$old_price") . ' ' .*/ span('saleprice', "$$product_price") . " with coupon code $coupon";
	else $text = "Buy $title for $$product_price";
	
	$stuff = '<table border="0" cellspacing="0" cellpadding="0">';
	
	$stuff .= '<tr><td>' . hyperlink($link, 
		img('/images/buttons/buy_now.png', 'Buy Now', 93, 23)) . '</td><td>' .
		hyperlink("/store/index.php?$store_product=1", $text, 'sidebar_link') . '</td></tr>';
	if ($upgrade_text && $upgrade_link) {
		$stuff .= '<tr><td colspan="2">' . img('/images/spacer.gif', '', 10, 10) . '</td></tr>';
		$stuff .= '<tr><td>' . hyperlink($upgrade_link, 
			img('/images/buttons/upgrade.png', 'Upgrade Now', 93, 23)) . '</td><td>' .
			hyperlink($upgrade_link, $upgrade_text, 'sidebar_link') . '</td></tr>';
	}
	
	$stuff .= '</table>';

	box('sidebar', 'Buy', $stuff);
}

function download_box($stuff) {
	global $folder;
	global $product_version;
	global $product_size;
	global $br;

	box('sidebar', 'Download', hyperlink("/$folder.dmg", 
		img('/images/buttons/download.png', 'Download', 90, 80, 'align="left"')) . 
		hyperlink("/$folder.dmg", "Download version $product_version", 'sidebar_link') . 
		" $br $product_size disk image $br " . $stuff);
}

function app_download_box($stuff) {
	global $folder;
	global $product_version;
	global $product_size;
	global $br;
	
	$table = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td>";
	$table .= hyperlink("/$folder.dmg", 
		img("/images/apps/$folder-128.png", 'Download', 100, 100, 'align="left"'));
	$table .= "</td><td width=\"10\">&nbsp;</td><td class=\"sidebar\" valign=\"top\">";
	$table .= hyperlink("/$folder.dmg", "Download version $product_version", 'sidebar_link') . 
	" $br $product_size disk image $br " . $stuff;
	$table .= "</td></tr></table>";

	box('sidebar', 'Download', $table);
}

function whatsnew_box() {
	// if (dutch()) return; // don't show to dutch market
	
	global $whatsnew;
	global $br;

//	if ($whatsnew) box('sidebar', 'What&rsquo;s new?', hyperlink("history.php", $whatsnew, 'sidebar_link'));
	if ($whatsnew) box('sidebar', 'What&rsquo;s new?', $whatsnew);
}

function questions_box($items) {
	global $doc_root;
	global $store_product;
	global $email_address;
	global $title;
	global $br;
	
	$content = '';
	foreach ($items as $item) {
		if ($item == 'tour') {
			$content .= hyperlink($doc_root . 'tour/', 'Guided Tour', 'sidebar_link');
		} else if ($item == 'faq') {
			$content .= hyperlink($doc_root . 'faq/', 'Frequently Asked Questions', 'sidebar_link');
		} else if ($item == 'help') {
			$content .= hyperlink($doc_root . 'help/', 'Online Help', 'sidebar_link');
		} else if ($item == 'store') {
			$content .= hyperlink($doc_root . '../store/index.php', 'KavaSoft Store', 'sidebar_link');
		} else if ($item == 'orders') {
			$content .= hyperlink($doc_root . '../store/orders.php', 'Order Status', 'sidebar_link');
		} else if ($item == 'service') {
			$content .= hyperlink($doc_root . "../store/service.php?program=$title", 'Customer Service', 'sidebar_link');
		} else if ($item == 'pr') {
			// if (dutch()) continue;
			$content .= hyperlink($doc_root . "../press/index.php?product=$store_product", 'Press Info', 'sidebar_link');
		} else if ($item == 'developer') {
			$content .= hyperlink("developer/", 'Developer', 'sidebar_link');
		} else if ($item == 'email') { 
			$content .= hyperlink($email_address, 'Email Us', 'sidebar_link');
		} else if ($item == 'contact') { 
			$content .= hyperlink($doc_root . "../contact/index.php?program=$title", 'Contact Us', 'sidebar_link');
		} else {
		 	$content .= $item;
		}

		$content .= $br;
	}
	
	box('sidebar', 'Links', $content);
}

function requirements_box($items) {
	global $br;

	$content = img('/images/macosx/mac-universal.png', 'Mac Universal', 105, 60, 'align="right"');

	foreach ($items as $item) {
		if ($item == 'universal') 
			$content .= 'Universal application';
		else if ($item == '64bit') 
			$content .= '64-bit Universal application';
		else if ($item == 'snow leopard') 
			$content .= 'Requires Snow Leopard';
		else if ($item == 'leopard') 
			$content .= 'Leopard or Snow Leopard';
		else if ($item == 'tiger') 
			$content .= 'Tiger, Leopard or <br>&nbsp;&nbsp;&nbsp;Snow Leopard';
		else if ($item == 'itunes') 
			$content .= 'iTunes 7 or later';
		else if ($item == 'php') 
			$content .= popup('phpsupport.php', 'PHP Support', 590, 480, 'Web server with PHP', 'sidebar_link');
		else if ($item == 'compatibility') 
			$content .= hyperlink('../downloads/', 'Previous versions', 'sidebar_link');
		else
		 	$content .= $item;

		$content .= $br;
	}
	
	box('sidebar', 'Requirements', $content);
}

function screenshot($width, $height, $large_width, $large_height) {
	global $store_product;
	global $folder;
	
	$image = img("/$folder/images/screenshot-600.jpg", 'Screenshot', $width, $height, 'class="box no_padding"');
	echo(popup("/$folder/images/screenshot-large.jpg", "$store_product screenshot",  
		$large_width, $large_height, $image));
	echo(spacer_img(25, 25));
}

function table_1($width = 300, $total_width = 925, $image = null) {
	global $folder;
	global $title;
	global $slogan;
	global $br;
	global $doc_root;
	
	$border = 0;
	
	echo("<table class=\"main\" width=\"$total_width\" border=\"$border\" 
		cellpadding=\"0\" cellspacing=\"0\">");
	echo("<tr><td width=\"$width\" align=\"left\" valign=\"top\">");
	if (!$image) $image = "/images/apps/$folder-300.png";
	echo(hyperlink($doc_root . 'index.php', img($image, $title, $width, $width)));
	echo("</td><td width=\"25\">" . spacer_img(25, 25) . 
		"</td><td align=\"left\" valign=\"middle\">");

	echo(spacer_img(10, 20) . $br);
	echo(span('mainheader', $title) . $br);
	echo(spacer_img(10, 10) . $br);
	echo(span('subheader', $slogan) . $br);
	echo(spacer_img(10, 10) . $br);

	$vertical_space = 10;

	echo("</td><tr /><tr><td colspan=\"3\">" . spacer_img(10, $vertical_space) . 
		"</td><tr><td width=\"$width\" align=\"left\"valign=\"top\">");
}

function banner_table_1($width = 300, $total_width = 925, $image = null) {
	global $folder;
	global $title;
	global $slogan;
	global $br;
	global $doc_root;
	global $plugin_links;
	
	$border = 0;
	
	echo("<table class=\"main\" width=\"$total_width\" border=\"$border\" 
		cellpadding=\"0\" cellspacing=\"0\">");
	echo("<tr><td width=\"$totalwidth\" align=\"left\" valign=\"top\" colspan=\"3\">");

	echo(spacer_img(15, $vertical_space));
	echo(hyperlink($doc_root . 'index.php', img('images/header.jpg', $folder, 925, 400)));

	echo("</td></tr><tr><td colspan=\"3\">" . spacer_img(25, $vertical_space) . 
		"</td></tr><tr><td width=\"$width\" align=\"left\"valign=\"top\">");
}


function table_2($width = 600) {
	echo("</td><td width=\"25\">" . spacer_img(25, 25) . "</td><td class=\"features\" width=\"$width\" align=\"left\" valign=\"top\">");
}

function table_3() {
	echo("</td></tr></table>");
}

function table_single_1($width = 925) {
	echo("<table class=\"main\" width=\"$width\" border=\"0\" 
		cellpadding=\"0\" cellspacing=\"0\">");
	echo("<tr><td width=\"$width\" colspan=\"3\" align=\"left\" valign=\"top\">");
}

function table_single_2() {
	echo("</td></tr></table>");
}

function other_programs($title) {
	echo('<table border="0" cellpadding="0" cellspacing="0"><tr><td>');
	echo(div("sidebar box_header", 'Other KavaSoft Applications'));
	echo('<table class="box" width="925" border="0" cellpadding="10" cellspacing="0"><tr>');

	if (strpos($title, 'Shoebox') !== false) $title = "Shoebox Pro";
	else if (strpos($title, 'iTunes Catalog') !== false) $title = "KavaTunes";
	else if ($title == 'Character Converter') $title = "KavaServices";
	else if ($title == 'Translation Service') $title = "KavaServices";

	global $products;
	foreach($products as $product) {
		$name = $product['name'];
		$icon = $product['icon'];
		if ($name != 'Shoebox Express' && $name != 'Shoebox Express 2' && $name != $title && 
			!(strpos($title, 'Shoebox') !== false && strpos($name, 'Shoebox') !== false)) 
		{
			if ($name == 'Shoebox Pro 2') $name = 'Shoebox 2';
			echo('<td align="center" valign="top">');
			echo(hyperlink("../$icon/", img("/images/apps/$icon-128.png", 
				$name, 128, 128)));
			echo(hyperlink("../$icon/", $name, 'otherapps'));
			echo('</td>');
		}
	}

	echo('</tr></table>');
	echo('</td></tr></table>');
}

function footer() {
	echo("\n<p class=\"footer\" align=\"center\">");
	echo($GLOBALS['copyright']);
	echo("<br />");
	echo($GLOBALS['all_rights_reserved']);
	echo("</p></center>\n</body>\n</html>\n");
}

function frame_bottom() {
	echo("</body>\n</html>\n");
}

function guided_tour() {
	global $br;
	global $title;
	global $folder;
	global $slogan;

	include('content.php');

	$page_index = $_GET['page'];
	if (!$page_index) $page_index = 1;
	$page_index--;
	$tour_page = $pages[$page_index];
	$page_title = $tour_page['title'];

	head($title . " - Guided Tour - $page_title", $folder);

	table_1(200, 865);

	$topic_links = '';
	foreach($pages as $index => $page) {
		$style = ($index == $page_index) ? 'sidebar_link selected' : 'sidebar_link';
		$topic_links .= hyperlink("index.php?page=" . ($index + 1), $page['title'], $style);
		$topic_links .= $br;
		// if ($index < count($pages) - 1) $topic_links .= ' - ';
	}

	box('sidebar', 'Topics', $topic_links);

	table_2(640);

	box('sidebar', $page_title, $tour_page['text']);

	$image = img('images/' . $tour_page['image'], $tour_page['title'], 640, 400);
	$link = ($page_index < count($pages) - 1) ? "index.php?page=" . ($page_index + 2) : '../index.php';
	$image = hyperlink($link, $image);


	echo(div('box no_padding', $image));

	table_3();

	footer();
}

function dutch() {
	$ip = $_SERVER["REMOTE_ADDR"];
	// if ($ip == '85.145.185.113') return false;
	$name = gethostbyaddr($ip);
	return strpos($name, '.nl') > 0;
}

?>