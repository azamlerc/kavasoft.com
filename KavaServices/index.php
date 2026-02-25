<?php

include($doc_root . '../products.php');

# Page title
$page_name = 'home';
$doc_root = './';
$title = 'KavaServices';
$folder = 'KavaServices';
$store_product = 'kavaservices';
$slogan = 'Services to translate, search, encode, calculate, convert&hellip; and much more!';

$euro = "<span class=\"euro\">&euro;</span>";

include($doc_root . '../shared.php');

head($title, $folder);

$language_table = '<table width="100%" height="90" cellpadding="0" cellspacing="0"><tr>';
$languages = array('zh', 'nl', 'en', 'fr', 'de', 'el', 'it', 'ja', 'ko', 'pt', 'ru', 'es');
foreach ($languages as $index => $language) {
	$language_table .= td('sidebar', img("../images/flags/$language.png", $language, 32, 32), 
		null, null, null, null, 'align="center" valign="middle"');
	if ($index == 5) $language_table .= '</tr><tr>';
}
$language_table .= '</tr></table>';

table_1();

tour_box();

function ks_download_box($stuff) {
	global $folder;
	global $product_version;
	global $product_size;
	global $br;

	box('sidebar', 'Download', '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td valign="top" width="90">' . 		
		hyperlink("/$folder.dmg", img('/images/buttons/download.png', 'Download', 90, 80)) .
		'</td><td valign="top" class="sidebar">' . 
		hyperlink("/$folder.dmg", "Download version $product_version $br for Snow Leopard", 'sidebar_link') . 
		" $br $product_size disk image $br$br" .
		hyperlink("/downloads/KavaServices322.dmg", "Download version 3.2.2 $br for Tiger &amp; Leopard", 'sidebar_link') . 
		" $br 1.7 MB disk image" . '</td></tr></table>');
}

ks_download_box("English $br$br");

buy_box("Upgrade for $15 from Translation&nbsp;Service or Character&nbsp;Converter", "/store/upgrade.php?product=kavaservices_ts_upgrade");
quotes_box('sidebar');
whatsnew_box();

$spacer8 = img('/images/spacer.gif', '', 8, 8);

requirements_box(array('snow leopard', '64bit', 'compatibility', "$spacer8$br Services work in all Cocoa applications, and some Carbon applications."));

box('sidebar', 'Installation', "1. Download KavaServices, and copy the program to your Applications folder. $br$spacer8$br 2. Launch the program, and choose &ldquo;Update Services Menu&rdquo; from the application menu. $br$spacer8$br 3. In the Keyboard pane of System Preferences, click the Keyboard Shortcuts tab. Check the services you would like to use.");

box('sidebar', 'Languages', "$language_table KavaServices translates between Afrikaans, Albanian, Arabic, Armenian, Azerbaijani, Basque, Belarusian, Bulgarian, Catalan, Chinese, Croatian, Czech, Danish, Dutch, English, Estonian, Filipino, Finnish, French, Galician, Georgian, German, Greek, Haitian Creole, Hebrew, Hindi, Hungarian, Icelandic, Indonesian, Irish, Italian, Japanese, Korean, Latin, Latvian, Lithuanian, Macedonian, Malay, Maltese, Norwegian, Persian, Polish, Portuguese, Romanian, Russian, Serbian, Slovak, Slovenian, Spanish, Swahili, Swedish, Thai, Turkish, Ukrainian, Urdu, Vietnamese, Welsh, and Yiddish.");

box('sidebar', 'Suggestion Box', hyperlink($email_address, 
	"What else would you like KavaServices to do? Send us your ideas and win a free copy!", 'sidebar_link'));

/* box('sidebar', 'Also Recommended', hyperlink("http://web.sabi.net/nriley/software/", 
	"Add the Services menu back to the main menubar with ICeCoffEE", 'sidebar_link') . ', and ' . 
	hyperlink("http://www.manytricks.com/servicescrubber/", 
	"clean up the Services menu using Service Scrubber.", 'sidebar_link')); */

/*
box('sidebar', 'Upgrade', 
	hyperlink("/store/upgrade.php?product=kavaservices_cc_upgrade", 
		"Upgrade from Character Converter for $10", 'sidebar_link') . $br . 	
	hyperlink("/store/upgrade.php?product=kavaservices_ts_upgrade", 
		"Upgrade from Translation Service for $10", 'sidebar_link') . $br .
		"Upgrade from KavaServices 2 or 3 for free");
*/

questions_box(array(/*'faq', 'help',*/ 'orders', 'service', 'pr', 'contact'));

table_2(); 

box('text', 'About KavaServices', "KavaServices can add commands to the Services menu that let you:<ul>

<li>Translate text back and forth between 58 languages</li>
<li>Move and copy files to particular folders</li>
<li>Search websites like Google, Wikipedia, YouTube and more</li>
<li>Encode special characters into HTML entities or URL links</li>
<li>Calculate mathematical expressions</li>
<li>Convert currencies and other units</li>
<li>Convert to or from Roman numerals</li>
<li>Sort lines, remove duplicates and remove blank lines</li>
<li>Convert to lowercase, uppercase or title case</li>
<li>Convert accented characters to plain ASCII text</li>
<li>Convert Serbian text between Latin and Cyrillic alphabets</li>
<li>Calculate MD5 and SHA1 checksums</li>
<li>Execute terminal commands</li>
</ul>

These commands will replace the selected text in any Mac OS X application, just like magic. You don&rsquo;t need to switch to a different program, or even copy and paste. $br$br KavaServices is highly customizable. You can select which commands you'd like to appear in the Services menu, and you can add custom unit conversions and web searches.");

screenshot(600, 375, 1200, 750);

features_box();

$row = 0;
function rowclass($row) {
	return $row % 2 == 1 ? 'oddrow' : 'evenrow';
}

$examples .= tr(array(
	td('class', "Command"), 
	td('class', "Before"), 
	td('class', "After")), rowclass($row++));
$examples .= tr(array(
	td('class', "Translate to French"), 
	td('class', "Hello"), 
	td('class', "Bonjour")), rowclass($row++));
$examples .= tr(array(
	td('class', "Translate from Russian"), 
	td('class', "&#x417;&#x434;&#x440;&#x430;&#x432;&#x441;&#x442;".
		"&#x432;&#x443;&#x439;&#x442;&#x435;"), 
	td('class', "Hello")), rowclass($row++));
$examples .= tr(array(
	td('class', "Calculate"), 
	td('class', "1 AU/c"), 
	td('class', "8.31675359 minutes")), rowclass($row++));
$examples .= tr(array(
	td('class', "Calculate"), 
	td('class', "&pound;0.87/litre in $/gallon"), 
	td('class', "$4.55/gallon")), rowclass($row++));
$examples .= tr(array(
	td('class', "Convert to Roman Numerals"), 
	td('class', "2012"), 
	td('class', "MMXII")), rowclass($row++));
$examples .= tr(array(
	td('class', "Convert Dollars to Euro"), 
	td('class', "$700 billion"), 
	td('class', "$euro" . "540 billion")), rowclass($row++));
$examples .= tr(array(
	td('class', "Convert to Fahrenheit"), 
	td('class', "100 degrees"), 
	td('class', "212 degrees")), rowclass($row++));
$examples .= tr(array(
	td('class', "HTML Encode"), 
	td('class', "r&eacute;sum&eacute;"), 
	td('class', "r&amp;eacute;sum&amp;eacute;")), rowclass($row++));
$examples .= tr(array(
	td('class', "HTML Decode"), 
	td('class', "&amp;hearts;"), 
	td('class', "&hearts;")), rowclass($row++));
$examples .= tr(array(
	td('class', "URL Encode"), 
	td('class', "path to file"), 
	td('class', "path%20to%20file")), rowclass($row++));
$examples .= tr(array(
	td('class', "URL Decode"), 
	td('class', "path%20to%20file"), 
	td('class', "path to file")), rowclass($row++));
$examples .= tr(array(
	td('class', "Convert to ASCII"), 
	td('class', "&agrave;&aacute;&acirc;&atilde;&#x101;&#x103;&auml;&aring;&#x105;"), 
	td('class', "aaaaaaaaa")), rowclass($row++));
$examples .= tr(array(
	td('class', "Sort Lines"), 
	td('class', "Third / Second / First"), 
	td('class', "First / Second / Third")), rowclass($row++));
$examples .= tr(array(
	td('class', "Convert to Lowercase"), 
	td('class', "E E Cummings"), 
	td('class', "e e cummings")), rowclass($row++));
$examples .= tr(array(
	td('class', "Convert to Titlecase"), 
	td('class', "the quick brown fox"), 
	td('class', "The Quick Brown Fox")), rowclass($row++));
$examples .= tr(array(
	td('class', "Convert to Uppercase"), 
	td('class', "openstep"), 
	td('class', "OPENSTEP")), rowclass($row++));
$examples .= tr(array(
	td('class', "Search Google Maps"), 
	td('class', "white house"), 
	td('class', hyperlink('http://maps.google.com/maps?q=white%20house', 'White House map', 'darker', 'target="example"'))), rowclass($row++));
$examples .= tr(array(
	td('class', "Search Wikipedia"), 
	td('class', "barack obama"), 
	td('class', hyperlink('http://en.wikipedia.org/wiki/Barack_obama', 'Barack Obama article', 'darker', 'target="example"'))), rowclass($row++));
$examples .= tr(array(
	td('class', "Serbian to Cyrillic"), 
	td('class', "Ljubazni fenjerdžija"), 
	td('class', "&#x409;&#x443;&#x431;&#x430;&#x437;&#x43D;&#x438; &#x444;&#x435;&#x45A;&#x435;&#x440;&#x45F;&#x438;&#x458;&#x430;")), rowclass($row++));
$examples .= tr(array(
	td('class', "Serbian to Latin"), 
	td('class', "&#x438;&#x43D;&#x458;&#x435;&#x43A;&#x446;&#x438;&#x458;&#x430;"), 
	td('class', "injekcija")), rowclass($row++));
$examples .= tr(array(
	td('class', "MD5 Checksum"), 
	td('class', "Hello, world!"), 
	td('class', "6cd3556deb0da54bca060&hellip;")), rowclass($row++));
$examples .= tr(array(
	td('class', "SHA1 Checksum"), 
	td('class', "Hello, world!"), 
	td('class', "943a702d06f34599aee1f&hellip;")), rowclass($row++));
$examples .= tr(array(
	td('class', "Execute Command"), 
	td('class', "date"), 
	td('class', "Sat Jul 24 23:32:02 2012")), rowclass($row++));
$examples .= tr(array(
	td('class', "Execute Command"), 
	td('class', "whoami"), 
	td('class', "andrew")), rowclass($row++));
	
	
box('text', 'Examples', "<table border=\"0\" cellspacing=\"0\" cellpadding=\"3\" width=\"100%\">$examples</table>");

/*

box('text', 'Translate', "Suppose you want to translate a sentence in a TextEdit document from English to French. Select the sentence and choose Services $submenu Translate $submenu English &rarr; French. The sentence will be translated in-place, just like magic. You don&rsquo;t need to copy-and-paste, or even switch to a different program. $br$br KavaServices translates back and forth from English to Chinese, Dutch, French, German, Greek, Italian, Japanese, Korean, Portuguese, Russian and Spanish. Le&nbsp;programme traduit aussi dans les deux sens de fran&ccedil;ais &agrave; l&rsquo;allemand, l&rsquo;espagnol, le grec, le hollandais, l&rsquo;italien et le portugais.");

box('text', 'Calculate', "To calculate a mathematical expression, choose Services $submenu Calculate. The selected expression will be replaced by its result. You can calculate basic arithmetic, trigonometry, unit conversions, currency conversions, arithmetic with scientific units, base conversions, and more.");

box('text', 'Convert', "Suppose you are reading an article on the web that mentions &ldquo;$euro"."16 billion,&rdquo; and you want to know how much that is. Select the amount, choose Services $submenu Convert $submenu Euro to Dollars, and the selection will be replaced with &ldquo;$23.47 billion,&rdquo; right in the middle of the article.");

box('text', 'HTML Entities', "HTML files can only contain plain English letters, numbers and basic punctuation. Accented characters, characters in other alphabets and special punctuation marks need to be encoded in a special format. To convert special characters to HTML, choose Services $submenu HTML Entities $submenu Encode into HTML. To go the other way, choose Decode from HTML.");

box('text', 'Execute', "KavaServices lets you execute terminal commands from any application. For example, if you type select the command &ldquo;whoami&rdquo; and choose Services $submenu Execute Command, the selection will be replaced by your username.</ul>");

*/

table_3(); 

other_programs($title);

footer(); 

?>

