<?php 

$doc_root = '../Shoebox/';

include('../products.php'); 
include('../shared.php');
include('../licenses/licenses.php');

$program = get_value('program');
$name = get_value('name');
$email = get_value('email');
$computernumber = get_value('computernumber');
$licensekey = get_value('licensekey');
$version = get_value('version');

$topic = get_value('topic');
$subject = get_value('subject');
$message = get_value('message');

head('KavaSoft - Contact Us', $folder);

table_single_1();

echo(spacer_img(10, 10) . $br);
echo(span('grayheader', 'Contact ') . span('mainheader', 'KavaSoft') . $br);
echo(spacer_img(10, 20) . $br);

echo("</td><tr /><tr><td width=\"300\" align=\"left\"valign=\"top\">");

box('sidebar', 'Order Status', hyperlink("../store/orders.php?computernumber=$computernumber&email=$email", 'After you place your order, you can get your license key by checking your order status.', 'sidebar_link'));

$transfer_link = "../store/service.php?program=$program";
if ($licensekey) $transfer_link .= "&licensekey=$licensekey";
else if ($computernumber) $transfer_link .= "&computernumber=$computernumber";
if ($name) $transfer_link .= "&name=$name";
if ($email) $transfer_link .= "&email=$email";

box('sidebar', 'Transfer License', hyperlink($transfer_link, 'If you move to a different computer, you can use this form to transfer your license key.', 'sidebar_link'));

box('sidebar', 'Frequently Asked Questions', hyperlink('../Curator/faq/', 'Curator', 'sidebar_link') . $br .
	hyperlink('../HyperImage/faq/', 'HyperImage', 'sidebar_link') . $br .
	hyperlink('../Shoebox/faq/', 'iConquer', 'sidebar_link') . $br .
	hyperlink('../KavaTunes/faq/', 'KavaTunes', 'sidebar_link') . $br .
	hyperlink('../Shoebox/faq/', 'Shoebox', 'sidebar_link'));

questions_box(array('email', 'pr'));

table_2();

if ($email && $message) {
	$full_subject = '';
	if ($program) $full_subject .= $program . ' ';
	if ($version) $full_subject .= $version . ' ';
	if ($topic) $full_subject .= $topic . ' ';
	if ($subject) $full_subject .= "- $subject";
	if ($licensekey) $full_subject .= " ($licensekey)";
	else if ($computernumber) $full_subject .= " ($computernumber)";
	
	send_message('info@kavasoft.com', $full_subject, $message, "$name <$email>");
	$sent = true;
}

$instructions = 'You can send us a message with this form. Use the links at left to check the status of your order, transfer your license key, or find the answers to frequently asked questions.';

if ($sent) {
	$instructions = 'Thank you for your message. We will get back to you shortly.';
}

box('text', 'Contact Us', $instructions);

echo('<form name="contactform" method="get" action="index.php">');

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
		if ($program == 'Shoebox') $program = 'Shoebox Pro'; 
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

function order_row($label, $name, $value, $width, $maxwidth, $example = null) {
	if ($example) $example = gray("&nbsp;&nbsp;&nbsp; ($example)");
	return tr(array(td('features', "$label:&nbsp;&nbsp;&nbsp;", 130), 
		td('features', text_field($name, $value, $width, $maxwidth) . 
		$example)));
}

$personal_info_table = '<table border="0">';
$personal_info_table .= order_row('Full name', 'name', $name, 30, 255, 'Joe Smith');
$personal_info_table .= order_row('Email address', 'email', $email, 30, 255, 'joe@smith.com');
$personal_info_table .= '</table>';

box('text', 'Personal Information', "$personal_info_table");

echo("<input type=\"hidden\" name=\"computernumber\" value=\"$computernumber\">");
echo("<input type=\"hidden\" name=\"licensekey\" value=\"$licensekey\">");
echo("<input type=\"hidden\" name=\"version\" value=\"$version\">");

$topics = array(
	'Feedback' => 'Choose one...',
	'Order Status' => 'Order Status',
	'Additional License' => 'Additional License',
	'Bug Report' => 'Bug Report',
	'Feature Request' => 'Feature Request',
	'Press Inquiry' => 'Press Inquiry',
	'Affiliate Program' => 'Affiliate Program',
	'Website' => 'Website',
	'Comments' => 'Comments',
);

box('text', 'Message', '<table border="0">' . tr(array(td('features', "Topic:&nbsp;&nbsp;&nbsp;", 130), 
	td('features', popup_menu('topic', $topics, $topic)))) . 
	order_row('Subject', 'subject', $subject, 62, 255) .
	tr(array(td('features', "Message:&nbsp;&nbsp;&nbsp;", 130, null, null, null, 'valign="top"'), 
		td('features', text_area('message', $message, 60, 10) . $br . $br .
		submit_button('submit', 'Send Message')))) . 
	'</table>');

table_3();
echo('</form>');

footer();

?>
