<?php 

include('content.php');
include('../../shared.php');
$title = 'Shoebox - Guided Tour';

$stylesheet = '/styles.css';
$favicon = '/images/apps/Shoebox-16.png';
$generator = 'BBEdit 7.0';

echo("<html>\n<head>\n\t<title>$title</title>\n" . 
	"\t<meta name=\"generator\" content=\"$generator\">\n" .
	"\t<link rel=\"SHORTCUT ICON\" href=\"$favicon\">\n" .
	"\t<link rel=\"stylesheet\" type=\"text/css\" href=\"$stylesheet\" media=\"screen\">\n</head>\n");

?>

<BODY>

<?php

foreach($pages as $index => $page) {
	if ($index > 0) echo('<br /><HR><br />');
	echo(bold($page['title']) . '<br />');
	if ($page['image'] != 'window.jpg' || $page['title'] == 'Welcome') echo(img('images/' . $page['image'], $page['title'], $width = 640, $height = 400) . '<br /><br />');
	echo($page['text'] . '<br />');
}

?>

</body></html>