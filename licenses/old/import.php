<?php

function validate($user, $pass) {
	return $user == 'kavasoft' && MD5($pass) == '8f393ce17cf4d13486b2d710caed555c';
}

if (!validate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
	header('WWW-Authenticate: Basic realm="System"');
	header('HTTP/1.0 401 Unauthorized');
	echo("Please enter a name and password.");
	exit();
}

?>

<html>
<head>
	<title>License Manager</title>
	<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>

<?php

echo("<form action=\"import.php\" method=\"get\">");

$filename = $_GET['filename'];

echo("<input type=\"text\" name=\"filename\" size=\"20\" value=\"$filename\">");
echo("<input type=\"submit\" name=\"import\" value=\"Import\">");

echo('</form>');

if ($filename && ($fh = fopen($filename, 'r'))) {

	require 'DB.php';
	$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');
	$prh = $dbh->prepare('INSERT INTO licenses (name,email,program,computer_number,license_key,date_paid,amount,method,language,version,email_sent) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
	// $prh = $dbh->prepare('INSERT INTO licenses (name,email) VALUES (?,?)');

	echo("<table border=\"1\" cellspacing=\"0\" cellpadding=\"2\">");

	$rows = array();
	while (! feof($fh)) {
		$row = fgets($fh, 200);
		$cols = explode('|', $row);
		if (count($cols) > 1) {
			$rows[] = $row;
			
			echo("<tr>");
		
			foreach($cols as $col) {
				echo("<td>$col</td>");
			}
			
			$sth = $dbh->execute($prh, $cols);
				
			echo("<td>" . $dbh->affectedRows() . "</td>");

			echo("</tr>");
		}
	}
	
	fclose($fh);
	echo('</table>');

//	$sth = $dbh->executeMultiple($prh, $rows);
	
	// echo("Imported " . $dbh->affectedRows() . " licenses.");
}

?>

</body>
</html>