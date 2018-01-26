<?php

namespace Omnipay\Wechat\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Wechat\Helper;

/**
 * Class BaseCompletePurchaseRequest
 * @package Omnipay\Wechat\Message
 */
class BaseCompletePurchaseRequest extends AbstractBaseRequest
{
    public function getData()
    {
        return $this->getRequestParams();
    }


    public function setRequestParams($value)
    {
        $this->setParameter('request_params', $value);
    }


    public function getRequestParams()
    {
        return $this->getParameter('request_params');
    }


    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $aop = new \AopClient;
        $aop->WechatrsaPublicKey = $this->getWechatRsaPublicKey();
        $flag = $aop->rsaCheckV1($_POST, NULL, $this->getSignType());

        $data['is_paid'] = false;
        if ($flag) {
            // 验证通过
            $data['is_paid'] = true;

            http_response_code(200);
            echo 'success';
        }

        return $this->response = new BaseCompletePurchaseResponse($this, $data);
    }
}
