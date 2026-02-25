<?php 

$page_name = 'download';
$doc_root = './';
$lang = 'en';

include($doc_root . '../shared.php');

$stylesheet = '/styles.css';
$favicon = $GLOBALS['favicon'];
$generator = 'TextMate';

header("Content-type: text/html; charset=utf-8");
echo("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" " .
	"\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n");
echo("<html xmlns=\"http://www.w3.org/1999/xhtml\">\n");
echo("<head>\n\t<title>$php_support_title</title>\n"); 
echo("\t<meta name=\"generator\" content=\"$generator\" />\n");
echo("\t<link rel=\"shortcut icon\" href=\"$favicon\" type=\"image/x-icon\" />\n");
echo("\t<link rel=\"stylesheet\" type=\"text/css\" href=\"$stylesheet\" media=\"screen\" />\n");
echo("</head>\n<body class=\"popup\">\n");

$php_support_title = 'KavaTunes - PHP';

$what_is_php_header = 'What is PHP?';
$what_is_php_text = "KavaTunes creates dynamic catalogs that use the PHP scripting language. To serve these catalogs, your web server needs to support PHP.";

$support_php_header = 'Does my web server support PHP?';
$support_php_text = "Personal Web Sharing supports PHP, so you can use any Mac as a web server. $br$br If you have professional web hosting, your server probably supports PHP. Check with your server administrator if you're not sure. They may need to turn it on for you. $br$br If you have basic web hosting, check with your provider. At this time .Mac does not support PHP.";

$get_hosting_header = 'How can I get web hosting with PHP support?';
$get_hosting_text = "KavaSoft's partner <a href=\"http://secure.hostforweb.com/ua/clickthru.cgi/kavasoft\" target=\"hostforweb\">Host For Web</a> offers professional web hosting, including PHP and FTP support, starting at $4.95/month. Personalized domain names are also available.";

box('sidebar', $what_is_php_header, $what_is_php_text);
box('sidebar', $support_php_header, $support_php_text);
box('sidebar', $get_hosting_header, $get_hosting_text);

?>
