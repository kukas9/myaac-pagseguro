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

require_once(LIBS . 'PagSeguroLibrary/PagSeguroLibrary.php');

$paymentRequest = new PagSeguroPaymentRequest();
$paymentRequest->addItem('1', $config['pagSeguro']['productName'], $_POST['itemCount'], $config['pagSeguro']['productValue']);
$paymentRequest->setCurrency("BRL");
$paymentRequest->setReference($_POST['reference']);
$paymentRequest->setRedirectUrl(BASE_URL . $config['pagSeguro']['urlRedirect']);
$paymentRequest->addParameter('notificationURL', BASE_URL . 'payments/pagseguro.php');

try {
	$credentials = PagSeguroConfig::getAccountCredentials();
	$checkoutUrl = $paymentRequest->register($credentials);
	header('Location:' . $checkoutUrl);

} catch (PagSeguroServiceException $e) {
	die($e->getMessage());
}

?>