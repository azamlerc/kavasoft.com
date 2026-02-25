<?php 
$doc_root = '../';

$title = 'Shoebox';
$folder = 'Shoebox';
$slogan = 'Categories';

include('../../shared.php');
include('examples.php');

head($title . " - Categories", $folder);

table_1(300, 925);

$links = '';
foreach($all_categories as $type => $categories) {
	foreach($categories as $category) {
		
		$name = $category['name'];
		$filename = $category['filename'];
		$example = $category['example'];
		$description = $category['description'];
		
		$links .= hyperlink("index.php#$name", $name, 'sidebar_link');
		if ($name != 'Sports Teams') $links .= ' &bull '; 
	}
}

box('sidebar', 'Index', $links);

$export_link = hyperlink('../help/pgs/sharingcategories.htm', 'Export them', 'darker');
$email_link = hyperlink($email_address, 'send them to us', 'darker');
$import_link = hyperlink('../help/pgs/sharingcategories.htm#importing', 'import it', 'darker');

box('sidebar', 'Share your categories', "Have you created some categories that you'd like to share with other Shoebox users? $export_link to a pair of HTML and XML files, $email_link, and we'll post them!");

box('sidebar', 'Quick tip', "To create lots of categories quickly, type them into a text file and $import_link.");

table_2(600);

box('text', 'Categories', "Here are some categories to get you started quickly with Shoebox.");

function icon_row($icon, $text, $width) {
	return "<tr><td width=\"$width\" valign=\"top\">$icon</td><td valign=\"middle\">$text</td></tr>";
}

foreach($all_categories as $type => $categories) {
	$stuff = "<table width=\"100%\" border=\"0\" cellpadding=\"7\" cellspacing=\"0\">";

	foreach($categories as $index => $category) {
		
		$name = $category['name'];
		$filename = $category['filename'];
		$example = $category['example'];
		$description = $category['description'];
		$anchor = anchor_link($name);
		
		$file_path = 'examples/' . $type . '/' . $category['filename'];
		$preview_link = $file_path . '.html';
		$import_link = 'shoebox://www.kavasoft.com/Shoebox/categories/' . $file_path . '.xml';
				
		$icon = hyperlink($preview_link, img($file_path . '.jpg', $category['name'], 130, 99, 'align="left"'));
		$title = hyperlink($import_link, $category['name'], 'darker');

		$example = substr($example, 1);
		$example = str_replace('/', " $submenu ", $example);
		
		$links = hyperlink($preview_link, 'preview', 'sidebar_link') . ' | ' .
				 hyperlink($import_link, 'install', 'sidebar_link');
		
		$stuff .= icon_row($icon, "$anchor$title$br$description$br" . div('example', $example) . $links, 130);
		
		// if ($index < count($categories) - 1) $stuff .= "$br$br";
	}
	
	$stuff .= '</table>';
	
	box('text', $type, $stuff);
}

?>
