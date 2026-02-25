<?php 

include('data.php');

echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">\n");
?><!DOCTYPE plist PUBLIC "-//Apple Computer//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>plugins</key>
	<array>
<?php
	foreach ($plugins as $identifier => $plugin) {
		echo("		<dict>\n");
		foreach ($plugin as $key => $value) {
			$value = htmlspecialchars($value);
			
			echo("			<key>$key</key>\n");
			echo("			<string>$value</string>\n");
		}
		echo("		</dict>\n");
	}
?>
	</array>
</dict>
</plist>
