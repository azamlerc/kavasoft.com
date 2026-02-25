<?php 


# Page title
$page_name = 'home';
$doc_root = '../';
$title = 'Curator';
$folder = 'Curator';
$slogan = 'Frequently Asked Questions';

global $help_path;
$help_path = '../help/';

include($doc_root . '../shared.php');
include('faq.php');

head($title . ' - FAQ', $folder);

table_1(200);

$topic_links = '';
foreach($topics as $topic => $questions) {
	$topic_links .= hyperlink("index.php?topic=" . $topic, $topic, 'sidebar_link') . $br;
}

box('sidebar', 'Topics', $topic_links);

box('sidebar', 'More Questions?', 
	hyperlink('../help/pgs/faq.htm', 'Single Page', 'sidebar_link') . $br .
	hyperlink('../help/', 'Online Help', 'sidebar_link') . $br .
    hyperlink($email_address, 'Contact Us', 'sidebar_link'));
 
table_2(700);

$topic = $_GET['topic'];
if (!$topic) $topic = 'Music';
$questions = $topics[$topic];

$question_links = '';
if ($questions) {
	foreach($questions as $question) {
		$question_links .= hyperlink("index.php?topic=$topic&question=" . $question['name'], 
			$question['title'], 'sidebar_link') . $br;
	}
}

box('sidebar', $topic, $question_links);

$questions = $topics[$topic];
$question_name = $_GET['question'];
if (!$question_name) $question_name = $questions[0]['name'];

if ($questions) {
	foreach($questions as $question) {
		if ($question_name == $question['name']) {
			$question_title = $question['title'];
			$question_answer = $question['text'];

			box('text', $question_title, join($question_answer, "$br$br"), false);
		}
	}
}

table_3();

footer();

?>