<?php

$faq_title = "Shoebox - FAQ";
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
$create_link = help_link("creatingcategories.htm", "create");
$create_category_link = help_link("creatingcategories.htm", "category");
$assign_link = help_link("assigningcategories.htm", "assign");
$assign_add_link = help_link("assigningcategories.htm", "add");
$favorites_link = help_link("favorites.htm", "favorites");
$add_photos_link = help_link("addingphotos.htm", "add photos");
$added_link = help_link("addingphotos.htm", "added");
$date_link = help_link("dates.htm", "date");
$get_categories_external_link = help_link("http://www.kavasoft.com/Shoebox/categories/examples/", "KavaSoft");
$import_it_link = help_link("sharingcategories.htm#importing", "import it");
$aliases_link = help_link("aliases.htm", "aliases");
$alias_examples_link = help_link("aliases.htm", "examples");
$abstract_link = help_link("creatingcategories.htm#info", "abstract");
$locked_link = help_link("creatingcategories.htm#info", "locked");
$export_link = help_link("sharingcategories.htm", "export");
$import_link = help_link("sharingcategories.htm", "import");
$catalog_link = help_link("catalogs.htm", "catalog");
$move_link = help_link("movingphotos.htm", "move");
$filter_link = help_link("filtering.htm", "filter");
$ratings_link = help_link("ratings.htm", "ratings");
$license_link = help_link("buying.htm", "license");
$thumbnail_view_link = help_link("viewing.htm", "thumbnail view");
$copy_link = help_link("sharingphotos.htm", "copy");
$slideshow_link = help_link("slideshows.htm", "slideshow");
$move_your_photos_link = help_link("movingphotos.htm", "move your photos");
$search_link = help_link("searching.htm", "search");
$info_window_link = help_link("infodrawer.htm", "Info window");
$download_link = help_link("cameras.htm", "download");
$history_link = help_link("history.htm", "history");
$keywords_link = help_link("keywords.htm", "keywords");
$smart_folders_link = help_link("smartfolders.htm", "smart folders");
$display_button_link = help_link("browsing.htm", "display");
$add_button_link = help_link("assigningcategories.htm", "add");
$remove_button_link = help_link("assigningcategories.htm", "remove");
$rotate_link = help_link("workingwithphotos.htm", "rotate");
$photo_prefs_link = help_link("photoprefs.htm", "photo preferences");

$history_image = help_link("history.htm", img($GLOBALS['help_path'] . 'gfx/toolbar/history.gif', 'History', 53, 23));
$browse_image = help_link("browsing.htm", img($GLOBALS['help_path'] . 'gfx/toolbar/browse_folder.gif', 'Browse', 107, 23));
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
<td align=right height=\"27\">$browse_image</td>
<td width=\"8\">&nbsp;</td>
<td><FONT SIZE=\"2\" FACE=\"Lucida Grande,Geneva,Arial\">$uppercase_browse_link by folder, category, search, or camera.</font></td>
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
'Categories' => array (
	array(
	'name' => 'differencefoldercateogry',
	'title' => 'What is the difference between a folder and a category?',
	'text' => array(
		"Your hard disk has a hierarchy of folders, which can contain files and other folders. Similarly, your Shoebox catalog has a hierarchy of categories, which can contain photos and other categories. Categories are like virtual folders.",
		"The key difference is that files can only be in one folder, but photos can be in many categories. You can organize files into folders by date, person, place, <i>or</i> thing. But you can organize photos into categories by date, person, place, <i>and</i> thing!",
		"If you delete a folder, all the files inside it will be deleted as well. Because photos can be in many categories, deleting a category doesn't affect the photos in it.",
		"Shoebox lets you $browse_link your photos by folder or category. You can tell which mode you are in by looking at the Browse $toolbar_link control."
	)),
	array(
	'name' => 'differencebrowseroutline',
	'title' => 'What is the difference between the category browser and outline?',
	'text' => array(
		"The $category_browser_link lets you select a category to view its photos.",
		"The categories outline lets you $create_link, edit, and $assign_link categories."
	)),
	array(
	'name' => 'favoritescolumn',
	'title' => 'What is the left-most browser column for?',
	'text' => array(
		"It shows the $favorites_link. Its contents change when you switch between $browsing_link by folder, category, and search.",
	)),
	array(
	'name' => 'datecategory',
	'title' => 'Why are some photos not in a date category?',
	'text' => array(
		"Photos are automatically added to a $date_link category when you $add_photos_link in a folder, download them from a camera, or import them from iPhoto.",
		"By default, photos are automatically added to a date category when you first add them to any other category. You can toggle this setting in the Category preferences.",
		"You can manually add photos to the appropriate date category by choosing Photos $submenu Dates $submenu Add to Date Category. 
",
	)),
	array(
	'name' => 'fixingdates',
	'title' => 'Why are some photos in the wrong date category?',
	'text' => array(
		"If the clock on your camera was set incorrectly when you took some photos, you can adjust their creation $date_link by a specific time interval.",
		"If the creation dates are wrong (for example, because iPhoto reset them), you can set the $date_link from the photo's metadata.",
	)),
	array(
	'name' => 'getcategories',
	'title' => 'How can I get more categories?',
	'text' => array(
		"You can import a wide variety of categories from the $get_categories_external_link website. You can go there by choosing Shoebox $submenu Get Categories.",
	)),
	array(
	'name' => 'importtext',
	'title' => 'How can I create new categories quickly?',
	'text' => array(
		"A fast way to create lots of new categories is to make an outline in a text editor, save it as plain text, and then $import_it_link.",
	)),
	array(
	'name' => 'aliases',
	'title' => 'What are category aliases useful for?',
	'text' => array(
		"Category $aliases_link work just like aliases in the Finder. They act as placeholders that refer to an original, and essentially allow categories to be inserted into more than one place in the outline.",
		"Aliases can be used to make logical connections between categories. The more connections you make, the more Shoebox will understand how the world works. Here are some $alias_examples_link.",
	)),
	array(
	'name' => 'categoryicons',
	'title' => 'What do the category icons mean?',
	'text' => array(
		"Each category in the $browser_link has a minature progress bar that shows the number of photos in the category. This makes it easy to see which categories have more photos than others. (The scale is logarithmic, with each pixel representing twice as many photos.)",
	)),
	array(
	'name' => 'abstract',
	'title' => 'Why can&rsquo;t I add photos to some categories?',
	'text' => array(
		"You can't add photos to $abstract_link categories, such as Things and Mammals.",
	)),
	array(
	'name' => 'locked',
	'title' => "Why can't I move/rename/delete some categories?",
	'text' => array(
		"You can't move, rename, or delete $locked_link categories.",
	)),
),
'Photos' => array (
	array(
	'name' => 'picturesfolder',
	'title' => "Why do I have to choose a pictures folder?",
	'text' => array(
		"Each Shoebox $catalog_link has a &ldquo;pictures folder&rdquo; where most of its photos are stored. The default is ~/Pictures, but you can choose a different folder in the Catalog preferences. Regardless of your choice, catalogs can include photos in any folder.",
		"Keeping all your photos in the chosen pictures folder make it easier to $move_link them to a different disk or computer later. Photos in your pictures folder are referenced using relative paths. If you move your pictures folder to a different folder, disk or computer, all you need to do is tell Shoebox where you've moved it to.",
	)),
	array(
	'name' => 'editphotos',
	'title' => "How can I edit photos?",
	'text' => array(
		"Shoebox makes it easy to open photos in your favoite image editor. In the $photo_prefs_link, you can choose editor to open photos in. You can edit photos by hitting $command" . "O, and you can even add a button to the $toolbar_link for the chosen application.",
		"You can $rotate_link photos by choosing Photos $submenu Rotate/Flip, and you can add rotate buttons to the toolbar too."
	)),
	array(
	'name' => 'filtering',
	'title' => "Why are only some of the photos in a folder/category showing up?",
	'text' => array(
		"Until you purchase a $license_link, Shoebox only shows twenty photos at a time. The status bar will say &ldquo;maximum for demo license&rdquo;. With a personal license, that number is raised to a thousand. With a pro license, you can view and unlimited number of photos.",
		"You might also have a $filter_link turned on. The status bar may say &ldquo;image files&rdquo;, &ldquo;$star$star$star$star$star&rdquo;, &ldquo;this month&rdquo;, &ldquo;with place&rdquo;, etc. To turn off a particular filter, choose Filter $submenu All Photos.",
		"When filtering just image files, Shoebox will only show files with JPEG, GIF, TIFF, PNG, or PDF file extensions.",
	)),
	array(
	'name' => 'filteringrating',
	'title' => "How can I show just the good photos?",
	'text' => array(
		"You can $filter_link the displayed photos by rating. For example, if you check Filter $submenu &ldquo;$star$star$star$star and up&rdquo;, only photos rated four-stars or better will be displayed as you browse. To turn off the rating filter, choose Filter $submenu All Photos (next to the other rating items).",
		"Each catalog also comes with a &ldquo;Top Rated&rdquo; favorite search that will show your $star$star$star$star$star photos.",
	)),
	array(
	'name' => 'unsorted',
	'title' => "How can I find uncategorized photos?",
	'text' => array(
		"After you've spent some time categorizing your photos, you may want to find ones that you havne't categorized yet. To filter only photos that are missing a particular kind of category, choose Filter $submenu Photos without Date Category, etc. Because most photos have a person and/or a thing, these kinds of categories have been combined into a single filter.",
		"If you've spent time naming your photos, Shoebox can help you assign them to categories. Click a category in the outline, and choose Categories $submenu Show Related Photos. Shoebox will search for all photos whose file name contains the category's name, and which <i>aren't</i> in the category. You can then choose which photos to add to the category.",
	)),
	array(
	'name' => 'thumbnails',
	'title' => "Why do some photos not show the correct thumbnail?",
	'text' => array(
		"In $thumbnail_view_link, Shoebox shows the same icons as in the Finder. By default, Shoebox creates thumbnails for image files that don't already have them (you can change this in Photos preferences.)",
		"Shoebox can't create thumbnails for files that you don't have permission to write to, or that are on a locked volume.",
		"To update the thumbnails for the selected photos, hold down the option key and choose Photos $submenu Update Thumbnail ($option$command" . "T).",
	)),
	array(
	'name' => 'thumbnailsjaggy',
	'title' => "Why do some photos have jaggy thumbnails?",
	'text' => array(
		"Some photos may have jaggy thumbnails that were created by other programs.",
		"To update the thumbnails for the selected photos, hold down the option key and choose Photos $submenu Update Thumbnail ($option$command" . "T).",
		"Make sure that &ldquo;Create smooth thumbnails&rdquo; is checked in Photos preferences.",
	)),
	array(
	'name' => 'jaggy',
	'title' => "Why do photos look jaggy?",
	'text' => array(
		"Try checking the &ldquo;Smooth scaling&rdquo; checkbox in Photos preferences.",
	)),
	array(
	'name' => 'sideways',
	'title' => "Why are some of my photos sideways?",
	'text' => array(
		"If your camera has an orientation sensor, Shoebox can automatically rotate your photos. In Photos preferences, check &ldquo;Rotate according to orientation sensor&rdquo;.",
		"You can choose Photos $submenu Rotate/Flip $submenu Rotate Clockwise (or Counterclockwise) to rotate photos manually. You can also add rotate buttons to the $toolbar_link."
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
'Searching' => array (
	array(
	'name' => 'spotlight',
	'title' => "How does Shoebox work with Spotlight?",
	'version' => '1.2',
	'text' => array(
		"Shoebox can add categories to the $keywords_link of your photos, allowing you to search the contents of photos using Spotlight. You can also create $smart_folders_link from categories or searches.",
		"In the Categories preferences, you can choose whether you want to add categories to keywords automatically. Otherwise, you can add them manually by choosing Photos $submenu Keywords $submenu Add Categories to Keywords."
	)),
	array(
	'name' => 'spotlightmissing',
	'title' => "Why can't I find my photos using Spotlight?",
	'version' => '1.2',
	'text' => array(
		"You need to add categories to the $keywords_link of each photo in order for Spotlight to find them.",
		"Spotlight only indexes image files that have file extensions like &ldquo;.jpg&rdquo;. Shoebox will make sure that each photo has the correct extension when you add categories to keywords."
	)),
	array(
	'name' => 'viewkeywords',
	'title' => "How can I view a photo's keywords?",
	'version' => '10.4',
	'text' => array(
		"Click on a photo and choose Photos $submenu Reveal in Finder. In the Finder, choose Get Info. The keywords are displayed in the &ldquo;More Info&rdquo; section.",
	)),
	array(
	'name' => 'quotes',
	'title' => "How can I join words into one search term?",
	'text' => array(
		"When you type some words in the $search_link field, Shoebox will create a new search with a search criterion for each search term. To join several words into one search term, enclose them in &quot;double quotes&quot;. ",
	)),
),
'Interface' => array (
	array(
	'name' => 'fullscreenviews',
	'title' => "How can I change views quickly?",
	'version' => '1.2',
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
	'name' => 'comboboxes',
	'title' => "What is the combo box at the top of the Info window for?",
	'text' => array(
		"The &ldquo;add a category&rdquo; combo box at the top of the Info window lets you quickly $assign_add_link the selected photos to a category. Just type the first few letters of the category's name and hit return.",
	)),
	array(
	'name' => 'graybuttons',
	'title' => "What are the little gray buttons for?",
	'text' => array(
		"To $add_button_link the selected photos to a category, click the $add_button button next to its name in the Categories outline.",
		"To $display_button_link the photos in the category, click the $go_button button next to its name in either the Categories outline or the Info window.",
		"To $remove_button_link the selected photos from a category, click the $remove_button button next to its name in the Info window.",
	)),
	array(
	'name' => 'fullscreen',
	'title' => "How do I get out of full screen mode?",
	'text' => array(
		"To toggle full screen mode, hit $command` (the key below the Escape key on U.S. keyboards).",
		"You can also hit Escape to get out.",
	)),
	array(
	'name' => 'cancel',
	'title' => "How can I cancel a long task?",
	'text' => array(
		"Click the cancel button next to the progress indicator in the status bar:",
		"&nbsp;&nbsp;&nbsp;&nbsp;$cancel_button",
	)),
	array(
	'name' => 'rename',
	'title' => "When I type the name of a category, nothing happens. What's going on?",
	'text' => array(
		"You can add a photo to a category by simply typing the first few letters of its name in the &ldquo;add a category&rdquo; box at the top of the Info window. Or, you can click on a photo in thumbnail or list view and just start typing. Currently, you can't assign categories in full-screen mode.",
	)),
	array(
	'name' => 'random',
	'title' => "Clicking a photo goes to a random photo! What's going on?",
	'text' => array(
		"Clicking the displayed photo goes to the next picture in the $slideshow_link, even if you're not in full screen mode. If the &ldquo;Random&rdquo; checkbox is checked in Slideshow preferences, then the next photo is a random one.",
	)),
),
'Cameras' => array (
	array(
	'name' => 'cameraaction',
	'title' => "When I plug in a camera, how can I make Shoebox open instead of iPhoto?",
	'text' => array(
		"In the Camera preferences, choose Shoebox from the popup menu.",
	)),
	array(
	'name' => 'cameranames',
	'title' => "Why is my camera's name showing up all goofy?",
	'text' => array(
		"When you take a photo, the camera's make and model are added to the photo's metadata. However, sometimes these names aren't very pretty. (Apparently the engineering department, rather than the marketing department, gets to pick them.)",
		"If you open the Camera preferences and click the Camera Names tab, you can customize how camera names will appear in the $info_window_link. For example, if the left-hand column says &ldquo;NIKON E8800&rdquo;, you can edit the name in the right-hand column to say &ldquo;Nikon Coolpix 8800&rdquo;.",
	)),
	array(
	'name' => 'exposureproperties',
	'title' => "What are all those Exposure properties? I don't care about most of them.",
	'text' => array(
		"When you take a photo, the camera stores lots of metadata in the photo, such as the exposure time and whether the flash was used. Some of these properties are more useful than others.",
		"The Exposure section of the $info_window_link shows the metadata for the selected photo. You can customize which properties are displayed in the Exposure Properties tab of the Camera preferences. For example, you could uncheck everything except for Exposure Time, F-Number, ISO Speed, and Flash.",
	)),
	array(
	'name' => 'downloadfirst',
	'title' => "Why can't I do stuff with photos on my camera?",
	'text' => array(
		"To edit photos or add them to categories, you need to $download_link them to your computer first.",
	)),
),
'Import/Export' => array (
	array(
	'name' => 'importiphoto',
	'title' => "How can I import from iPhoto?",
	'text' => array(
		"If you choose File $submenu Import from iPhoto, all your pictures from iPhoto will be $added_link to the catalog. Categories will be created for all of your albums and keywords in the &ldquo;Imported&rdquo; category. Your $ratings_link will be preserved as well.",
	)),
	array(
	'name' => 'exportiphoto',
	'title' => "How can I export to iPhoto?",
	'text' => array(
		"You can export photos to iPhoto, for example if you want to make a book. Select some photos, and then $copy_link them to a folder by choosing Photos $submenu Move/Copy $submenu Copy to Folder. Then, drag that folder to the Source list in iPhoto to import the photos.",
	)),
	array(
	'name' => 'importcumulus',
	'title' => "How can I import from Cumulus?",
	'text' => array(
		"You can import photos and categories from Canto Cumulus. First, create a Cumulus record export (.cre) file for the photos you would like to import. Choose File $submenu Import from Cumulus, and select the record export. (You can also drag the record export to the Shoebox icon.) The exported photos will be added to the appropriate categories in Shoebox.",
	)),
	array(
	'name' => 'importkeywords',
	'title' => "How can I import keywords from other programs?",
	'version' => '1.2',
	'text' => array(
		"You may have added $keywords_link to photos using other programs, such as Adobe Photoshop. To import keywords, choose Photos $submenu Keywords $submenu  Get Categories from Keywords. Photos will be added to existing categories if possible; otherwise new categories will be created in /Imported/Keywords.",
	)),
	array(
	'name' => 'exportkeywords',
	'title' => "How can I export keywords to other programs?",
	'version' => '1.2',
	'text' => array(
		"To export $keywords_link, choose Photos $submenu Keywords $submenu Add Categories to Keywords. Then, all the categories from Shoebox will be visible in other programs that read IPTC keywords, such as Adobe Photoshop."
	)),
	array(
	'name' => 'importedthings',
	'title' => "After importing, why do some people and places show up under Things?",
	'text' => array(
		"New categories are added under &ldquo;Imported&rdquo; in the outline. You can then drag them to the appropriate place in the outline. For example, if you have an imported category called &ldquo;Mom&rdquo;, you can drag it to /People/Family."
	)),
	array(
	'name' => 'merging',
	'title' => "After importing, I have duplicate categories. How can I merge them?",
	'text' => array(
		"Some imported categories may be the same as categories you already have in your outline. To merge two categories, select them both in the outline and choose Categories $submenu Merge. Then they will be combined into a single category."
	)),
	array(
	'name' => 'xml',
	'title' => "Why would I want to export categories to XML?",
	'text' => array(
		"XML is a popular file format for exchanging data. If you $export_link cateogries to XML, you can $import_link categories into another Shoebox catalog. You can also link to categories on your website so that other people can import them. ",
	)),
),
'Miscellaneous' => array (
	array(
	'name' => 'macosxversion',
	'title' => "Why won't Shoebox launch?",
	'text' => array(
		"Shoebox requires Mac OS X version 10.3.9 or later. It will not run on earlier versions of Mac OS X or other operating systems.",
		"If you have a previous version of Mac OS X Panther, simply run Software Update to get Mac OS X 10.3.9.",
		"If you have Mac OS X Jaguar or earlier, upgrade to Mac OS X Tiger to run Shoebox.",
	)),
	array(
	'name' => 'erasehistory',
	'title' => "How can I erase my history?",
	'text' => array(
		"Shoebox lets you erase your $history_link, so other people can't tell which photos you've looked at. Choose Browse $submenu Clear History ($shift$command" . "H). In the Catalog preferences, you can set the number of items Shoebox remembers in the history.",
		"Private catalogs do not remember your history, and do not appear in the &ldquo;Open Recent&rdquo; menu. To make a catalog private, choose File $submenu Private Catalog.",
	)),
	array(
	'name' => 'backup',
	'title' => "How can I backup my catalog?",
	'text' => array(
		"The main Shoebox $catalog_link is at ~/Library/Application Support/Shoebox/Photos.shoebox. It's a good idea to routinely back up your entire ~/Library folder.",
	)),
	array(
	'name' => 'disappeared',
	'title' => "All my photos have disappeared! What should I do?",
	'text' => array(
		"If you move your photos around in the Finder, Shoebox won't know where to find them and will display a broken file icon. To add the photos back to Shoebox, choose File $submenu Add Photos in Folder, and select the folder containing the photos that were moved. ",
		"This may result in duplicate photos in both the old and new locations. Choose File $submenu Utilities $submenu Remove Missing Photos from Catalog to get rid of the missing photos.",
		"To avoid this problem, you can $move_your_photos_link using Shoebox instead.",
	)),
	array(
	'name' => 'otherfiles',
	'title' => "Can I use Shoebox to organize other kinds of files?",
	'text' => array(
		"Shoebox can display any image files that QuickTime can understand. (We're working on adding support for other kinds of files as well.) However, you can assign categories to any files. ",
	)),
)
);

?>