<?php
/**
 * Automatic PagSeguro payment system gateway.
 *
 * @name      myaac-pagseguro
 * @author    Ivens Pontes <ivenscardoso@hotmail.com>
 * @author    Slawkens <slawkens@gmail.com>
 * @website   github.com/slawkens/myaac-pagseguro
 * @website   github.com/ivenspontes/
 * @version   1.0
 */
defined('MYAAC') or die('Direct access not allowed!');

/*
	config.local.php example

$config['pagSeguro'] = array(
	'email' => "john@doe.com",
	'token' => "yourtokenhere",
	'urlRedirect' => '?subtopic=donate&action=final', // default should be good
	'productName' => 'Premium Points', // or Coins
	'productValue' => 1.00,
	'doublePoints' => false, // should points be doubled? for example: for 5 points donated you become 10.
	'donationType' => 'points', // points/coins
	'options' => array( // cost => points/coins
		'5,00' => 5,
		'10,00' => 10,
		'20,00' => 20,
		'40,00' => 40,
		'60,00' => 60,
	)
);

*/

if(!isset($config['pagSeguro']) || !count($config['pagSeguro']) || !count($config['pagSeguro']['options'])) {
	echo "PagSeguro is disabled. If you're an admin please configure this script in config.local.php.";
	return;
}
/*
if(strpos(BASE_URL, 'localhost') !== false || strpos(BASE_URL, '127.0.0.1') !== false) {
	echo 'PagSeguro is not supported on localhost (' . BASE_URL . '). Please change your domain to public one and visit this site again later.';
	return;
}*/

if(empty($action)) {
	if(!$logged) {
		echo 'You are not logged in. <a href="' . getLink('account/manage') . '">Log in</a> first to make a donate..';
	}
	else {
		echo $twig->render('donate.html.twig');
	}
}
elseif($action == 'final') {
	echo $twig->render('donate-final.html.twig');
}
?>
