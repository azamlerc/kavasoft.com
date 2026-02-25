<html>
<head>
	<title>iConquer - Developer</title>
	<link rel="SHORTCUT ICON" href="http://www.kavasoft.com/iConquer/favicon.ico"> 
	<link rel="stylesheet" type="text/css" href="../styles.css" media="screen" />
</head>
<BODY BGCOLOR=#FFFFFF>

<center>
<TABLE WIDTH="700" BORDER="0" CELLPADDING="0" CELLSPACING="0">
	<TR>
		<TD>
			<a href="../index.html"><IMG SRC="developer_header.jpg" WIDTH=700 HEIGHT=300></a>
		</TD>
	</TR>
</TABLE>
<TABLE WIDTH="700" BORDER="0" CELLPADDING="0" CELLSPACING="0">
	<TR>
		<TD WIDTH="520" valign=top>
			<FONT FACE="Lucida Grande,Geneva,Arial,Helvetica,sans-serif">
			
<P>
<B>Developing Plug-ins for iConquer</B>
<P>
iConquer allows you to create plug-ins for both player personalities and maps. Use your artificial intelligence hacking ability to make the next great player algorithm. Or use your artistic talents to make stunning Aqua-licious game maps.  
<P>
<a name="Requirements"></a><B>Requirements</B>
<P>
You'll need to have the latest Mac OS X <a href="http://developer.apple.com/tools/macosxtools.html">Xcode Tools</a> installed. They're included on a CD along with Mac OS X, and are available for download from the <a href="http://www.apple.com/developer">Apple Developer Connection</a> (free registration required).
<P>
To create player plug-ins, you'll need a basic understanding of developing Cocoa software for Mac OS X in Objective-C. You may wish to refer to the <a href="http://developer.apple.com/techpubs/macosx/Cocoa/CocoaTopics.html">Cocoa documentation</a>. If you're familiar with Java, you may just need to read through the <a href="http://developer.apple.com/techpubs/macosx/Cocoa/ObjCTutorial/index.html">Objective-C tutorial</a>.
<P>
To create map plug-ins, you'll need a graphics program that can create TIFF images with transparency, such as <a href="http://www.adobe.com/products/photoshop/main.html">Adobe Photoshop</a>. 
<P>
<img src="../tour/images/developer.jpg" alt="Assistant" width="512" height="320">
<p>
<a name="GettingStarted"></a><B>Getting Started</B>
<P>
Download the iConquer Plug-in Kit by clicking the disk image at right, and install the iConquer Plug-in Kit package. Two Xcode project templates will be installed in <span class=\"code\">/Developer/&zwnj;Library/&zwnj;Xcode/&zwnj;Project Templates/&zwnj;iConquer</span>. 
<P>
After installing the package, create a new project in Xcode. In the assistant, scroll down to the iConquer project type, choose "Map plug-in" or "Player plug-in", and click "Next". Choose a name for your plug-in, and click "Finish".

<P>
Click the Build button, and Xcode will create a complete, working plug-in in your project's "build" folder.

<P>
<a name="Customizing"></a><B>Customizing your plug-in</B>
<P>
You'll want to customize some information about your project. Look at the <span class=\"code\">Info.plist</span> file, review the values that Xcode has inserted for you, and make any necessary changes.
<P>
<center>
<table border="0" cellspacing="0" cellpadding="2">
	<tr BGCOLOR=#F7F7F7>
		<td valign=top><span class=\"code\">CFBundleName</span></td>
		<td valign=top><font size=-1>The name that will be displayed to the user.</font></td>
	</tr>
	<tr>
		<td valign=top><span class=\"code\"><a href="map.html#mapfamilies">CFBundleIdentifier</a></span></td>
		<td valign=top><font size=-1>A unique string that identifies your plug-in.</font></td>
	</tr>
	<tr BGCOLOR=#F7F7F7>
		<td valign=top><span class=\"code\"><a href="#Updating">CFBundleVersion</a></span></td>
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
		<td valign=top><span class=\"code\"><a href="map.html#colortransparency">ICColorTransparency</a>&nbsp;</span></td>
		<td valign=top><font size=-1>Specifies the color transparency for countries.<BR>(optional, maps only)</font></td>
	</tr>
	<tr BGCOLOR=#F7F7F7 >
		<td valign=top><span class=\"code\">ICComments</span></td>
		<td valign=top><font size=-1>A description of your plug-in (about four lines).</font></td>
	</tr>
	<tr>
		<td valign=top><span class=\"code\"><a href="map.html#playerlist">ICPlayerList</a></span></td>
		<td valign=top><font size=-1>Specifies what corner the player list appears in.<BR>(optional, maps only)</font></td>
	</tr>
	<tr BGCOLOR=#F7F7F7 >
		<td valign=top><span class=\"code\"><a href="map.html#thumbnail">ICThumbnail</a></span></td>
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
If you would like to translate your plug-in, click on <span class=\"code\">InfoPlist.strings</span> in the list of files. Choose Project <font color=gray size=-1>&#9654;</font> Get Info, click "Add Localization", and choose a language. Then edit the other localized variants. 
<P>
<a name="Writing"></a><B>Writing your plug-in</B>
<P>
This is the part where you get creative! Click a plug-in type below for specific instructions.
<P align=center>
<table border="0" width="75%" cellspacing="0" cellpadding="0">
	<tr>
		<td align=center><a href="player.html"><img src="player_plugin.jpg" alt="Player" width="128" height="128" border=0></a></td>
		<td align=center><a href="map.html"><img src="map_plugin.jpg" alt="Map" width="128" height="128" border=0></a></td>
	</tr>
	<tr>
		<td align=center><a href="player.html">Players</a></td>
		<td align=center><a href="map.html">Maps</a></td>
	</tr>
</table>
<P>
<a name="Installing"></a><B>Installing your plug-in</B>
<P>
Copy your plug-in from your project's "build" folder to one of the following locations. 
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
Restart iConquer to discover new plug-ins. Maps will appear in the Map menu, and players will appear in the player popup menus in the New Game dialog. Maps can be reloaded by selecting them again from the Map menu, but you must restart iConquer to reload player code.
<P>
<P><a name="Submitting"></a><B>Submitting your plug-in</B>
<P>
Designed, built and tested your plug-in? Let us know so that we can add it to the list of plug-ins that iConquer can discover automatically.
<P>

When you build your project, an archive called <span class=\"code\">MyPlugin.tar.gz</span> will be created in the build directory. Upload this file to your web server. The URL for the plug-in archive should look something like:
<blockquote>
<span class=\"code\">
	http://www.mydomain.com/jstalin/MyPlugin.tar.gz
</span>
</blockquote>
<p>
If your plug-in is a map, upload the <a href="map.html#thumbnail">thumbnail</a> image for your plug-in to your web server, at a URL such as:
</p>
<blockquote>
<span class=\"code\">
	http://www.mydomain.com/jstalin/MyPlugin.jpg
</span>
</blockquote>
<p>
Then email both URLs to us at <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#105;&#110;&#102;&#111;&#64;&#107;&#97;&#118;&#97;&#115;&#111;&#102;&#116;&#46;&#99;&#111;&#109;">&#105;&#110;&#102;&#111;&#64;&#107;&#97;&#118;&#97;&#115;&#111;&#102;&#116;&#46;&#99;&#111;&#109;</a>, and we will add your plug-in to the list that will be displayed when users check for new plug-ins.
<P>
<P><a name="Linking"></a><B>Linking to your plug-in</B><P>
After your plug-in has been released, you can link to it with a URL such as:
<blockquote><span class=\"code\">
	iconquer://getPlugin?identifier=com.mydomain.mymap.medium
</span></blockquote>
<p>
Clicking on the link will automatically launch iConquer and install the plug-in with the specified <a href="map.html#mapfamilies">CFBundleIdentifier</a>. Here are some <a href="../plugins/index.php#Circles">examples</a>.
<p><a name="Updating"></a><B>Updating your plug-in</B></p>
<p>
If you update your plug-in, simply send us an <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#105;&#110;&#102;&#111;&#64;&#107;&#97;&#118;&#97;&#115;&#111;&#102;&#116;&#46;&#99;&#111;&#109;">email</a> with the new version number. We'll update the version of your plug-in in the list. Users with the old version will see that the plug-in has been updated when they check for new plug-ins. </p>



</FONT>
		</TD>
		<TD WIDTH="20">
			<!-- separator -->		
		</TD>
		<TD WIDTH="160" valign=top>
			<FONT FACE="Lucida Grande,Geneva,Arial,Helvetica,sans-serif" SIZE=1>
<P align=center>
<a href="iConquerPluginKit.dmg"><img border="0" src="disk_image.jpg" alt="Download iConquer" width="118" height="139"></a>
<BR><a href="iConquerPluginKit.dmg">iConquer Plug-in Kit</a><BR><BR><font color=gray>Version 3.0<BR>1.0 MB disk image<p align=center><font color=gray>requires <a href="../index.php"><font color=gray>iConquer 3.0</font></a></font>
<P align=center>
<a href="#Requirements">Requirements</a><BR>
<a href="#GettingStarted">Getting Started</a><BR>
<a href="#Customizing">Customizing</a><BR>
<a href="#Writing">Writing</a><BR>
<a href="#Installing">Installing</a><BR>
<a href="#Submitting">Submitting</a><BR>
<a href="#Linking">Linking</a><BR>
<a href="#Updating">Updating</a><BR>
<P align=center><BR>
		<a href="player.html"><img src="player_plugin.jpg" alt="Player" width="128" height="128" border=0></a><BR>
		<a href="player.html">Players</a><BR><BR>
		<a href="map.html"><img src="map_plugin.jpg" alt="Map" width="128" height="128" border=0></a><BR>
		<a href="map.html">Maps</a>
			</FONT>

		</TD>
	</TR>
</table>

<FONT FACE="Lucida Grande,Geneva,Arial,Helvetica,sans-serif" SIZE=1><P>
<a href="../index.php">Home</a> | 
<a href="../plugins/index.php">Maps</a> | 
Developer | 
<a href="../download/index.php">Download</a> | 
<a href="../../store/index.php?iconquer=1">Buy Now</a>

<P>
&copy; 2002-2010 KavaSoft.<BR>
All rights reserved.

</center>
</body>
</html>