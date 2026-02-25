<?php 

$page_name = 'download';
$doc_root = '../';
$lang = 'en';

include($doc_root . '../shared/include.php');
include(local_path('whatsnew.php'));

head($title);
banner($banner_alt, 200);
table_top();

one_cell();

echo('<table border="0" width="100%" cellspacing="0" cellpadding="2">');

foreach ($download_content as $topic => $topic_features) {
	header_cell($topic);
	spacer_cell();
	
	foreach ($topic_features as $index => $feature) {
		if ($index % 2 == 0) echo('<tr>' . td('', '&nbsp;', 20));

		$title = array_key_exists('title', $feature) ? $feature['title'] : null;
		$link = array_key_exists('link', $feature) ? $feature['link'] : null;
		$local_link = array_key_exists('local_link', $feature) ? $feature['local_link'] : null;
		$popup_link = array_key_exists('popup_link', $feature) ? $feature['popup_link'] : null;
		
		$icon = img('../../images/icons/' . $feature['icon'], $title, 32, 32);
		if ($link) $icon = hyperlink($link, $icon);
		
		if ($title) $title = bold($feature['title']);
		if ($title && $link) $title = hyperlink($link, $title);
		if ($title) $title .= $br;
		
		echo(td('', $icon, 39, 32));
		echo(td('features', $title . $feature['text'], 290));

		if ($index % 2 == 1) echo('</tr>');
	}

	spacer_cell();
}

	header_cell($whats_new);
	echo('<tr><td></td><td colspan=5>');
	
# What's new?
anchor('whatsnew');
foreach($versions_to_show as $vers) {
	anchor('version' . $vers);
	paragraph('sidebar', 'Version ' . $vers, NULL);
	unordered_list($whatsnew_arrays[$vers], 'whatsnew');
}
	echo('</td></tr></table>');

table_bottom($page_name, $store_product); 

?>
