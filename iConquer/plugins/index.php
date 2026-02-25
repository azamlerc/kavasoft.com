<?php 

$doc_root = '../';

$title = 'iConquer';
$folder = 'iConquer';
$slogan = 'Maps';

include('../../shared.php');
include('data.php');

head($title . " - Maps", $folder);

table_1(300, 925);

box('sidebar', 'Downloading', "You can download maps from within iConquer by choosing &ldquo;Get Plug-ins&hellip;&rdquo; from the iConquer application menu. $br$br You can also download maps from this page. Click the install link to download a map directly into iConquer. $br$br Or click the download link, decompress the map plug-in and copy it to your Library $submenu Application Support $submenu iConquer folder.");

$plugin_links = '';
$plugin_names = array();
foreach($plugins as $index => $plugin) {
	$name = $plugin['CFBundleName'];
	$parenthesis = strpos($name, ' (');
	if ($parenthesis) $name = substr($name, 0, $parenthesis);
	if (array_search($name, $plugin_names) === false) {
		$identifier = $plugin['CFBundleIdentifier'];
		$plugin_links .= hyperlink("index.php#$identifier", $name, 'sidebar_link');
		if ($name != 'United States') $plugin_links .= ' &bull; ';
		$plugin_names[] = $name;
	}
}

box('sidebar', 'Maps', $plugin_links);

box('sidebar', 'Developer', hyperlink('../developer/', "Interested in creating your own maps? Making map plug-ins is easy and fun with the iConquer Plug-in Kit.", 'sidebar_link'));

table_2(600);

box('text', 'Maps', "You can play iConquer on a variety of maps by downloading map plug-ins.");

foreach($plugins as $plugin) {
	$identifier = $plugin['CFBundleIdentifier'];

	echo(anchor_link($identifier));

	$title = $plugin['CFBundleName'];
	$description = $plugin['ICComments'];
	$author = $plugin['ICAuthor'];
	if ($author != 'KavaSoft') {
		$author_link = hyperlink($plugin['ICAuthorURL'], $author, 'sidebar_link');
		$description = "$description Created by $author_link.";
	}

	$download_link = $plugin['ICDownload'];
	$install_link = "iconquer://getPlugin?identifier=$identifier";
	$size = $plugin['ICArchiveSize'];
	$links = hyperlink($install_link, 'install', 'sidebar_link') . ' | ' . 
			 hyperlink($download_link, 'download', 'sidebar_link') . " ($size)";
	
	$icon = hyperlink($install_link, img($plugin['ICThumbnail'], $title, 360, 225));
	
	$table = '<table><tr>';
	$table .= td('', $icon, 180, null, null, null, 'valign=top');
	$table .= td('features', $description . $br . $br . $links, null, null, null, null, 'valign=top');
	$table .= '</tr></table>';

	box('text', $title, $table);
}

table_3();

footer();

?>
