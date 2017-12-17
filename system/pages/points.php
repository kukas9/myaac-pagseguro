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

require_once(PLUGINS . 'pagseguro/config.php');
if(!isset($config['pagSeguro']) || !count($config['pagSeguro']) || !count($config['pagSeguro']['options'])) {
	echo "PagSeguro is disabled. If you're an admin please configure this script in config.local.php.";
	return;
}

$is_localhost = strpos(BASE_URL, 'localhost') !== false || strpos(BASE_URL, '127.0.0.1') !== false;
if($is_localhost) {
	warning("PagSeguro is not supported on localhost (" . BASE_URL . "). Please change your domain to public one and visit this site again later.<br/>
	This site is visible, but you can't donate.");
}

if(empty($action)) {
	if(!$logged) {
		echo 'You are not logged in. <a href="' . getLink('account/manage') . '">Log in</a> first to make a donate..';
	}
	else {
		echo $twig->render('donate.html.twig', array('is_localhost' => $is_localhost));
	}
}
elseif($action == 'final') {
	echo $twig->render('donate-final.html.twig');
}
?>
