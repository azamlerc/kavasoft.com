<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>KavaSoft - Press Info</title>
	<meta name="generator" content="BBEdit 7.0" />
	<link rel="shortcut icon" href="/Shoebox/favicon.png" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="/shared/styles.css" media="screen" />
</head>
<body bgcolor="#FFFFFF">

<?php 

$page_name = 'store';
$doc_root = '../Shoebox/';
$lang = 'en';

include('../shared.php');
include('../licenses/licenses.php');
include('products.php');

function get_value($key) {
	return array_key_exists($key, $_GET) ? $_GET[$key] : null;
}

$name = get_value('name');
$names = explode(' ', $name);
$first_name = $names[0];
$email = get_value('email');
$publication = get_value('publication');
$website = get_value('website');
$computernumber = get_value('computernumber');
$product = get_value('product');

$subject = "$product Review Request";
$message = "Dear $first_name,\n\nThank you for your interest in reviewing $product. Your details have been received, and we will email you an evaluation license key shortly. If you have any questions, you can email us at press@kavasoft.com.\n\nBest regards,\n\nAndrew\nKavaSoft\n\n\nName: $name\nEmail address: $email\nPublication: $publication\nWebsite address: $website\nComputer number: $computernumber";

send_message("$name <$email>", $subject, $message, 'KavaSoft <press@kavasoft.com>', 'info@kavasoft.com');

?>

<center>
<table width="450" border="0" cellpadding="0" cellspacing="2">
<tr><td>
Thank you for your interest in reviewing <?php echo($product); ?>. Your details have been received, and we will email you an evaluation license key shortly. If you have any questions, you can email us at <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;press&#64;&#107;&#97;&#118;&#97;&#115;&#111;&#102;&#116;&#46;&#99;&#111;&#109;">press&#64;&#107;&#97;&#118;&#97;&#115;&#111;&#102;&#116;&#46;&#99;&#111;&#109;</a>.

</td></tr>
</table>
</center>
</body>
</html>