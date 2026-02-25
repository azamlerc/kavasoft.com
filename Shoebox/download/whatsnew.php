<?php

/* 
  local: http://localhost/kavasoft.com/Shoebox/download/index.php#whatsnew
  live:        http://www.kavasoft.com/Shoebox/download/index.php#whatsnew
*/

# What's new dialog 
$verisonalert = "This version displays categories in the status bar, and lets you add categories as easily as addressing a mesasge in Mail. Note that Shoebox now requires Mac OS X 10.4.";

$cameras_link = local_link('cameras', 'cameras');
$categories_link = local_link('../categories/index', 'categories');
$tips_and_tricks_link = hyperlink('../help/pgs/tipsandtricks.htm', 'tips & tricks');
   
$versions_to_show = array('2.0', '1.7', '1.6', '1.5', '1.2', '1.1');
$whatsnew_arrays = array(
'2.0' => array(
    'Websites', array(
    	'Shoebox now creates interactive photo websites.',
    	'You can automatically upload catalogs using FTP.',
    	'You can protect catalogs with a username and password.',
	),
    'Categories', array(
    	'The categories window lets you edit much more category information.',
    	'You can add comments and links to categories.',
	),
	'File formats', array(
		'You can convert the selected photos to JPEG format.',
		'Added a filter to show only JPEG or RAW photos.',
	),
),
'1.7' => array(
    'Categories', array(
    	"Categories are now displayed in the status bar. Don't miss the new $tips_and_tricks_link.",
		'Adding categories now works just like addressing a message in Mail.',
    	"Added holidays for 2007 to the $categories_link page.",
	),
    'Photos', array(
    	'You can now scroll through pictures using the scroll wheel.',
		'Added a toolbar button to move the selected photos to the Pictures folder.',
    	'Creating icons, rotating, flipping and shrinking are now faster on multiprocessor Macs.',
		'Restoring shrunk photos now works better.',
	),
    'Info', array(
    	'You can now display the full path and file size in the status bar.',
    	'You can now rate photos by clicking in the status bar.',
		'You can now rename photos in the info window.',
		'The info window now shows the file\'s kind.',
	),
    'Sorting', array(
		'Numbers are now ordered correctly when sorting by filename: 1.jpg, 2.jpg, 10.jpg.',
		'You can now sort photos by full path, so that photos in the same folder are displayed together.',
	),
    'Etc.', array(
		"Shoebox now requires Mac OS X version 10.4 or later.",
		"Improved compatibility with Mac OS X version 10.5.",
		"Improved the registration process.",
		"Improved the Italian localization.",
	),
),
'1.6.1' => array(
	'Browsing photos now works better.',
    'Improved the registration process.',
),
'1.6' => array(
    'Interface', array(
		'The categories and info have been moved from drawers to separate windows.',
		'Windows have been updated with the unified toolbar look.',
	), 
    'Backup', array(
		'You can now backup photos to an external hard disk.',
		'Added an option to only shrink photos with less than a certain rating.',
	),
),
'1.5.1' => array(
    'Discs', array(
		'Improved support for buring to multiple discs.',
		'Improved support for restoring missing photos.',
	), 
    'Languages', array(
		'Italian localization (thanks to Bruno Vella).',
	),
),
'1.5' => array(
    'Universal Binary', array(
		'Shoebox now runs natively on PowerPC and Intel processors.',
	), 
    'Discs', array(
		'You can catalog your entire archive of photos on CD or DVD discs.',
		'You can burn photos to CD or DVD discs.',
	), 
    'Shrinking', array(
		"You can shrink photos to save space on your hard disk. If you insert a backup disc, $br 
		 Shoebox will automatically display the original versions of shrunk photos.",
		'You can restore the original version of a photo from a backup disc.',
	), 
    'Categories', array(
		'You can now create additional top-level categories.',
		'Added new Discs and Etc. sections to the info drawer and list view.',
	), 
    'Photos', array(
		'Shoebox now remembers the selected photos when you go back in the history.',
		'Added a menu item to remove the selected files from the list.',
		'The file size now matches what is displayed in the Finder.',
	), 
    'Slideshow', array(
		'You can now choose whether to display thumbnails or photos on the second display.',
		'Added a menu item for toggling random slideshows.',
		'The previous and next commands now work better in random slideshows.',
	),
),
'1.2.3' => array(
    'Photos', array(
		'Added a comments column to the list view.',
		'Thumbnails will now update properly when rotating photos.',
		'Thumbnails for small JPEG files are now created correctly.',
	),
    'Categories', array(
		'Added a command to go up to the enclosing category or folder.',
		'Adding new photos to categories is now faster.',
		'The icons that show the number of photos in each category are updated more often.',
	),
    'Keywords', array(
		'Adding categories to keywords now works better.',
		'Added a command to clear all keywords.',
	),
),
'1.2.2' => array(
    'Photos', array(
		'You can now copy and paste categories using either the Edit or Photos menus.',
		'Smart folders are much faster because they only search for photos in your Pictures folder.',
		'Added support for exposure properties from RAW files.',
		'Improved support for displaying NEF files from older Nikon cameras.',
		'The modification date is now preserved when creating thumbnails.',
		'Improved stability when creating thumbnails.',
	),
    'Languages', array(
		'Japanese localization (thanks to Chuck Douglas).',
		'Dutch localization (thanks to Tom Klaver).',
	),
),
'1.2.1' => array(
	'The preferred email client is now used when emailing photos.',
	'Renaming photos in list view now works better.',
	'Improved stability when creating thumbnails.',
),
'1.2' => array( 
	'Spotlight', array('
		You can now search your photos using Spotlight.', 
		'You can now create smart folders for categories and searches.<br />(See the <a href="../faq/index.php?topic=Searching&question=spotlight">FAQ</a> for more information.)'),
	'Keywords', array(
		'You can now add categories to IPTC keywords.',
		'You can now get categories from IPTC keywords.'),
    'Importing', array(
		'You can now import photos from Canto Cumulus.',
		'Improved support for importing from iPhoto 5.0.2.',),
    'Photos', array(
		'Added a preference to automatically rotate photos according to the camera&rsquo;s orientation sensor.',
		'Added support for Adobe Digital Negative (<a href="http://www.adobe.com/products/dng/main.html" target="adobe">DNG</a>) files.',
		'Improved the display of some exposure properties.'),
	'Interface', array(
		'You can now hit return to toggle between photo and list views.',
		'Added action menus to the categories drawer and the search panel.',
		'Added a &ldquo;Copy to Shoebox Folder&rdquo; item to the Photos menu.',
		'The &ldquo;Add to same categories as...&rdquo; menu item now refers to the most recently selected photo,<br /> rather than the previous photo in the list.',
		),
	'Languages', array(
		'French localization (thanks to Alain Rzepecky and Fr&eacute;d&eacute;ric Latour).',
		'German localization (thanks to Martin Kerz).',
		'Japanese localization (thanks to Chuck Douglas).',
		'Dutch localization (thanks to Tom Klaver).',
	),
	
),
'1.1.2' => array( 
    'Thumbnails now load more smoothly.',
    'Improved compatibility with Tiger, and other stability fixes.',
    'Setting a photo&rsquo;s rating to zero stars now works better.'
),
'1.1.1' => array( 
    'You can now drag photos to a favorite folder to move them to that folder.',
    'You can now drag photos to a favorite category to add them to that category.',
    'Improved handling of corrupted JPEG files when creating thumbnails and loading exposure properties.'
),
'1.1' => array(
    "Shoebox can now display RAW files from most $cameras_link.",
    'Creating thumbnails is now twice as fast.',
    'Rotating/flipping photos is now much faster, and lossless too.',
    'Added an option in Category Info to sort categories manually.',
    'Browser columns are now resizable.'
),
'1.0.3' => array( 
	'Downloading <a href="../categories/index.php">categories</a> from the KavaSoft website works better.',
	'Imported categories are properly displayed in the Info drawer.'
),
'1.0.2' => array( 
	'Improved compatibility with all supported versions of iPhoto.'
),
'1.0.1' => array( 
	'Fixed a potential crash when importing photos.',
	'Fixed a potential crash when displaying photos from an Olympus camera.',
	'The Send Feedback menu item now works.'
),
'1.0' => array( 
	'Initial release.'
) /*,
'1.0f2' => array( 
	'Miscellaneous', 
	array('Category tooltips work better in the info drawer. Turned off category tooltips in the categories drawer since they got in the way.'
	)
),
'1.0f1' => array( 
	'Miscellaneous', 
	array('The selected thumbnails are now displayed using the system highlight color. When not in focus, they are displayed in gray.',
	    'Fixed a display glitch in the info drawer'
	)
),
'1.0b3' => array( 
	'Welcome', 
	array('Added a welcome screen that lets you import photos, get categories, and take the guided tour.'
	),
	'Guided Tour', 
	array('Added a new guided tour. Choose Guided Tour from the Help menu, or click the Guided Tour button in the welcome screen.',
		'You can also take the same tour on the website.'
	),
	'Miscellaneous', 
	array('Added buttons to the categories drawer to create and delete categories.',
	    'Added a preference to add photos to date categories automatically.',
	    'If you create a new category and no category is selected, Shoebox will ask where to create the new category.',
	    'Added lots of tooltips.'
	)
),
'1.0b2' => array( 
	'Icons', 
	array('The application now has an icon.', 
		'Catalogs, exported XML files, and photos downloaded from the camera have Shoebox document icons.',
		'The Shoebox folder in the pictures folder has a custom icon.'

	),
	'Buy Shoebox', 
	array('Redesigned the Buy Shoebox window. Again.', 
	     'You can now buy either Shoebox Express or Shoebox Pro.',
	     'You can only use multiple catalogs with Shoebox Pro.'
	),
	'Secret Catalogs', 
	array('Combined the "Clear history when closing catalog" and "Don&rsquo;t include in Open Recent menu" catalog preferences into "Secret catalog."', 
		  'Added a "Secret catalog" menu item to the File menu. Choosing it will explain what it does.',
		  'Made several items catalog specific: sort order, recent download folder, copy/move folders, recent "move to" category, etc.'
	),
	'Miscellaneous', 
	array('Added a preference to show the full category path in the titlebar.',
		'Redesigned the Category Info window with a separate Permissions section.',
		'Double-clicking a category in the Info drawer will show it in the Categories drawer.'
	)
),
'1.0b1' => array(
	'Help',
	array(	
		'Shoebox now includes help.',
		'Added Tips &amp; Tricks and Frequently Asked Questions items to the Help menu.',
		'Added help buttons throughout the program.'
	),
	'New Catalog',
	array(	
		'The &quot;New Catalog&quot; window has been redesigned.',
		'You can now set privacy preferences when creating a new catalog.'
	),
	'Text Exports',
	array(	
		'Harmonized the file formats of plain text category files. Now if you export categories to plain text, you can later import them into another catalog. Text files are easier to edit by hand than XML files.'
	),
	'Ratings',
	array(	
		'Check View &gt; Thumbnails &gt; Rating to show ratings in thumbnail view.',
		'You can now use the number keys to assign ratings in fullscreen mode.'
	),
	'Info drawer',
	array(	
		'The info drawer now shows the total size of all the selected files. It will also show the camera and image size if they are the same for all the selected files.',
		'Removed resolution (e.g. &quot;300 dpi&quot;) from the &quot;Info&quot; part of the info drawer. '
	),
	'Slideshows',
	array(	
		'If you check Fullscreen in the slideshow preferences, slideshows will play fullscreen.',
		'Added a stepper next to the slideshow delay field in the preferences.'
	),
	'Performance',
	array(	
		'Shoebox will now launch quicker due to a file format change.',
		'Moving files is now much faster, especially for files in large folders.'
	),
	'Save History',
	array(	
		'The recent searches in the search field&rsquo;s popup menu are now catalog-specific.',
		'Choosing &quot;Clear History&quot; will clear the recent searches.',
		'If &quot;Clear history when closing catalog&quot; is checked, the recent searches will be cleared too.',		
	),
	'Miscellaneous',
	array(	
		'Added &quot;Get Cateogries&quot; to the application menu. It does the same thing as Categories &gt; Import &gt; from KavaSoft.com.',
		'Previously, Create Thumbnail would only create custom icons for photos that didn&rsquo;t already have one, while holding down the option key would force icons to be created for all selected photos. Now, new icons will be created if all the selected files already have custom icons.',
		'If you choose New Category and no category is selected, the new category will be created in the Unfiled category.',
		'The delete key will now delete the selected category in the category outline, and remove the current favorite in the favorites tables.',
		'The <a href="shoebox://localhost/search=2005">shoebox:// URL</a> format has changed to include &quot;localhost&quot;, for better browser compatibility.'
	)
) */
);

?>