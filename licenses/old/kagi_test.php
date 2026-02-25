<html>
<head>
	<title>Kagi Test</title>
</head>
<body>
<?php

include('../licenses.php');

$program = $_GET['program'];
echo(get_kagi_program($program));

?>
</body>
</html>