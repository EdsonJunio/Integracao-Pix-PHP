<?php

namespace App\Pix;

class Payload
{
     /**
      * IDs do payload do pix
      * @var string
      */

    const ID_PAYLOAD_FORMAT_INDICATOR = '00';
    const ID_MERCHANT_ACCOUNT_INFORMATION = '26';
    const ID_MERCHANT_ACCOUNT_INFORMATION_GUI = '00';
    const ID_MERCHANT_ACCOUNT_INFORMATION_KEY = '01';
    const ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION = '02';
    const ID_MERCHANT_CATEGORY_CODE = '52';
    const ID_TRANSACTION_CURRENCY = '53';
    const ID_TRANSACTION_AMOUNT = '54';
    const ID_COUNTRY_CODE = '58';
    const ID_MERCHANT_NAME = '59';
    const ID_MERCHANT_CITY = '60';
    const ID_ADDITIONAL_DATA_FIELD_TEMPLATE = '62';
    const ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID = '05';
    const ID_CRC16 = '63';

    /**
     * Chave pix
     * @var string
     */
    private $pixkey;

    /**
     * Descrição do pagaento
     * @var string
     */
    private $description;

    /**
     * Nome do titular da conta
     * @var string
     */
    private $merchantName;

    /**
     * Cida do titular da conta
     * @var string
     */
    private $merchantCity;

    /**
     * ID da transação pix
     * @var string
     */
    private $txid;

    /**
     * valor da transação
     * @var string
     */
    private $amount;

    /**
     * Método responsável por definir o valor de $pixKey
     * @param string $pixkey
     */
    public function setPixKey($pixkey)
    {
        $this->pixkey = $pixkey;
        return $this;
    }

    /**
     * Método responsável por definir o valor de $description
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Método responsável por definir o valor de $merchantName
     * @param string $merchantName
     */
    public function setMerchantName($merchantName)
    {
        $this->merchantName = $merchantName;
        return $this;
    }

    /**
     * Método responsável por definir o valor de $merchantCity
     * @param string $merchantCity
     */
    public function setMerchantCity($merchantCity)
    {
        $this->merchantCity = $merchantCity;
        return $this;
    }

    /**
     * Método responsável por definir o valor de $txid
     * @param string $txid
     */
    public function setTxid($txid)
    {
        $this->txid = $txid;
        return $this;
    }

    /**
     * Método responsável por definir o valor de $amount
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = number_format($amount,2,'.','');
        return $this;
    }

    /**
     *responsavel por retornar o valor completo de um objeto do payload
     * @return string $id
     * @return string $value
     * @return string $id.$size.$value
     */
    private function getValue($id,$value)
    {
        $size = str_pad(strlen($value), 2, '0', STR_PAD_LEFT);
        return $id . $size . $value;
    }

    /**
     * Método responsável por retornar os valores completos da informação da conta
     * @return string
     */
    private function getMerchantAccountInformation()
    {
        // DOMÍNIO DO BANCO
        $gui = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_GUI, 'br.gov.bcb.pix');
        // CHAVE PIX
        $key = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_KEY,$this->pixkey);
        // DESCRIÇÃO DO PAGAMENTO
        $description = strlen($this->description) ? $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION,$this->description) : '';
        //CRIAR O PAYLOAD
        return $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION,$gui.$key.$description);
    }

    /**
     * Método responsável por retornar os valores completos do compo adicional do pix(TXID)
     * @return string
     */
    private function getAdditionalDataFielTemplate()
    {
        //TXID
        $txid = $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID, $this->txid);
        //RETORNA O VALOR COMPLETO
        return $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE, $txid);
    }

    /**
     * Método responsável por gerar o código completo do payload pix
     * @return string
     */
    public function getPayload()
    {
        //CRIAR O PAYLOAD
        $payload = $this->getValue(self::ID_PAYLOAD_FORMAT_INDICATOR, '01') .
            $this->getMerchantAccountInformation() .
            $this->getValue(self::ID_MERCHANT_CATEGORY_CODE, '0000') .
            $this->getValue(self::ID_TRANSACTION_CURRENCY, '986').
            $this->getValue(self::ID_TRANSACTION_AMOUNT,$this->amount).
            $this->getValue(self::ID_COUNTRY_CODE,'BR').
            $this->getValue(self::ID_MERCHANT_NAME,$this->merchantName).
            $this->getValue(self::ID_MERCHANT_CITY,$this->merchantCity).
            $this->getAdditionalDataFielTemplate();
        return $payload;
    }



















































}