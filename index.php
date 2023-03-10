<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Pix\Payload;
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

//INSTANCIA PRINCIPAL DO PAYLOAD PIX
$obPayload = (new Payload)
    ->setPixKey('12345678910')
    ->setDescription('Pagamento do pedido 123456')
    ->setMerchantName('Edson Almeida')
    ->setmerchantCity('Belo Horizonte')
    ->setAmount(100.00)
    ->setTxid('PHP123456');

//CÓDIGO DE PAGAMENTO PIX
$payloadQrCode = $obPayload->getPayload();

//QR CODE
$obQrCode = new QrCode($payloadQrCode);

// IMAGEM DO QRCODE
$image = (new Output\Png)->output($obQrCode, 400);

?>

<h1>QRCODE PIX</h1>
<br>

<img src="data:image/png:base64, <?=base64_encode($image)?>">
<br><br>

Código pix:<br>
<strong><?=$payloadQrCode?></strong>


