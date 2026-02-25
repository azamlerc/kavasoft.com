<?php

include($doc_root . '../products.php');

include($doc_root . '../shared.php');

# Page title
$page_name = 'home';
$doc_root = './';
$title = 'Version Statistics';
$folder = 'iConquer';
$slogan = "Ahh, numbers&hellip;";

require 'DB.php';
$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');

function start_date($days) {
	$time = time() - (86400 * $days);
	$date = 'date_checked > \'' . date('Y-m-d', $time) . '\'';
	return $date;
}

function end_date($days) {
	$time = time() - (86400 * $days);
	$date = 'date_checked <= \'' . date('Y-m-d', $time) . '\'';
	return $date;
}

$statistics = array(
	'Mac OS X version' => array(
		'10.7' => array('major = 7'),
		'Snow Leopard' => array('major = 6'),
		'Leopard' => array('major = 5'),
	),
/*	'10.7 version' => array(
		'10.7.9' => array('major = 7', 'minor = 9'),
		'10.7.8' => array('major = 7', 'minor = 8'),
		'10.7.7' => array('major = 7', 'minor = 7'),
		'10.7.6' => array('major = 7', 'minor = 6'),
		'10.7.5' => array('major = 7', 'minor = 5'),
		'10.7.4' => array('major = 7', 'minor = 4'),
		'10.7.3' => array('major = 7', 'minor = 3'),
		'10.7.2' => array('major = 7', 'minor = 2'),
		'10.7.1' => array('major = 7', 'minor = 1'),
		'10.7.0' => array('major = 7', 'minor = 0'),
	),
*/	'Snow Leopard version' => array(
		'10.6.9' => array('major = 6', 'minor = 9'),
		'10.6.8' => array('major = 6', 'minor = 8'),
		'10.6.7' => array('major = 6', 'minor = 7'),
		'10.6.6' => array('major = 6', 'minor = 6'),
		'10.6.5' => array('major = 6', 'minor = 5'),
		'10.6.4' => array('major = 6', 'minor = 4'),
		'10.6.3' => array('major = 6', 'minor = 3'),
		'10.6.2' => array('major = 6', 'minor = 2'),
		'10.6.1' => array('major = 6', 'minor = 1'),
		'10.6.0' => array('major = 6', 'minor = 0'),
	),
	'Leopard version' => array(
		'10.5.9' => array('major = 5', 'minor = 9'),
		'10.5.8' => array('major = 5', 'minor = 8'),
		'10.5.7' => array('major = 5', 'minor = 7'),
		'10.5.6' => array('major = 5', 'minor = 6'),
		'earlier' => array('major = 5', 'minor < 6'),
	),
	'Architecture' => array(
		'Intel 64-bit' => array('arch = 3'),
		'Intel 32-bit' => array('arch = 2'),
		'PowerPC' => array('arch = 1'),
	),
	'Resolution' => array(
		'2560 x 1600' => array('resolution = 2560'),
		'2048 x 1280' => array('resolution = 2048'),
		'1920 x 1200' => array('resolution = 1920'),
		'1680 x 1050' => array('resolution = 1680'),
		'1600 x 1000' => array('resolution = 1600'),
		'1440 x 900' => array('resolution = 1440'),
		'1344 x 840' => array('resolution = 1344'),
		'1280 x 800' => array('resolution = 1280'),
		'1152 x 720' => array('resolution = 1152'),
		'1024 x 768' => array('resolution = 1024'),
		'960 x 600' => array('resolution = 960'),
		'800 x 600' => array('resolution = 800'),
		'720 x 480' => array('resolution = 720'),
		'640 x 480' => array('resolution = 640'),
	),
	'Application' => array(
		'iConquer'   => array('program = 5'),
		'Shoebox'   => array('program = 1'),
		'KavaMovies'   => array('program = 3'),
		'KavaServices'   => array('program = 7'),
		'KavaTunes'   => array('program = 2'),
		'HyperImage'   => array('program = 4'),
		'Curator'   => array('program = 6'),
	),
	'iConquer version' => array(
		'4.1'   => array('program = 5', "version = '4.1'"),
		'4.0.2' => array('program = 5', "version = '4.0.2'"),
		'4.0.1' => array('program = 5', "version = '4.0.1'"),
		'4.0'   => array('program = 5', "version = '4.0'"),
		'3.0.1' => array('program = 5', "version = '3.0.1'"),
		'3.0'   => array('program = 5', "version = '3.0'"),
		'earlier' => array('program = 5', "version = ''"),
	),
	'KavaMovies version' => array(
		'1.5'   => array('program = 3', "version = '1.5'"),
		'1.4.5'   => array('program = 3', "version = '1.4.5'"),
		'1.4.4'   => array('program = 3', "version = '1.4.4'"),
		'1.4.3'   => array('program = 3', "version = '1.4.3'"),
		'1.4.2'   => array('program = 3', "version = '1.4.2'"),
		'1.4.1'   => array('program = 3', "version = '1.4.1'"),
		'1.4'   => array('program = 3', "version = '1.4'"),
		'earlier' => array('program = 3', "version = ''"),
	),
	'KavaTunes version' => array(
		'4.1'   => array('program = 2', "version = '4.1'"),
		'4.0.2' => array('program = 2', "version = '4.0.2'"),
		'4.0.1' => array('program = 2', "version = '4.0.1'"),
		'4.0'   => array('program = 2', "version = '4.0'"),
		'earlier' => array('program = 2', "version = ''"),
	),
	'KavaServices version' => array(
		'4.2'   => array('program = 7', "version = '4.2'"),
		'4.1.2' => array('program = 7', "version = '4.1.2'"),
		'4.1.1' => array('program = 7', "version = '4.1.1'"),
		'4.1'   => array('program = 7', "version = '4.1'"),
		'earlier' => array('program = 7', "version = ''"),
	),
	'HyperImage version' => array(
		'3.1'   => array('program = 4', "version = '3.1'"),
		'3.0'   => array('program = 4', "version = '3.0'"),
		'2.0.2'   => array('program = 4', "version = '2.0.2'"),
		'2.0.1'   => array('program = 4', "version = '2.0.1'"),
		'2.0'   => array('program = 4', "version = '2.0'"),
		'earlier' => array('program = 4', "version = ''"),
	),
	'Days' => array(
		'Today' => array(start_date(1), end_date(0)),
		'Yesterday' => array(start_date(2), end_date(1)),
		'2 days ago' => array(start_date(3), end_date(2)),
		'3 days ago' => array(start_date(4), end_date(3)),
		'4 days ago' => array(start_date(5), end_date(4)),
		'5 days ago' => array(start_date(6), end_date(5)),
		'6 days ago' => array(start_date(7), end_date(6)),
	),
	'Weeks' => array(
		'This week' => array(start_date(7), end_date(0)),
		'Last week' => array(start_date(14), end_date(7)),
		'2 weeks ago' => array(start_date(21), end_date(14)),
		'3 weeks ago' => array(start_date(28), end_date(21)),
	),
	'Months' => array(
		'This month' => array(start_date(30), end_date(0)),
		'Last month' => array(start_date(60), end_date(30)),
		'2 months ago' => array(start_date(90), end_date(60)),
		'3 months ago' => array(start_date(120), end_date(90)),
	),
	'Years' => array(
		'This year' => array(start_date(365), end_date(0)),
		'Last year' => array(start_date(365*2), end_date(365)),
		'2 years ago' => array(start_date(365*3), end_date(365*2)),
		'3 years ago' => array(start_date(365*4), end_date(365*3)),
	),
);

$filters = array();

$start = get_value('start');
$end = get_value('end');
$major = get_value('major');
$minor = get_value('minor');
$program = get_value('program');
$version = get_value('version');
$arch = get_value('arch');

if (isset($start)) $filters[] = "date_checked > '$start'";
if (isset($end)) $filters[] = "date_checked <= '$end'";
if (isset($major)) $filters[] = "major = $major";
if (isset($minor)) $filters[] = "minor = $minor";
if (isset($program)) $filters[] = "program = $program";
if (isset($version)) $filters[] = "version = '$version'";
if (isset($arch)) $filters[] = "arch = $arch";

foreach($statistics as $section => $queries) {
	foreach($queries as $label => $terms) {
		if ($terms == $filters) {
			if (strpos($section, 'version')) {
				$slogan = str_replace('version ', '', "$section $label");
			} else {
				$slogan = "$label";
			}
		}
	}
}

$image = 'images/snow_leopard.png';
if ($major == 5) $image = 'images/leopard.png';
else if ($arch == 1) $image = 'images/powerpc.png';
else if ($arch == 2) $image = 'images/intel32.png';
else if ($arch == 3) $image = 'images/intel64.png';
else if ($program == 1) $image = '/images/apps/Shoebox-300.png';
else if ($program == 2) $image = '/images/apps/KavaTunes-300.png';
else if ($program == 3) $image = '/images/apps/KavaMovies-300.png';
else if ($program == 4) $image = '/images/apps/HyperImage-300.png';
else if ($program == 5) $image = '/images/apps/iConquer-300.png';
else if ($program == 6) $image = '/images/apps/Curator-300.png';
else if ($program == 7) $image = '/images/apps/KavaServices-300.png';

head($title, $folder);

table_1(200, 825, $image);

box('sidebar', 'Statistics', 'When our programs are launched, they automatically check to make sure that you have the latest version. As part of this process, the application and operating system version are sent to our server, and we keep track of this information for statistical purposes.<br><br>Click any statistic for more detailed information.');

$terms = args_for_terms(array(start_date(1), end_date(0)));
$historical .= "<a href=\"index.php?$terms\" class=\"sidebar_link\">today</a>, ";

$terms = args_for_terms(array(start_date(2), end_date(1)));
$historical .= "<a href=\"index.php?$terms\" class=\"sidebar_link\">yesterday</a>,<br>&nbsp;&nbsp;&nbsp;";

for ($i = 2; $i < 7; $i++) {
	$terms = args_for_terms(array(start_date($i + 1), end_date($i)));
	$historical .= "<a href=\"index.php?$terms\" class=\"sidebar_link\">$i</a> ";
}
$historical .= 'days ago <br>';

$terms = args_for_terms(array(start_date(7), end_date(0)));
$historical .= "<a href=\"index.php?$terms\" class=\"sidebar_link\">this week</a>, ";

$terms = args_for_terms(array(start_date(14), end_date(7)));
$historical .= "<a href=\"index.php?$terms\" class=\"sidebar_link\">last week</a>,<br>&nbsp;&nbsp;&nbsp;";

for ($i = 2; $i < 7; $i++) {
	$terms = args_for_terms(array(start_date(($i + 1) * 7), end_date($i * 7)));
	$historical .= "<a href=\"index.php?$terms\" class=\"sidebar_link\">$i</a> ";
}
$historical .= 'weeks ago <br>';

$terms = args_for_terms(array(start_date(30), end_date(0)));
$historical .= "<a href=\"index.php?$terms\" class=\"sidebar_link\">this month</a>, ";

$terms = args_for_terms(array(start_date(60), end_date(30)));
$historical .= "<a href=\"index.php?$terms\" class=\"sidebar_link\">last month</a>,<br>&nbsp;&nbsp;&nbsp;";

for ($i = 2; $i < 7; $i++) {
	$terms = args_for_terms(array(start_date(($i + 1) * 30), end_date($i * 30)));
	$historical .= "<a href=\"index.php?$terms\" class=\"sidebar_link\">$i</a> ";
}
$historical .= 'months ago <br>';

box('sidebar', 'Historical data', $historical);
/*
foreach($statistics as $section => $queries) {
	$output = '';
	$links = array();
	
	foreach($queries as $label => $terms) {
		$terms = args_for_terms($queries[$label]);
		$links[] = "<a href=\"index.php?$terms\" class=\"text_link\">$label</a>";
	}
	
	box('sidebar', $section, implode(' &bull; ', $links));
}
*/

table_2(); 

function get_count($dbh, $terms, $filter = true) {
	global $filters;
	if ($terms == $filters) return 0; // section is redundant 
	if ($filter)
		$terms = array_merge($terms, $filters);
	else if (count($filters) == 2)
		$terms[] = $filters[0];
		
	$sql = "SELECT COUNT(id) FROM versions WHERE " . implode(" and ", $terms);
	// echo($sql . '<br>');
	$results = $dbh->query($sql);
	$row = $results->fetchRow(0);
	return $row[0];
}

function args_for_terms($terms) {
	$args = array();
	foreach($terms as $term) {
		$term = str_replace('date_checked > ', 'start=', $term);
		$term = str_replace('date_checked <= ', 'end=', $term);
		$term = str_replace('\'', '', $term);
		$term = str_replace(' ', '', $term);
		$args[] = $term;
	}
	return implode('&', $args);
}

if (count($filters) && strpos($filters[0], 'date_checked') === false) {
	$shown = false;
	$start = 30;
	$interval = 1;
	$output = '';
	
	for ($i = $start; $i >= 0; $i -= $interval) {
		$timespan = array(start_date($i + 1), end_date($i)); // only use full records
		$full_records = strpos($filters[0], 'program') !== 0;
		if ($full_records) $timespan[] = 'major > 0';
		$total = get_count($dbh, $timespan, false);
		if ($total) {
			$count = get_count($dbh, $timespan);
			$percent = $count / $total * 100;
			$height = round($percent);
			if ($height) {
				if (!$shown && $percent > 0) {
					$output .= sprintf("%.1f%% ", $percent);
					$shown = true;
				}
				$output .= ("<img src=\"images/bar2.png\" width=\"14\" height=\"$height\">");
				if ($i == 0) $output .= sprintf(" %.1f%%", $percent);
			}
		}
	} 
	
	if ($shown) box('text', 'Timeline', $output);
}

foreach($statistics as $section => $queries) {
	$total = 0;
	$output = '<table border="0" cellspacing="3" cellpadding="0">';
	$results = array();
	$bar_width = 350;
	
	foreach($queries as $label => $terms) {
		$count = get_count($dbh, $terms);	
		$total += $count;
		if ($count) $results[$label] = $count;
	}
	
	foreach($results as $label => $count) {
		$percent = $count / $total * 100;
		if ($percent >= 0.9) {
			$width = $count / $total * $bar_width;
			$rounded = sprintf('%0.1f', $percent);
			$bar = "<img src=\"images/bar.png\" width=\"$width\" height=\"14\">";
			$terms = args_for_terms($queries[$label]);
			$link = "index.php?$terms";
			$bar = hyperlink($link, $bar);
			$label = hyperlink($link, $label, 'text_link');
			$rounded = hyperlink($link, $rounded, 'text_link');
			$output .= "<tr>";
			$output .= "<td width=\"100\" align=\"right\">$label:</td>";		
			// $output .= "<td width=\"60\" align=\"right\">$count</td>";		
			$output .= "<td width=\"65\" align=\"right\">$rounded%&nbsp;&nbsp;</td>";		
			$output .= "<td width=\"$bar_width\">$bar</td>";		
			$output .= "</tr>";
		}
	}
	
	$output .= '</table>';
	
	$min_one_sections = array('Weeks', 'Months', 'Years');
	$min_count = array_search($section, $min_one_sections) === false ? 0 : 1;
	if ($total && count($results) > $min_count) 
		box('text', $section, $output);
}

table_3(); 

footer(); 

?>