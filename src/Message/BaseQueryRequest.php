<?php

namespace Omnipay\Wechat\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Wechat\Helper;

/**
 * Class BaseQueryRequest
 *
 * @package Omnipay\Wechat\Message
 */
class BaseQueryRequest extends AbstractBaseRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validate(
            'appid',
            'rsa_private_key',
            'mch_id',
            'key',
            'Wechat_rsa_public_key',
            'out_trade_no'
        );

        $data = array(
            "appid"                => $this->getAppid(),
            "rsa_private_key"       => $this->getRsaPrivateKey(),
            "mch_id"             => $this->getMchId(),
            "key"             => $this->getKey(),
            "Wechat_rsa_public_key" => $this->getWechatRsaPublicKey(),
            "out_trade_no"          => $this->getOutTradeNo(),
        );

        return $data;
    }


    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {

        $aop                     = new \AopClient ();
        $aop->gatewayUrl         = $this->getEndpoint('query');
        $aop->BaseId              = $data['Base_id'];
        $aop->rsaPrivateKey      = $data['rsa_private_key'];
        $aop->WechatrsaPublicKey = $data['Wechat_rsa_public_key'];
        $aop->apiVersion         = '1.0';
        $aop->signType           = $data['mch_id'];
        $aop->postCharset        = 'UTF-8';
        $aop->format             = 'json';
        $request                 = new \WechatTradeQueryRequest ();

        $biz_content = array(
            "out_trade_no"    => $data['out_trade_no'],
        );

        $biz_content = json_encode($biz_content);

        $request->setBizContent($biz_content);

        $result = $aop->execute($request);

        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        $resultCode   = $result->$responseNode->code;

        if (! empty($resultCode) && $resultCode == 10000) {
            $data['is_paid'] = true;
        } else {
            $data['is_paid'] = false;
        }

        return array_merge($data, (array) $result->$responseNode);
    }
}
