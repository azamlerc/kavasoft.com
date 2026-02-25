<?php

include($doc_root . '../products.php');

# Page title
$page_name = 'home';
$doc_root = './';
$title = 'KavaMovies';
$folder = 'KavaMovies';
$store_product = 'kavamovies';
$slogan = "The Mac movie database.";

include($doc_root . '../shared.php');

head($title, $folder);

banner_table_1();

$email = $_GET['email'];
$favorite = $_GET['favorite'];

/*if ($email && $favorite) {
	$subject = 'KavaMovies';
	$body = "Dear movie fan,\n\nThanks for your interest in KavaMovies. " . 
	"We will let you know when the program is ready for download!\n\nBest regards,\nKavaSoft\n\n\nEmail address: $email\nFavorite movie: $favorite";

	require_once '../licenses/XPertMailer.php';

	$mail = new XpertMailer(SMTP_RELAY_CLIENT, 'mail.kavasoft.com');
	$mail->auth('info@kavasoft.com', 'WwcbD4P;', AUTH_DETECT, SSL_TRUE, 465);
	$mail->from('info@kavasoft.com', 'KavaSoft');
	$mail->headers(array('Bcc' => 'info@kavasoft.com'));

	return $mail->send($email, $subject, $body);
}

$invitation_form = "Give us your email address and we'll invite you to the premi&egrave;re of KavaMovies! $br <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"8\"><form name=\"movieform\" method=\"get\" action=\"index.php\"><tr><td align=\"right\" class=\"sidebar\">Your email:</td><td><input type=\"text\" name=\"email\" size=\"20\" maxlength=\"100\"></td></tr><tr><td align=\"right\" class=\"sidebar\">Favorite movie:</td><td><input type=\"text\" name=\"favorite\" size=\"20\" maxlength=\"100\"></td></tr><tr><td align=\"center\" colspan=\"2\"><input type=\"submit\" value=\"&nbsp;&nbsp;&nbsp;Cool&nbsp;&nbsp;&nbsp;\"></td></tr></form></table>";

box('sidebar', 'Invitation', ($email && $favorite) ? "Thanks, we'll keep you posted!" : $invitation_form);
*/
app_download_box("English, German, $br&nbsp;&nbsp;French &amp; Dutch");

buy_box();

quotes_box('sidebar');

whatsnew_box();

requirements_box(array('leopard', '64bit', 'compatibility'));

// box('sidebar', 'KavaLife', hyperlink("/store/index.php?kavalife=1", "Organize your movies, music and photos!<br>Buy KavaMovies together with KavaTunes and Shoebox Express for just $80.", 'sidebar_link'));

questions_box(array(/*'faq', */'help', 'orders', 'service', 'pr', 'contact'));

table_2(); 

box('text', 'About KavaMovies', "KavaMovies lets you organize the movies you've seen, the movies you want to see, and the movies in your collection. It connects to the internet and downloads tons of information about each of your movies in realtime. ");

screenshot(600, 427, 1024, 728);

features_box();

echo(spacer_img(25, 25));

table_3(); 

other_programs($title);

footer(); 

?>

