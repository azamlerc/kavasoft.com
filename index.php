<?php

include('products.php'); 
include('shared.php');

// if (dutch()) header('Location: http://www.kavafoto.com');

$itunes_catalog_version = $products['itunes_catalog']['version'];
$itunes_catalog_price = $products['itunes_catalog']['price'];

$shoebox_version = $products['shoebox_pro']['version'];
$shoebox_express_price = $products['shoebox_express']['price'];
$shoebox_pro_price = $products['shoebox_pro']['price'];

$iconquer_version = $products['iconquer']['version'];
$iconquer_price = $products['iconquer']['price'];

$curator_version = $products['curator']['version'];
$curator_price = $products['curator']['price'];

$hyperimage_version = $products['hyperimage']['version'];
$hyperimage_price = $products['hyperimage']['price'];

$translation_service_version = $products['translation_service']['version'];
$translation_service_price = $products['translation_service']['price'];

$character_converter_version = $products['character_converter']['version'];
$character_converter_price = $products['character_converter']['price'];

head("KavaSoft", $folder, null, null, ' onload="window.setInterval(\'runSlideShow()\', SlideShowSpeed);"');
?>

<script type="text/javascript"><!-- 
var stopShow = 0;
var SlideShowSpeed = 5000;
var CrossFadeDuration = 3;
var Picture = new Array();

Picture[1]  = 'iConquer/images/iconquer_paris.jpg';
Picture[2]  = 'iConquer/images/iconquer_newyork.jpg';
Picture[3]  = 'iConquer/images/iconquer_4_is_here.png';
Picture[4]  = 'KavaMovies/images/header.jpg';
Picture[5]  = 'HyperImage/images/header.jpg';
Picture[1]  = 'iConquer/images/iconquer_london.jpg';

var tss;
var iss;
var jss = 1;
var pss = Picture.length-1;

var preLoad = new Array();
for (iss = 1; iss < pss+1; iss++){
preLoad[iss] = new Image();
preLoad[iss].src = Picture[iss];}

function runSlideShow(){
    if (document.all){
	    document.images.PictureBox.style.filter="blendTrans(duration=2)";
	    document.images.PictureBox.style.filter="blendTrans(duration=CrossFadeDuration)";
	    document.images.PictureBox.filters.blendTrans.Apply();
	}
    document.images.PictureBox.src = preLoad[jss].src;
    if (document.all) document.images.PictureBox.filters.blendTrans.Play();
    jss = jss + 1;
    if (jss > (pss)) jss=1;
}

//--></script>
<?php

table_single_1();

/*
echo(spacer_img(10, 10) . $br);
echo(span('mainheader', 'KavaSoft') . $br);
*/
echo(spacer_img(10, 10) . $br);

echo('<center>' . hyperlink($doc_root . 'index.php', img('iConquer/images/iconquer_london.jpg', 'iConquer 4 is here.', 925, 400, 'id="PictureBox" name="PictureBox"')) . '</center>');

echo(spacer_img(25, 25));

$vertical_space = 10;

function all_programs($keys, $icon_size) {
	echo('<table width="898" border="0" cellpadding="5" cellspacing="0"><tr>');
	if ($title == 'Shoebox') $title = "Shoebox Pro";
	global $products;
	global $br;
	
	foreach($keys as $key) {
		$product = $products[$key];
		$name = $product['name'];
		$icon = $product['icon'];
		$slogan = $product['slogan'];
		$version = $product['version'];
		$price = $product['price'];
		
		if ($name != 'Shoebox Pro') {
			if ($name == 'Shoebox Express') $name = 'Shoebox';
			echo('<td class="sidebar" align="center" valign="top">');
			echo(hyperlink("$icon/", img("/images/apps/$icon-256.png", 
				$name, $icon_size, $icon_size)));
			echo($br . hyperlink("$icon/", $name, 'hometitle'));
			echo($br . $slogan);
			if (!$product['coming_soon']) {
				echo($br . hyperlink("$icon.dmg", 
					"download version $version", 'sidebar_link'));
			} else {
				echo('<br> coming soon');
			}
			echo($br . hyperlink("store/index.php?$key=1", 
				"buy now for $$price", 'sidebar_link'));
			if ($key == 'shoebox_express') {
				$key = 'shoebox_pro';
				$price = $products[$key]['price'];
				echo(' / ' . hyperlink("store/index.php?$key=1", 
					"$$price", 'sidebar_link'));
			}
			echo('</td>');
		}
	}

	echo('</tr>');
	
	if (count($keys) == 3 && FALSE) {
		echo('<tr><td class="sidebar" align="center" colspan="3">');
		echo(hyperlink("store/index.php?kavalife=1", 'KavaLife: buy all three together for just $80', 'sidebar_link'));
		echo('</td></tr>');
	}
	
	echo('</table>');
}

echo(div("$class box_header", 'KavaSoft applications'));
echo('<table class="box" width="925" border="0" cellpadding="0" cellspacing="0"><tr><td>');
all_programs(array('iconquer', 'kavatunes', 'kavamovies'), 256);
// echo(div("$class box_footer sidebar", center("KavaLife creates interactive websites featuring your photos, music and movies. $br Buy Shoebox Express, KavaTunes &amp; KavaMovies together for $80 (a $100 value)")));

echo(spacer_img(25, 25));

// echo(div("$class box_header", 'More Applications'));
all_programs(array('shoebox_express', 'hyperimage', 'kavaservices', 'curator'), 200);
echo('</td></tr></table>');
/*
if (!dutch()) {
	echo(spacer_img(25, 25));
	foreach ($new_products as $key) {
		$product = $products[$key];
		$newarray[] = hyperlink($product['icon'] . "/", $product['whatsnew'], 'text_link');
	}
	box('box_header', 'What&rsquo;s new?', list_with_tag($newarray, 'foo', 'ul'), false);
}
*/
table_single_2();

footer();

?>