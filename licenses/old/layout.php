<?php

function gray($text) {
	return "<font color=\"gray\">$text</font>";
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

function div($class, $text) {
	echo("<div class=\"$class\">\n");
	echo ($text);
	echo("</div>\n\n");
}

function input($type, $name, $value) {
	echo("\t<input type=\"$type\" name=\"$name\" value=\"$value\">\n");
}

function paragraph($class, $header, $text) {
	echo("<p class=\"$class\">\n");
	if ($header) echo(bold($header) . "\n");
	if ($header && $text) echo ("<br />\n");
	if ($text) echo ($text);
	echo("</p>\n\n");
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

function tr($rows) {
	$tr = '<tr>';
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
			$list .= "\t<li class=\"$class\">$item\n";
		}
		
		if (!is_array($items[$i + 1])) $list .= "</li>";
	}
	return $list . "</$tag>\n";
}

function head($title) {
	$stylesheet = 'styles.css';
	$favicon = $GLOBALS['favicon'];
	$generator = 'BBEdit 7.0';

	header("Content-type: text/html; charset=utf-8");
	echo("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" " .
		"\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n");
	// echo("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n");
	echo("<html xmlns=\"http://www.w3.org/1999/xhtml\">\n");
	echo("<head>\n\t<title>$title</title>\n"); 
	echo("\t<meta name=\"generator\" content=\"$generator\" />\n");
	echo("\t<link rel=\"shortcut icon\" href=\"$favicon\" type=\"image/x-icon\" />\n");
	echo("\t<link rel=\"stylesheet\" type=\"text/css\" href=\"$stylesheet\" media=\"screen\" />\n");
	echo("</head>\n<body bgcolor=\"#FFFFFF\">\n<center>\n<table width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n");
}

function frame_head($title) {
	$stylesheet = 'styles.css';
	$favicon = $GLOBALS['favicon'];
	$generator = 'BBEdit 7.0';

	echo("<html>\n");
	echo("<head>\n\t<title>$title</title>\n"); 
	echo("\t<meta name=\"generator\" content=\"$generator\">\n");
	echo("\t<link rel=\"shortcut icon\" href=\"$favicon\" type=\"image/x-icon\">\n");
	echo("\t<link rel=\"stylesheet\" type=\"text/css\" href=\"$stylesheet\" media=\"screen\">\n");
	
	echo("</head>\n<body class=\"frame\">\n");
}

function banner($banner_alt, $height = 300, $link = "../index") {
	echo("<tr><td width=\"700\" align=\"center\">");
	$image = local_img('banner.jpg', '', $banner_alt, 700, $height);
	if ($link) $image = local_link($link, $image);
	echo($image);
	echo('</td></tr>');
}

function top_banner($banner_alt) {
	echo("<tr><td width=\"700\" align=center>");
	echo(local_link("../index", local_img('top_banner.jpg', '', $banner_alt, 700, 55)));
	echo('<br /><br /></td></tr>');
}

function table_top() {
	$left_width = 480;
	
	echo("</table><table width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>");
}

function left_cell() {
	$left_width = 480;
	
	echo("<td width=\"$left_width\" colspan=\"$colspan\" valign=\"top\">");
}

function one_cell() {
	echo("<td width=\"700\" valign=\"top\">");
}

function header_cell($title) {
	echo(tr(array(td('features', '&nbsp;' . $title, 700, NULL, 6, NULL, "bgcolor=\"#EEEEEE\""))));
}

function spacer_cell() {
	echo(tr(array(td('features', '' , 700, 8, 4, NULL))));;
}

function right_cell() {
	$right_width = 200;
	
	echo("</td><td width=\"20\"></td><td width=\"$right_width\" valign=top>");
}

function table_bottom($page_name) {
	echo("</td></tr></table><table width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>\n");
	echo("\n<p class=\"footer\" align=\"center\">");
	echo($GLOBALS['copyright']);
	echo("<br />");
	echo($GLOBALS['all_rights_reserved']);
	if ($GLOBALS['show_copyright']) 
		echo("</p><p class=\"footer\" align=center>" . $GLOBALS['personal_copyright']);
	echo("</p>\n</td></tr></table></center>\n</body>\n</html>\n");
}

function frame_bottom() {
	echo("</body>\n</html>\n");
}

?>