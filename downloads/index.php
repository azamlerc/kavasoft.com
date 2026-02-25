<?php

include('../products.php'); 
include('../shared.php');

head('KavaSoft - Downloads', $folder);

table_single_1();

echo(spacer_img(10, 10) . $br);
echo(span('mainheader', 'KavaSoft ') . span('grayheader', 'Downloads') . $br);
echo(spacer_img(10, 20) . $br);

$vertical_space = 10;

echo(div("$class box_header", 'Mac OS X compatibility'));

echo('<table class="box" border="0" cellpadding="2" cellspacing="0" width="100%">');

echo(tr(array(td('stuff', ''), td('stuff', ''),
	td('stuff', img('../images/macosx/jaguar.png', 'Jaguar', 120, 128), 
		180, null, null, null, 'align="center"'),
	td('stuff', img('../images/macosx/panther.png', 'Panther', 120, 128), 
		180, null, null, null, 'align="center"'),
	td('stuff', img('../images/macosx/tiger.png', 'Tiger', 120, 128), 
		180, null, null, null, 'align="center"'),
	td('stuff', img('../images/macosx/leopard.png', 'Leopard', 128, 128), 
		180, null, null, null, 'align="center"'),
	td('stuff', img('../images/macosx/snow_leopard.png', 'Snow Leopard', 128, 128), 
		180, null, null, null, 'align="center"'))));

echo(tr(array(td('stuff', ''), td('stuff', ''),
	td('stuff', "Jaguar 10.2.8", null, 40, null, null, 'align="center"'),
	td('stuff', "Panther 10.3.9", null, 40, null, null, 'align="center"'),
	td('stuff', "Tiger 10.4", null, 40, null, null, 'align="center"'),
	td('stuff', "Leopard 10.5", null, 40, null, null, 'align="center"'),
td('stuff', "Snow Leopard 10.6", null, 40, null, null, 'align="center"'))));

function version_cell($product, $version) {
	if ($version == 'current') {
		$file = $product['icon'] . '.dmg';
		$version = $product['version'];
		$link = hyperlink($file, "version $version", 'sidebar_link');
	} else if ($version != null) {
		$file = $product['icon'] . str_replace('.', '', $version) . '.dmg';
		$link = "version $version"; // hyperlink($file, "version $version", 'sidebar_link'); // old versions taken offline
	} else {
		$link = '&mdash;';
	}
	return td('text', $link, null, null, null, null, 'align="center"');
}

function app_row($class, $key, $version1, $version2, $version3, $version4, $version5) {
	global $products;
	global $discontinued_products;
	
	$product = $products[$key];
	if ($product == null) $product = $discontinued_products[$key];
	$name = $product['name'];
	$icon = $product['icon'];
	$link = $product['link'];
	$image = img("/images/apps/$icon-64.png", $name, 48, 48);
	
	if ($name == 'Shoebox Pro') $name = "Shoebox";
	if ($name == 'Character Converter') $name = "Character&nbsp;Converter";
	
	echo(tr(array(td('stuff', hyperlink("../$icon/", $image, 'otherapps')),
		td('stuff', '&nbsp;' . hyperlink("../$icon/", $name, 'otherapps')),
		version_cell($product, $version1),
		version_cell($product, $version2),
		version_cell($product, $version3),
		version_cell($product, $version4),
		version_cell($product, $version5)), $class));

}

app_row('oddrow', 'kavamovies',   null,    null,    null, 'current', 'current');
app_row('evenrow', 'kavatunes',   null,    null, '3.5.1', 'current', 'current');
app_row('oddrow', 'kavaservices', null,    null, '3.2.2',   '3.2.2', 'current');
app_row('evenrow', 'hyperimage',  null,    null,   '1.0', '2.1.2', 'current');
app_row('oddrow', 'curator',      null,    null, '1.1.4', 'current', 'current');
app_row('evenrow', 'shoebox_pro', null, '1.6.1', '1.7.5', '1.7.5', 'current');
app_row('oddrow', 'iconquer', '2.3.2', '2.4.3', '2.4.6', 'current', 'current');

app_row('evenrow', 'itunes_catalog', '1.7', '1.8.4', '2.2.2', null, null);
app_row('oddrow', 'character_converter', '1.2.2', '1.3.3', null, null, null);
app_row('evenrow', 'translation_service', '1.2.3', '1.2.8', null, null, null);

echo('</table>');

table_single_2();

footer();

?>