<?php

$faq_title = "KavaTunes - FAQ";
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
		"KavaTunes can display artwork, name, time, size, bit rate, file type, play count, date added, date played, rating and year information for your music.<ul><li>To change which columns are displayed in the outline, check them in the View $arrow Columns menu.</li><li>To change the sort order, click a column header or select a column from the View $arrow Sort By menu.</li></ul>",
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
		"Compilations albums have music by more than one artist. KavaTunes identifies albums as compilations if the \"part of a compilation\" checkbox is checked in iTunes.",
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
		"Most music files don't come with the correct year. KavaTunes can <a href=\"years.htm\">look up years</a> on Amazon and copy them to your library.",
	)),
	array(
	'name' => 'play_music',
	'title' => 'How can I play music in my web catalogs?',
	'text' => array(
		"Catalogs can play music using the QuickTime plugin. Catalogs can link to music on your hard disk using <tt>file://</tt> URLs, or link to music that is shared by your web server. You can choose how catalogs link to music in the <a href=\"musicprefs.htm\">Music preferences</a>.",
	)),
	array(
	'name' => 'windows',
	'title' => 'Can I make catalogs of music on my Windows PC?',
	'text' => array(
		"KavaTunes only runs on Mac OS X. However, you can use KavaTunes on a Mac to make catalogs of your iTunes music on your PC. Just copy the file <tt>My Documents\My Music\iTunes\iTunes Music Library.xml</tt> from your PC to a Mac, open the file with KavaTunes, <i>et voila!</i>",
	)),
),
'Artwork' => array (
	array(
	'name' => 'artwork_column',
	'title' => 'How can I tell which albums have artwork?',
	'text' => array(
		"The artwork column shows which albums have artwork. The dot on the left shows whether KavaTunes has cached the artwork in the album's folder. The dot on the right shows whether iTunes has added artwork to the music itself. Green shows that there is artwork, yellow that there is some artwork, and red that there is no artwork.
			For example:
			<blockquote>
			$green_green_dots&nbsp;&nbsp;There is artwork in both.<BR>
			$green_red_dots&nbsp;&nbsp;There is artwork in KavaTunes. Double-click to <a href=\"addingartwork.htm\">copy artwork</a> to iTunes.<BR>
			$red_green_dots&nbsp;&nbsp;There is artwork in iTunes. Double-click to <a href=\"gettingartwork.htm\">get artwork</a> from iTunes.<BR>
			$red_red_dots&nbsp;&nbsp;There is no artwork. Double-click to <a href=\"gettingartwork.htm\">get artwork</a> from Amazon.
			</blockquote>",
	)),
	array(
	'name' => 'delete_artwork',
	'title' => 'How do I change incorrect artwork for an album?',
	'text' => array(
		"If KavaTunes downloads incorrect artwork from Amazon, try performing a <a href=\"searchingartwork.htm\">custom search</a>. You can edit the artist and album names used for the search, and choose from among ten search results.",
		"You can delete artwork by choosing Artwork $arrow Delete Artwork. KavaTunes generally won't overwrite existing artwork, so you can replace artwork by deleting it first and then choosing " . help_link("gettingartwork.htm", "Get Artwork") . " again.",
	)),
	array(
	'name' => 'delete_artwork_itunes',
	'title' => 'How do I change incorrect artwork in iTunes?',
	'text' => array(
		"KavaTunes will not replace existing " . help_link("addingartwork.htm", "artwork") . " in iTunes. If an album has the wrong artwork, you can choose Artwork $arrow Delete Artwork from iTunes to remove the incorrect artwork, and then Artwork $arrow Copy Artwork to iTunes to copy the correct artwork.",
	)),
	array(
	'name' => 'delete_icons',
	'title' => 'How do I change incorrect or low-resolution icons in the Finder?',
	'text' => array(
		"KavaTunes will not replace existing " . help_link("customicons.htm", "custom icons") . ". If a folder has the wrong artwork, you can choose Artwork $arrow Delete Custom Icon to remove the incorrect one, and then Artwork $arrow Create Custom Icon to make a new one.", "KavaTunes 3.5.1 improves the resolution of icons from 128 to 512 pixels. On Mac OS X Leopard, icons created by previous versions of the program may look grainy. You can hold down the option key when choosing the above commands to delete and create icons for all folders.",
	)),
	array(
	'name' => 'amazon_country',
	'title' => 'Can I search international Amazon sites?',
	'text' => array(
		"In the " . help_link('artworkprefs.htm', 'Artwork preferences') . ", you can choose which Amazon country site to use: Canada, France, Germany, Japan, the United Kingdom or the United States.",
	)),
),
'Catalogs' => array (
	array(
	'name' => 'catalog_folder',
	'title' => 'Where is the catalog published to?',
	'text' => array(
		"The catalog is published to either the webserver documents folder (<tt>/Library/WebServer/Documents</tt>) or your Sites folder (<tt>~/Sites</tt>). You can choose exactly where to save the catalog in the " . help_link('publishingprefs.htm', 'Publishing') . " preferences.",
		"You can make your catalog available using Personal Web Sharing, or copy the catalog to your web server. KavaTunes can also " . help_link("publishingftp.htm", "publish") . " the catalog directly to your web server using FTP.",
	)),
	array(
	'name' => 'what_is_php',
	'title' => 'What is PHP?',
	'text' => array(
		hyperlink('http://www.php.net', 'PHP', 'target="_top"') . " is a widely-used general-purpose scripting language that is  especially suited for Web development and can be embedded into HTML. PHP is a recursive acronym that stands for <i>PHP: Hypertext Preprocessor</i>.",
		"KavaTunes uses PHP to create dyanmic, searchable catalogs. Rather than having thousands of static HTML files, catalogs contain separate files for templates, logic and data.",
	)),
	array(
	'name' => 'enable_php',
	'title' => 'How can I enable PHP on my computer?',
	'text' => array(
		"Personal Web Sharing includes support for PHP, although it is disabled by default. You can " . help_link('publishingprefs.htm', 'enable PHP') . " in the Publishing preferences of KavaTunes.",
	)),
	array(
	'name' => 'support_php',
	'title' => 'Does my web server support PHP?',
	'text' => array(
		"You can test whether your " . help_link("servers.htm", "server") . " supports PHP by uploading your catalog. If PHP is not enabled, the catalog will display a message saying so. ",
		"Most full-featured web servers support PHP with no configuration necessary. In some cases, you may need to request that PHP be enabled for your account. Other servers like .Mac do not support PHP. If you're not sure, ask your server administrator. ",
		"If you don't have a server that supports PHP and FTP, choose &ldquo;Get Hosting&rdquo; from the application menu. KavaSoft has partnered with " . hyperlink('http://secure.hostforweb.com/ua/clickthru.cgi/kavasoft', 'Host for Web', 'target="_top"') . " to offer full-featured web hosting from only $4.99 per month. As an added benefit, you can get a personalized domain name for your website.",
	)),
	array(
	'name' => 'what_is_ftp',
	'title' => 'What is FTP?',
	'text' => array(
		"FTP stands for <i>File Transfer Protocol</i>, and is a protocol for transferring files between computers. KavaTunes can use FTP to " . help_link('publishingftp.htm', 'publish') . " the catalog to your web server.",
	)),
	array(
	'name' => 'support_ftp',
	'title' => 'Does my web server support FTP?',
	'text' => array(
		"Most web servers support using FTP to upload files. If you're not sure, ask your server administrator.",
		"If your server doesn't support FTP, you can publish your catalog locally and then copy files from your webserver documents folder.",
	)),
	array(
	'name' => 'forbidden_leopard',
	'title' => 'Why do I get a 403 Forbidden message when I publish my catalog to my personal site?',
	'text' => array(
		"If you get a 403 Forbidden error when publishing your catalog to your personal site on Leopard, you may need to configure your web server to allow access to your personal site. Here are " . hyperlink('http://www.gigoblog.com/2007/11/08/configure-apache-web-sharing-for-user-accounts-in-mac-os-x-105-leopard/', 'full instructions')  . ".",
	)),
	array(
	'name' => 'forbidden',
	'title' => 'Why do I get a 403 Forbidden message when I share music?',
	'text' => array(
		"You can set up music sharing in the " . help_link("servers.htm", "Music") . " preferences. KavaTunes can create an alias in your webserver documents folder that points to your music folder. This allows you to stream music from your Mac running personal web sharing to the catalog. ",
		"If you get a 403 Forbidden error, then your web server may be configured to not follow aliases into your home folder. In this case, it is advisiable to move your music folder to a location outside of your home folder. You can tell iTunes which music folder to use in the Avanced preferences. Then restart KavaTunes and click the “Share Music…” button again to recreate the alias.",
	)),
	array(
	'name' => 'popups',
	'title' => "Why doesn't the video window open?",
	'text' => array(
		"The video window may not open, or videos may not play continously, if your web browser has a pop-up window blocker. For best results, in Safari uncheck \"Block Pop-Up Windows\" in the application menu. In OmniWeb, go to Site Preferences > Ad Blocking and choose to never block pop-up windows.",
	)),
	array(
	'name' => 'customize',
	'title' => 'How can I customize the catalog?',
	'text' => array(
		"You can " . help_link('customizing.htm', 'customize') . " the appearance of catalogs, modify catalog logic, or create entirely new templates. Consult the " . hyperlink($GLOBALS['help_path'] . 'phpdoc/', 'PHP documentation', 'target="_top"') . " for class and function definitions.",
		"If you have created something cool that you'd like us to know about, " . hyperlink('&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#105;&#110;&#102;&#111;&#64;&#107;&#97;&#118;&#97;&#115;&#111;&#102;&#116;&#46;&#99;&#111;&#109;', 'email us') . " your code and we can include your contributions in the next version of KavaTunes!",
	)),
),
);

?>