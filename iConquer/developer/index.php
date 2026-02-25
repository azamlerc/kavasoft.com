<?php

include($doc_root . '../../products.php');

# Page title
$page_name = 'home';
$doc_root = '../';
$title = 'iConquer';
$folder = 'iConquer';
$store_product = 'iconquer';
$slogan = "Develop map and player plug-ins.";

include($doc_root . '../shared.php');

head('iConquer - Developer', $folder);

table_1();

tour_box();

box('sidebar', 'Download', hyperlink("iConquerPluginKit.dmg", 
	img('/images/buttons/download.png', 'Download', 90, 80, 'align="left"')) . 
	hyperlink("iConquerPluginKit.dmg", "iConquer Plug-in Kit 4.0", 'sidebar_link') . 
	" $br 1.0 MB disk image $br " . hyperlink("../../iConquer.dmg", "iConquer $product_version", 'sidebar_link') . 
	" $br $product_size disk image");

box('sidebar', 'Requirements', hyperlink("http://developer.apple.com/technologies/tools/xcode.html", "Xcode Developer Tools", 'sidebar_link') . $br . hyperlink("http://www.adobe.com/products/photoshop/main.html", "Adobe Photoshop", 'sidebar_link') . $br . hyperlink("../index.php", "iConquer 4", 'sidebar_link') );

questions_box(array('help', 'orders', 'service', 'developer', 'pr', 'contact'));

table_2(); 

box('text', 'About iConquer', "The iConquer Plug-in Kit lets you develop your onw map and player plug-ins. Use your artistic talents to create stunning photo-realistic maps. Or use your artificial intelligence hacking ability to make the next great player algorithm. The Plug-in Kit adds new project types to Xcode, so you're one click away from starting with a working plug-in.");

echo(img("../tour/images/developer.jpg", 'Screenshot', 600, 375, 'class="box no_padding"'));
echo(spacer_img(25, 25));

box('text', 'Requirements', "You'll need to have the <a class=\"darker\" href=\"http://developer.apple.com/technologies/tools/xcode.html\">Xcode Developer Tools</a> installed. They're included on the Mac&nbsp;OS&nbsp;X install DVD, and are available for download from the <a class=\"darker\" href=\"http://www.apple.com/developer\">Apple Developer Connection</a>.
<p>
To create map plug-ins, you'll need a graphics program that can create TIFF or PNG images with transparency, such as <a  class=\"darker\" href=\"http://www.adobe.com/products/photoshop/main.html\">Adobe Photoshop</a>.
<p>
To create player plug-ins, you'll need a knowledge of developing in Objective-C and some background in artificial intelligence algorithms.");

box('text', 'Getting Started', "Download the iConquer Plug-in Kit by clicking the disk image at right, and install the iConquer Plug-in Kit package. Two Xcode project templates will be installed in <span class=\"code\">/Developer/&zwnj;Library/&zwnj;Xcode/&zwnj;Project Templates/&zwnj;iConquer</span>. 
<P>
After installing the package, create a new project in Xcode. In the assistant, scroll down to the iConquer project type, and choose \"Map plug-in\" or \"Player plug-in.\" Then you can choose a name for your plug-in.
<p>
Build your new project, and Xcode will create a complete, working plug-in in the project's <span class=\"code\">build</span> folder."); 

box('text', 'Customizing your plug-in', "You'll want to customize some information about your project. Look at the <span class=\"code\">Info.plist</span> file, review the values that Xcode has inserted for you, and make any necessary changes.
<P>
<center>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
	<tr BGCOLOR=#F7F7F7>
		<td valign=top><span class=\"code\">CFBundleName</span></td>
		<td valign=top><font size=-1>The name that will be displayed to the user.</font></td>
	</tr>
	<tr>
		<td valign=top><span class=\"code\"><a href=\"map.html#mapfamilies\">CFBundleIdentifier</a></span></td>
		<td valign=top><font size=-1>A unique string that identifies your plug-in.</font></td>
	</tr>
	<tr BGCOLOR=#F7F7F7>
		<td valign=top><span class=\"code\"><a href=\"#Updating\">CFBundleVersion</a></span></td>
		<td valign=top><font size=-1>Your plugin's version, displayed in the Plug-ins window.</font></td>
	</tr>
	<tr>
		<td valign=top><span class=\"code\">ICAuthor</span></td>
		<td valign=top><font size=-1>Your name, displayed in the Plug-ins window.</font></td>
	</tr>
	<tr BGCOLOR=#F7F7F7 >
		<td valign=top><span class=\"code\">ICAuthorURL</span></td>
		<td valign=top><font size=-1>Your name will be linked to this URL (http:// or mailto:).</font></td>
	</tr>
	<tr>
		<td valign=top><span class=\"code\"><a href=\"map.html#colortransparency\">ICColorTransparency</a>&nbsp;</span></td>
		<td valign=top><font size=-1>Specifies the color transparency for countries.<BR>(optional, maps only)</font></td>
	</tr>
	<tr BGCOLOR=#F7F7F7 >
		<td valign=top><span class=\"code\">ICComments</span></td>
		<td valign=top><font size=-1>A description of your plug-in (about four lines).</font></td>
	</tr>
	<tr>
		<td valign=top><span class=\"code\"><a href=\"map.html#playerlist\">ICPlayerList</a></span></td>
		<td valign=top><font size=-1>Specifies what corner the player list appears in.<BR>(optional, maps only)</font></td>
	</tr>
	<tr BGCOLOR=#F7F7F7 >
		<td valign=top><span class=\"code\"><a href=\"map.html#thumbnail\">ICThumbnail</a></span></td>
		<td valign=top><font size=-1>The name of an image that will be displayed in the Plug-ins window (ignore the file extension).</font></td>
	</tr>
	<tr>
		<td valign=top><span class=\"code\">ICVersionRequired</span></td>
		<td valign=top><font size=-1>The minimum version of iConquer that this plug-in is compatible with.</font></td>
	</tr>
</table> 
</center>
<P>
You should also paste the <span class=\"code\">CFBundleName</span> and <span class=\"code\">ICComments</span> values into the English variant of the <span class=\"code\">InfoPlist.strings</span> file. Values in the <span class=\"code\">InfoPlist.strings</span> file override the non-localized values.<P>
If you would like to translate your plug-in, click on <span class=\"code\">InfoPlist.strings</span> in the list of files. Choose Project <font color=gray size=-1>&#9654;</font> Get Info, click \"Add Localization,\" and choose a language. Then edit the other localized variants."); 

box('text', 'Writing your plug-in', 'This is the part where you get creative! Click a plug-in type below for specific instructions.
<br><br><center><table border="0" width="75%" cellspacing="0" cellpadding="0">
	<tr>
		<td align=center><a href="map.html"><img src="map_plugin.png" alt="Map" width="128" height="128" border=0></a></td>
		<td align=center><a href="player.html"><img src="player_plugin.png" alt="Player" width="128" height="128" border=0></a></td>
	</tr>
	<tr>
		<td align=center><a class="text_link" href="map.html">Maps</a></td>
		<td align=center><a class="text_link" href="player.html">Players</a></td>
	</tr>
</table></center>');

box('text', 'Installing your plug-in', "Copy your plug-in from your project's <span class=\"code\">build</span> folder to one of the following locations. 
<p><span class=\"code\">
&nbsp;&nbsp;~/Library/Application Support/iConquer/<BR>
&nbsp;&nbsp;/Library/Application Support/iConquer/
</span>
<p> 
Be sure not to change the extension of your plug-in, which should be <span class=\"code\">.player</span> or <span class=\"code\">.map</span>. 
<P>
To avoid having to repeatedly copy your plug-in when you make changes, you can create a symbolic link, which is similar to an alias. In the Terminal, type the following, substituting the correct path and name for your plug-in:
<P>
<span class=\"code\">
&nbsp;&nbsp;cd /Library/Application\ Support/iConquer/<BR>
&nbsp;&nbsp;ln -s ~/Projects/MyPlugin/build/Release/MyPlugin.map MyPlugin.map
</span>

<P>
Restart iConquer to discover new plug-ins. Maps will appear in the Map menu, and players will appear in the player popup menus in the New Game dialog. Maps can be reloaded by selecting them again from the Map menu, but you must restart iConquer to reload players.");

box('text', 'Submitting your plug-in', 'Designed, built and tested your plug-in? Let us know so that we can add it to the list of plug-ins that iConquer can discover automatically.
<P>

When you build your project, an archive called <span class="code">MyPlugin.zip</span> will be created in the build directory. Upload this file to your web server. The URL for the plug-in archive should look something like:
<blockquote>
<span class="code">
	http://www.mydomain.com/jstalin/MyPlugin.zip
</span>
</blockquote>
<p>
If your plug-in is a map, upload the <a href="map.html#thumbnail">thumbnail</a> image for your plug-in to your web server, at a URL such as:
</p>
<blockquote>
<span class="code">
	http://www.mydomain.com/jstalin/MyPlugin.png
</span>
</blockquote>
<p>
Then email both URLs to us at <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#105;&#110;&#102;&#111;&#64;&#107;&#97;&#118;&#97;&#115;&#111;&#102;&#116;&#46;&#99;&#111;&#109;">&#105;&#110;&#102;&#111;&#64;&#107;&#97;&#118;&#97;&#115;&#111;&#102;&#116;&#46;&#99;&#111;&#109;</a>, and we will add your plug-in to the list that will be displayed when users check for new plug-ins.');

box('text', 'Linking to your plug-in', 'After your plug-in has been released, you can link to it with a URL such as:
<blockquote><span class="code">
	iconquer://getPlugin?identifier=com.mydomain.mymap.medium
</span></blockquote>
<p>
Clicking on the link will automatically launch iConquer and install the plug-in with the specified <a href="map.html#mapfamilies">CFBundleIdentifier</a>. <a class="darker" href="../plugins/index.php#Circles">Here are some examples</a>.');

box('text', 'Updating your plug-in', 'If you update your plug-in, simply <a class="darker" href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#105;&#110;&#102;&#111;&#64;&#107;&#97;&#118;&#97;&#115;&#111;&#102;&#116;&#46;&#99;&#111;&#109;">send us an email</a> with the new version number. We\'ll update the version of your plug-in in the list. Users with the old version will see that the plug-in has been updated when they check for new plug-ins.');

table_3(); 

footer(); 

?>

