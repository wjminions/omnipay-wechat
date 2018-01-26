<?php

namespace Omnipay\Wechat\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Class BaseResponse
 * @package Omnipay\Wechat\Message
 */
class BaseRefundResponse extends AbstractResponse
{

    public function isRedirect()
    {
        return false;
    }


    public function getRedirectMethod()
    {
        return 'POST';
    }


    public function getRedirectUrl()
    {
        return false;
    }


    public function getRedirectHtml()
    {
        return false;
    }


    public function getTransactionNo()
    {
        return isset($this->data['trade_no']) ? $this->data['trade_no'] : '';
    }


    public function isPaid()
    {
        if ($this->data['is_paid']) {
            return true;
        }

        return false;
    }


    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        if ($this->data['is_paid']) {
            return true;
        }

        return false;
    }

    public function getMessage()
    {
        return isset($this->data['sub_msg']) ? $this->data['sub_msg'] : $this->data['msg'];
    }
}
