<?php 

$page_name = 'faq';
$doc_root = '../';
$help_path = '../';

include($doc_root . '../shared.php');
include('faq.php');

?>

<HTML>

<HEAD>
<META HTTP-EQUIV="content-type" CONTENT="text/html;charset=iso-8859-1">
<META NAME="keywords" CONTENT="categories, photos, search, camera">
<META NAME="description" CONTENT="Frequently Asked Questions.">
<TITLE>Frequently Asked Questions</TITLE>
</HEAD>

<BODY BGCOLOR="#ffffff">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr HEIGHT="40">
<td width="40" HEIGHT="40"><a href="../Shoebox%20Help.htm"><IMG HEIGHT="40" width="40" border="0" SRC="../gfx/xicnsc.gif"></a></td>
<td width="6" HEIGHT="40"></td>
<td HEIGHT="40" VALIGN="middle"><FONT FACE="Lucida Grande,Helvetica,Arial" SIZE="4">
<B>Frequently Asked Questions</B></FONT></td>
</tr>
</TABLE>
<FONT SIZE="2" FACE="Lucida Grande,Geneva,Arial"><p>

<?php

echo("<UL>\n");
foreach($topics as $topic => $questions) {
	echo("<LI>$topic\n<UL>\n");
	foreach($questions as $question) {
		echo("\t<LI>" . hyperlink('#' . $question['name'], $question['title']) . "\n");
	}
	echo("</UL>\n");
}
echo("</UL>\n");

foreach($topics as $topic => $questions) {
	foreach($questions as $question) {
		anchor($question['name']);
		$version = array_key_exists('version', $question) ? ' (' . $question['version'] . ')' : NULL;
		paragraph('faq_title', bold($question['title']) . $version);
		foreach($question['text'] as $text) {
			paragraph('faq_answer', $text);
		}
	}
}

?>

</UL>
</FONT>
</BODY>
</HTML>