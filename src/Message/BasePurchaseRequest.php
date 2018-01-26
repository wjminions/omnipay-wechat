<?php

namespace Omnipay\Wechat\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Wechat\Helper;

class BasePurchaseRequest extends AbstractBaseRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validateData();

        $data = array(
            "appid"        => $this->getAppid(),
            "mch_id"       => $this->getMchId(),
            "key"          => $this->getKey(),
            "body"         => $this->getBody(),
            "out_trade_no" => $this->getOutTradeNo(),
            "total_fee"    => $this->getTotalFee(),
        );

        return $data;
    }


    private function validateData()
    {
        $this->validate(
            'appid',
            'mch_id',
            'key',
            'body',
            'out_trade_no',
            'total_fee'
        );
    }


    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $params = array(
            "appid"            => $this->getAppid(),
            "mch_id"           => $this->getMchId(),
            "body"             => $this->getBody(),
            "out_trade_no"     => $this->getOutTradeNo(),
            "total_fee"        => $this->getTotalFee(),
            "nonce_str"        => md5(time()),
            "sign_type"        => 'MD5',
            "spbill_create_ip" => $_SERVER["REMOTE_ADDR"],
            "notify_url"       => $this->getNotifyUrl(),
            "trade_type"       => 'APP',
        );

        $data['sign'] = Helper::getSignByMD5($params, $this->getKey());

        $response = Helper::sendHttpRequest($this->getEndpoint('pay'), $data);
var_dump($response);die;
        return $this->response = new BasePurchaseResponse($this, $response);
    }
}
