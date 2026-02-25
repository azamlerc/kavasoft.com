<?php 

$doc_root = '../';

include($doc_root . '../shared.php');
include('content.php');

echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">\n");
?><!DOCTYPE plist PUBLIC "-//Apple Computer//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<array>
<?php

foreach($pages as $page) {
	$title = htmlspecialchars($page['title']);
	$image = 'images/' . $page['image'];
	$text = htmlspecialchars($page['text']);

	echo("\t<dict>\n");
	echo("\t\t<key>title</key>\n\t\t<string>$title</string>\n");
	echo("\t\t<key>image</key>\n\t\t<string>$image</string>\n");
	echo("\t\t<key>text</key>\n\t\t<string>$text</string>\n");
	echo("\t</dict>\n");
}

?>
</array>
</plist>
