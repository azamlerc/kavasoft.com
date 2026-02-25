<?php 

$page_name = 'download';
$doc_root = '../';
$lang = 'en';

include($doc_root . '../shared/include.php');

$stylesheet = $GLOBALS['doc_root'] . 'styles.css';
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

paragraph('body', $what_is_php_header, $what_is_php_text);
paragraph('body', $support_php_header, $support_php_text);
paragraph('body', $get_hosting_header, $get_hosting_text);

?>
