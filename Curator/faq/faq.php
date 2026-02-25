<?php

$faq_title = "Curator - FAQ";
$banner_alt = "FAQ";

$command = '&#8984;';
$shift = '&#8679;';
$option = '&#9095;';
$star = '&#9733';

function help_link($path, $text) {
	return hyperlink($GLOBALS['help_path'] . "pgs/" . $path, $text, "target=\"_top\"");
}

$green_green_dots = img($GLOBALS['help_path'] . 'gfx/green_green.jpg', 'Artwork dots', 25, 12);
$green_red_dots = img($GLOBALS['help_path'] . 'gfx/green_red.jpg', 'Artwork dots', 25, 12);
$red_green_dots = img($GLOBALS['help_path'] . 'gfx/red_green.jpg', 'Artwork dots', 25, 12);
$red_red_dots = img($GLOBALS['help_path'] . 'gfx/red_red.jpg', 'Artwork dots', 25, 12);

$arrow = '&nbsp;<font color=gray size=-2>&#9654;</font>';

$topics = array(
'Music' => array(
	array(
	'name' => 'info_displayed',
	'title' => 'How do I change what information is displayed?',
	'text' => array(
		"Curator can display artwork, name, time, size, bit rate, file type, play count, date added, date played, rating and year information for your music.<ul><li>To change which columns are displayed in the outline, check them in the View $arrow Columns menu.</li><li>To change the sort order, click a column header or select a column from the View $arrow Sort By menu.</li></ul>",
	)),
	array(
	'name' => 'genres',
	'title' => 'How can I choose whether genres are displayed?',
	'text' => array(
		"If you don't want to organize your music library by genre, you can choose to arrange artists alphabetically in the <a href=\"catalogprefs.htm\">Catalog preferences</a>. You can also uncheck View $arrow Show Genres.",
	)),
	array(
	'name' => 'compilations',
	'title' => 'How can I change how compilations are displayed?',
	'text' => array(
		"Compilations albums have music by more than one artist. Curator identifies albums as compilations if the \"part of a compilation\" checkbox is checked in iTunes.",
		"If you don't want to group compilations together, you can choose to arrange compilations separately by artist in the <a href=\"catalogprefs.htm\">Catalog preferences</a>. You can also uncheck View $arrow Group Compilations.",
	)),
	array(
	'name' => 'expand_all',
	'title' => 'How can I quickly expand or collapse all items?',
	'text' => array(
		"To expand all items to the next level, either choose Select All (&#8984;A) and then hit the right arrow key (&rarr;), or choose View $arrow Expand All (&#8679;&#8984;&rarr;). For example, expanding once will show all albums, and expanding again will show all songs.",
		"To collapse all items, either choose Select All (&#8984;A) and then hit the left arrow key (&larr;), or choose View $arrow Collapse All (&#8679;&#8984;&larr;). For example, collapsing once will show just genres.",
	)),
	array(
	'name' => 'type_to_select',
	'title' => 'How can I quickly select music in the list?',
	'text' => array(
		"You can type part of an item's name in the Search field and then hit return. The first artist, album, or song matching the search term will be selected.",
		"You can also just start typing the name of an artist, album, or song. For example, to select \"The Beatles\", just type <i>b-e-a</i> (\"the\" is ignored). Typing the name will only select visible items.",
	)),
	array(
	'name' => 'years',
	'title' => 'How do I add year info to my library?',
	'text' => array(
		"Most music files don't come with the correct year. Curator can <a href=\"years.htm\">look up years</a> on Amazon and copy them to your library.",
	)),
),
'Artwork' => array (
	array(
	'name' => 'artwork_column',
	'title' => 'How can I tell which albums have artwork?',
	'text' => array(
		"The artwork column shows which albums have artwork. The dot on the left shows whether Curator has cached the artwork in the album's folder. The dot on the right shows whether iTunes has added artwork to the music itself. Green shows that there is artwork, yellow that there is some artwork, and red that there is no artwork.
			For example:
			<blockquote>
			$green_green_dots&nbsp;&nbsp;There is artwork in both.<BR>
			$green_red_dots&nbsp;&nbsp;There is artwork in Curator. Double-click to <a href=\"addingartwork.htm\">copy artwork</a> to iTunes.<BR>
			$red_green_dots&nbsp;&nbsp;There is artwork in iTunes. Double-click to <a href=\"gettingartwork.htm\">get artwork</a> from iTunes.<BR>
			$red_red_dots&nbsp;&nbsp;There is no artwork. Double-click to <a href=\"gettingartwork.htm\">get artwork</a> from Amazon.
			</blockquote>",
	)),
	array(
	'name' => 'delete_artwork',
	'title' => 'How do I change incorrect artwork for an album?',
	'text' => array(
		"If Curator downloads incorrect artwork from Amazon, try performing a <a href=\"searchingartwork.htm\">custom search</a>. You can edit the artist and album names used for the search, and choose from among ten search results.",
		"You can delete artwork by choosing Artwork $arrow Delete Artwork. Curator generally won't overwrite existing artwork, so you can replace artwork by deleting it first and then choosing " . help_link("gettingartwork.htm", "Get Artwork") . " again.",
	)),
	array(
	'name' => 'delete_artwork_itunes',
	'title' => 'How do I change incorrect artwork in iTunes?',
	'text' => array(
		"Curator will not replace existing " . help_link("addingartwork.htm", "artwork") . " in iTunes. If an album has the wrong artwork, you can choose Artwork $arrow Delete Artwork from iTunes to remove the incorrect artwork, and then Artwork $arrow Copy Artwork to iTunes to copy the correct artwork.",
	)),
	array(
	'name' => 'delete_icons',
	'title' => 'How do I change incorrect or low-resolution icons in the Finder?',
	'text' => array(
		"Curator will not replace existing " . help_link("customicons.htm", "custom icons") . ". If a folder has the wrong artwork, you can choose Artwork $arrow Delete Custom Icon to remove the incorrect one, and then Artwork $arrow Create Custom Icon to make a new one.", "Curator 1.1.4 improves the resolution of icons from 128 to 512 pixels. On Mac OS X Leopard, icons created by previous versions of the program may look grainy. You can hold down the option key when choosing the above commands to delete and create icons for all folders.",
	)),
	array(
	'name' => 'amazon_country',
	'title' => 'Can I search international Amazon sites?',
	'text' => array(
		"In the " . help_link('artworkprefs.htm', 'Artwork preferences') . ", you can choose which Amazon country site to use: Canada, France, Germany, Japan, the United Kingdom or the United States.",
	)),
),
);

?>