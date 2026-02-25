<?php

$faq_title = "HyperImage - FAQ";
$banner_alt = "FAQ";

$command = '&#8984;';
$shift = '&#8679;';
$option = '&#9095;';
$star = '&#9733';

function help_link($path, $text) {
	return hyperlink($GLOBALS['help_path'] . "pgs/" . $path, $text, "target=\"_top\"");
}

$browse_link = help_link("browsing.htm", "browse");
$uppercase_browse_link = help_link("browsing.htm", "Browse");
$uppercase_view_link = help_link("viewing.htm", "View");
$browsing_link = help_link("browsing.htm", "browsing");
$browser_link = help_link("browsing.htm", "browser");
$category_browser_link = help_link("browsing.htm", "category browser");
$toolbar_link = help_link("toolbar.htm", "toolbar");
$move_link = help_link("movingphotos.htm", "move");
$license_link = help_link("buying.htm", "license");
$thumbnail_view_link = help_link("viewing.htm", "thumbnail view");
$copy_link = help_link("sharingphotos.htm", "copy");
$slideshow_link = help_link("slideshows.htm", "slideshow");
$move_your_photos_link = help_link("movingphotos.htm", "move your photos");
$info_window_link = help_link("infodrawer.htm", "Info window");
$history_link = help_link("history.htm", "history");
$display_button_link = help_link("browsing.htm", "display");
$rotate_link = help_link("workingwithphotos.htm", "rotate");
$general_prefs_link = help_link("generalprefs.htm", "general");
$image_prefs_link = help_link("imageprefs.htm", "image");
$link_prefs_link = help_link("linkprefs.htm", "link");
$purchase_link = help_link("buying.htm", "purchase");
$activity_viewer_link = help_link("activityviewer.htm", "activity viewer");
$why_link = help_link("skipped.htm", "reason why");
$too_few_link = help_link("toofew.htm", "too few");
$too_many_link = help_link("toomany.htm", "too many");

$history_image = help_link("history.htm", img($GLOBALS['help_path'] . 'gfx/toolbar/history.gif', 'History', 53, 23));
$view_image = help_link("viewing.htm", img($GLOBALS['help_path'] . 'gfx/toolbar/view_thumbnails.gif', 'View', 81, 23));
$slideshow_image = help_link("slideshows.htm", img($GLOBALS['help_path'] . 'gfx/toolbar/slideshow.gif', 'Slideshow', 81, 23));

$add_button = img($GLOBALS['help_path'] . 'gfx/buttons/add.gif', 'Slideshow', 12, 12, "align=\"bottom\"");
$go_button = img($GLOBALS['help_path'] . 'gfx/buttons/go.gif', 'Slideshow', 12, 12, "align=\"bottom\"");
$remove_button = img($GLOBALS['help_path'] . 'gfx/buttons/remove.gif', 'Slideshow', 12, 12, "align=\"bottom\"");
$cancel_button = img($GLOBALS['help_path'] . 'gfx/buttons/cancel.gif', 'Slideshow', 83, 22, "align=\"bottom\"");

$toolbar_table = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
<tr>
<td align=right height=\"27\">$history_image</td>
<td width=\"8\">&nbsp;</td>
<td><FONT SIZE=\"2\" FACE=\"Lucida Grande,Geneva,Arial\">Go back and forward in the $history_link.</font></td>
</tr>
<tr>
<td align=right height=\"27\">$view_image</td>
<td width=\"8\">&nbsp;</td>
<td><FONT SIZE=\"2\" FACE=\"Lucida Grande,Geneva,Arial\">$uppercase_view_link as Thumbnails, List, or Slideshow.</font></td>
</tr>
<tr>
<td align=right height=\"27\">$slideshow_image</td>
<td width=\"8\">&nbsp;</td>
<td><FONT SIZE=\"2\" FACE=\"Lucida Grande,Geneva,Arial\">Previous photo, play or pause the $slideshow_link, next photo</font></td>
</tr>
</table>";

$topics = array(
'Downloading' => array (
	array(
	'name' => 'watermark',
	'title' => "Why do images have black stripes?",
	'text' => array(
		"Unlicensed copies of HyperImage add a striped watermark to downloaded images. After you $purchase_link HyperImage, you can delete the watermarked images and download them again."
	)),
	array(
	'name' => 'options',
	'title' => "How do I choose which images to download?",
	'text' => array(
		"HyperImage lets you specify exactly which images you'd like to download in the $image_prefs_link and $link_prefs_link preferences. You can also set these options by choosing File $submenu Download with Options. "
	)),
	array(
	'name' => 'whynotdownloaded',
	'title' => "Why wasn't an image downloaded?",
	'text' => array(
		"The skipped tab of the $activity_viewer_link shows which images were not downloaded, and the $why_link."
	)),
	array(
	'name' => 'toofew',
	'title' => "Why am I getting too few images?",
	'text' => array(
		"Here are some good settings if you are getting $too_few_link images."
	)),
	array(
	'name' => 'toomany',
	'title' => "Why am I getting too many images?",
	'text' => array(
		"Here are some good settings if you are getting $too_many_link images."
	)),
	array(
	'name' => 'maxdepth',
	'title' => "How can I limit the number of links that HyperImage follows?",
	'text' => array(
		"If you start downloading from Google, HyperImage might try to download the entire web. In the $link_prefs_link preferences, you can set the maximum number of links to follow."
	)),
	array(
	'name' => 'pausestop',
	'title' => "How do I stop or pause downloads?",
	'text' => array(
		"To stop all downloads, click the stop button in the $toolbar_link. You can also stop individual downloads in the $activity_viewer_link. The activity viewer also lets you pause downloads." 
	)),
	array(
	'name' => 'noimages',
	'title' => "Why are no images being downloaded?",
	'text' => array(
		"Make sure that &ldquo;download images&rdquo; is checked in the $image_prefs_link preferences."
	)),
	array(
	'name' => 'downloadpages',
	'title' => "Can I download pages too?",
	'text' => array(
		"By default, HyperImage only downloads images. To mirror an entire website, check &ldquo;download pages&rdquo; in the $link_prefs_link preferences."
	)),
	array(
	'name' => 'brokenlinks',
	'title' => "How can I find broken links on my website?",
	'text' => array(
		"You can use HyperImage to find broken links on your site. Enter your site in the address field, and then watch for &ldquo;Error 404 not found&rdquo; messages in the downloads window. If all you want to do is check for broken links, you can turn off &ldquo;download images&rdquo; in the image preferences."
	)),
	array(
	'name' => 'emptycache',
	'title' => "What should I do if a website has changed?",
	'text' => array(
		"HyperImage caches web page content for extra speed. If a website has changed, choose File $submenu Empty Cache to empty the cache."
	)),
),
'Images' => array (
	array(
	'name' => 'editphotos',
	'title' => "How can I edit photos?",
	'text' => array(
		"HyperImage makes it easy to open photos in your favoite image editor. In the $image_prefs_link preferences, you can choose editor to open photos in. You can edit photos by hitting $command" . "O, and you can even add a button to the $toolbar_link for the chosen application.",
		"You can $rotate_link photos by choosing Photos $submenu Rotate/Flip, and you can add rotate buttons to the toolbar too."
	)),
	array(
	'name' => 'filtering',
	'title' => "Why are only some of the photos in a folder showing up?",
	'text' => array(
		"When filtering just image files, HyperImage will only show files with JPEG, GIF, TIFF, PNG, or PDF file extensions.",
	)),
	array(
	'name' => 'thumbnails',
	'title' => "Why do some photos not show the correct thumbnail?",
	'text' => array(
		"In $thumbnail_view_link, HyperImage shows the same icons as in the Finder. By default, HyperImage creates thumbnails for image files that don't already have them (you can change this in Image preferences.)",
		"HyperImage can't create thumbnails for files that you don't have permission to write to, or that are on a locked volume.",
		"To update the thumbnails for the selected photos, hold down the option key and choose Photos $submenu Update Thumbnail ($option$command" . "T).",
	)),
	array(
	'name' => 'thumbnailsjaggy',
	'title' => "Why do some photos have jaggy thumbnails?",
	'text' => array(
		"Some photos may have jaggy thumbnails that were created by other programs.",
		"To update the thumbnails for the selected photos, hold down the option key and choose Photos $submenu Update Thumbnail ($option$command" . "T).",
		"Make sure that &ldquo;Create smooth thumbnails&rdquo; is checked in Image preferences.",
	)),
	array(
	'name' => 'jaggy',
	'title' => "Why do photos look jaggy?",
	'text' => array(
		"Try checking the &ldquo;Smooth scaling&rdquo; checkbox in Image preferences.",
	)),
	array(
	'name' => 'enlarge',
	'title' => "How can I make photos bigger?",
	'text' => array(
		"To make small photos bigger, choose View $submenu Enlarge Small Images ($command^).",
		"You can open a photo in a window by choosing Photos $submenu Open in New Window ($option$command" . "O).",
		"You can view photos in full screen mode by choosing View $submenu Full Screen ($command`).",
	)),
),
'Interface' => array (
	array(
	'name' => 'fullscreenviews',
	'title' => "How can I change views quickly?",
	'text' => array(
		"To display a photo, double-click it or hit return.", 
		"To see all photos, hit return again. You can also hit $command" . "1 for thumbnail view or $command" . "2 for list view.",
		"These shortcuts are especially handy in full screen view."
	)),
	array(
	'name' => 'toolbarbuttons',
	'title' => "What do the toolbar buttons do?",
	'text' => array(
		$toolbar_table,
		"You can customize the items on the $toolbar_link.",
	)),
	array(
	'name' => 'fullscreen',
	'title' => "How do I get out of full screen mode?",
	'text' => array(
		"To toggle full screen mode, hit $command` (the key below the Escape key on U.S. keyboards).",
		"You can also hit Escape to get out.",
	)),
	array(
	'name' => 'random',
	'title' => "Clicking a photo goes to a random photo! What's going on?",
	'text' => array(
		"Clicking the displayed photo goes to the next picture in the $slideshow_link, even if you're not in full screen mode. If the &ldquo;Random&rdquo; checkbox is checked in Slideshow preferences, then the next photo is a random one.",
	)),
),
'Miscellaneous' => array (
	array(
	'name' => 'macosxversion',
	'title' => "Why won't HyperImage launch?",
	'text' => array(
		"HyperImage requires Mac OS X version 10.4 or later. It will not run on earlier versions of Mac OS X or other operating systems.",
		"If you have Mac OS X Panther or earlier, upgrade to Mac OS X Tiger to run HyperImage.",
	)),
	array(
	'name' => 'erasehistory',
	'title' => "How can I erase my history?",
	'text' => array(
		"HyperImage lets you erase your $history_link, so other people can't tell which images you've looked at. Choose Browse $submenu Clear History ($shift$command" . "H). In the General preferences, you can set the number of items HyperImage remembers in the history.",
	)),
)
);

?>