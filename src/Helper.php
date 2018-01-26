<?php

namespace Omnipay\Wechat;

class Helper
{
    public static function getSignByMD5($params, $key)
    {
        $query = self::getStringByParams($params);

        $signature = md5($query . '&' . $key);

        return $signature;
    }

    public static function getStringByParams($params)
    {
        ksort($params);
        $query = http_build_query($params);
        $query = urldecode($query);

        return $query;
    }

    public static function sendHttpRequest($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-type:application/x-www-form-urlencoded;charset=UTF-8'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public static function getIp()
    {

    }
}
