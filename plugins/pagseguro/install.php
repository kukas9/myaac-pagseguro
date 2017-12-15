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
if(!fieldExist('accounts', 'coins')) {
	error("Your OTServ version is not supported. You don't have <b>coins</b> field in <b>accounts</b> table.<br/>
	This plugin will not work correctly.");
	return;
}
*/

if(!tableExist('pagseguro_transactions'))
{
	$db->query("
CREATE TABLE IF NOT EXISTS `pagseguro_transactions` (
	`transaction_code` varchar(36) NOT NULL,
	`name` varchar(200) DEFAULT NULL,
	`payment_method` varchar(50) NOT NULL,
	`status` varchar(50) NOT NULL,
	`item_count` int(11) NOT NULL,
	`data` datetime NOT NULL,
	UNIQUE KEY `transaction_code` (`transaction_code`,`status`),
	KEY `name` (`name`),
	KEY `status` (`status`)
) ENGINE=MyISAM;
		");
	success('Imported pagseguro_transactions table to database.');
}

?>