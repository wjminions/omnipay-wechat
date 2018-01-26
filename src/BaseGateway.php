<?php

namespace Omnipay\Wechat;

use Omnipay\Common\AbstractGateway;

/**
 * Class BaseGateway
 * @package Omnipay\Wechat
 */
class BaseGateway extends AbstractGateway
{

    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     */
    public function getName()
    {
        return ' Wechat Base gateway';
    }


    public function setMchId($value)
    {
        return $this->setParameter('mch_id', $value);
    }

    public function getMchId()
    {
        return $this->getParameter('mch_id');
    }


    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }

    public function getKey()
    {
        return $this->getParameter('key');
    }


    public function setRsaPrivateKey($value)
    {
        return $this->setParameter('rsa_private_key', $value);
    }

    public function getRsaPrivateKey()
    {
        return $this->getParameter('rsa_private_key');
    }


    public function setWechatRsaPublicKey($value)
    {
        return $this->setParameter('Wechat_rsa_public_key', $value);
    }

    public function getWechatRsaPublicKey()
    {
        return $this->getParameter('Wechat_rsa_public_key');
    }


    public function setEnvironment($value)
    {
        return $this->setParameter('environment', $value);
    }

    public function getEnvironment()
    {
        return $this->getParameter('environment');
    }


    public function setAppid($value)
    {
        return $this->setParameter('appid', $value);
    }

    public function getAppid()
    {
        return $this->getParameter('appid');
    }


    public function setNotifyUrl($value)
    {
        return $this->setParameter('notify_url', $value);
    }

    public function getNotifyUrl()
    {
        return $this->getParameter('notify_url');
    }


    public function setOutTradeNo($value)
    {
        return $this->setParameter('out_trade_no', $value);
    }

    public function getOutTradeNo()
    {
        return $this->getParameter('out_trade_no');
    }


    public function setBody($value)
    {
        return $this->setParameter('body', $value);
    }

    public function getBody()
    {
        return $this->getParameter('body');
    }


    public function setTotalFee($value)
    {
        return $this->setParameter('total_fee', $value);
    }

    public function getTotalFee()
    {
        return $this->getParameter('total_fee');
    }


    public function setRefundAmount($value)
    {
        return $this->setParameter('refund_amount', $value);
    }

    public function getRefundAmount()
    {
        return $this->getParameter('refund_amount');
    }


    public function setOutRequestNo($value)
    {
        return $this->setParameter('out_request_no', $value);
    }

    public function getOutRequestNo()
    {
        return $this->getParameter('out_request_no');
    }


    public function setTradeNo($value)
    {
        return $this->setParameter('trade_no', $value);
    }

    public function getTradeNo()
    {
        return $this->getParameter('trade_no');
    }


    public function purchase(array $parameters = array ())
    {
        return $this->createRequest('\Omnipay\Wechat\Message\BasePurchaseRequest', $parameters);
    }


    public function completePurchase(array $parameters = array ())
    {
        return $this->createRequest('\Omnipay\Wechat\Message\BaseCompletePurchaseRequest', $parameters);
    }

    public function query(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Wechat\Message\BaseQueryRequest', $parameters);
    }


    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Wechat\Message\BaseRefundRequest', $parameters);
    }


    public function completeRefund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Wechat\Message\BaseCompleteRefundRequest', $parameters);
    }
}
