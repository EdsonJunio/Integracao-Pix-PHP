<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Pix\Payload;

$obPayload = (new Payload)->setPixKey('12345678910')
    ->setDescription('Pagamento do pedido 123456')
    ->setMerchantName('Edson Almeida')
    ->setmerchantCity('Belo Horizonte')
    ->setAmount(100.00)
    ->setTxid('PHP123456');

    $payloadQrCode = $obPayload->getPayload();

echo "<pre>";
print_r($payloadQrCode);
echo "</pre>";
exit;
