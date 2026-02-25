<?php

include('../../products.php');

# Page title
$page_name = 'home';
$doc_root = '../';
$title = 'HyperImage';
$folder = 'HyperImage';
$store_product = 'hyperimage';
$slogan = "for Webmasters";

include($doc_root . '../shared.php');
include($doc_root . '../licenses/licenses.php');

$name = get_value('name');
$email = get_value('email');
$website = get_value('website');
$coupon = get_value('coupon');
$computernumber = get_value('computernumber');
$paypal = get_value('paypal');
$comments = get_value('comments');

if ($email && $website) {
	$subject = 'HyperImage affiliate program';
	$message = "Name: $name\n";
	$message .= "Email: $email\n";
	$message .= "Website: $website\n";
	$message .= "Coupon code: $coupon\n";
	$message .= "Computer Number: $computernumber\n";
	$message .= "Paypal account: $paypal\n";
	$message .= "Comments: $comments\n";
	
	send_message('info@kavasoft.com', $subject, $message, "$name <$email>");
	$sent = true;
}

head('HyperImage - Webmasters', $folder);
table_1();

tour_box();
download_box("English$br$br");
// buy_box();

// box('sidebar', 'Webmasters &amp; Bloggers', hyperlink("webmasters/", "Give us a plug on your site, enable your viewers to download content, and earn money through our affiliate program.", 'sidebar_link'));

questions_box(array('faq', 'help', 'orders', 'service', 'pr', 'contact'));

table_2(); 

if ($sent) box('text', 'Thanks for signing up!', "We'll send you your free HyperImage license key shortly.");

box('text', 'Affiliate program', "Here's how our affiliate program works:<ol>
<li>You spread the word about HyperImage.</li>
<li>You get a free HyperImage license.</li>
<li>Your readers get a 20% discount code.</li>
<li>You receive 20% of sales with your code.</ol>");

$banners = array('vertical' => array(120, 240), 'square' => array(125, 125), 'big square' => array(250, 250), 'horizontal' => array(468, 60), 'big horizontal' => array(728, 90));

function banner_list($banners, $folder) {
	$list = '';
	foreach ($banners as $key => $banner) {
		$width = $banner[0];
		$height = $banner[1];
		$list .= popup("banners/$folder/{$width}x$height.jpg", 
			"HyperImage banner $width x $height", $width, $height, $key, 'text_link');
		if ($key != 'big horizontal') $list .= ", ";
	}
	return $list;
}

box('text', 'Spread the word', "You can write a blog entry with a full review, or even just a quick plug. 
Here are some banner ads in various sizes that you can use:<center><p>" . img('banners/site/468x60.jpg', 'banner', 468, 60) . "<p>" . banner_list($banners, 'site') . "<p>" .  img('banners/blog/468x60.jpg', 'banner', 468, 60) . '<p>' . banner_list($banners, 'blog') . "</p></center>");

box('text', 'Get a free license', "Let us know the address of your website, including a link to a blog entry about the program or an ad placement. Then we'll send you a license for HyperImage on the house.$br$br
We'll need you to look up your computer number. First, download HyperImage. When you launch the program, it will display a message with your sixteen-digit computer number:<br><center>" . img('buy_window.png', 'banner', 356, 142) . "<br></center>Send us your computer number and we'll send you your free license key.");

box('text', 'Offer a discount to your readers', "You can choose a coupon code, such as MYCOOLBLOG, that gives your readers a 20% discount on HyperImage. That's $20 instead of $25.$br$br To ensure that your readers get their discount, link to the HyperImage website like this:$br$br
<form><input type=\"text\" size=\"65\" value=\"http://www.kavasoft.com/HyperImage/index.php?coupon=MYCOOLBLOG\">
$br$br You can also link directly to our online store:$br$br
<input type=\"text\" size=\"65\" value=\"http://www.kavasoft.com/store/index.php?hyperimage=1&coupon=MYCOOLBLOG\"></form>");

box('text', 'Earn money from sales', "We'll send you the proceeds from every fifth sale using your coupon code. In other words, you'll earn 20% cash back for sales from your website. For example, if ten people buy the program, we'll send you forty bucks. Make sure to let us know your PayPal account.");

echo('<form name="webmasterform" method="get" action="index.php">');

function order_row($label, $name, $value, $width, $maxwidth, $example = null) {
	if ($example) $example = gray("&nbsp;&nbsp;&nbsp; ($example)");
	return tr(array(td('features', "$label:&nbsp;&nbsp;&nbsp;", 130), 
		td('features', text_field($name, $value, $width, $maxwidth) . 
		$example)));
}

$personal_info_table = '<table border="0">';
$personal_info_table .= order_row('Full name', 'name', $name, 30, 255, 'Joe Blogger');
$personal_info_table .= order_row('Email address', 'email', $email, 30, 255, 'joe@mycoolblog.com');
$personal_info_table .= order_row('Website', 'website', $website, 30, 255, 'www.mycoolblog.com');
$personal_info_table .= order_row('Coupon code', 'coupon', $coupon, 30, 255, 'MYCOOLBLOG');
$personal_info_table .= order_row('Computer number', 'computernumber', $computernumber, 30, 255, '1234-5678-1234-5678');
$personal_info_table .= order_row('PayPal account', 'paypal', $paypal, 30, 255, 'paypal@mycoolblog.com');
$personal_info_table .= tr(array(td('features', "Comments:&nbsp;&nbsp;&nbsp;", 130, null, null, null, 'valign="top"'), 
	td('features', text_area('comments', $comments, 28, 8) . $br . $br .
	submit_button('submit', 'Sign up'))));
$personal_info_table .= '</table>';
box('text', 'Sign up', "$personal_info_table");


echo('</form>');

table_3(); 
footer(); 

?>

