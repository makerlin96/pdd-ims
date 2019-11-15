<?php
namespace pdd;

class PddApiAuth
{
    private $url = 'http://gw-api.pinduoduo.com/api/router';
    private $client_id = 'e4f3e204fdec4bfaa78210b9b34b2dd7';
    private $client_secret = '90c8fa7bb24de2493740d2f2ef1a873ecaa56db4';
    public $access_token = '';

    /***
     * 获取十三位时间戳
     * @return float
     */
    private function getMillisecond() {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    }

    private static function sendPost($url,$postData)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData,true));
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    private function getPddApi($apiType,$param)
    {
        $param['client_id'] = $this->client_id;
        $param['type'] = $apiType;
        $param['data_type'] = 'JSON';
        $param['timestamp'] = self::getMillisecond();
        $param['access_token'] = $this->access_token;
        ksort($param);    //  排序
        $str = '';      //  拼接的字符串
        foreach ($param as $k => $v) $str .= $k . $v;
        $sign = strtoupper(md5($this->client_secret. $str . $this->client_secret));    //  生成签名    MD5加密转大写
        $param['sign'] = $sign;
        $url = 'http://gw-api.pinduoduo.com/api/router';
        return self::sendPost($url, $param);
    }

    public function getPddData($apiType,$param)
    {
        return $this->getPddApi($apiType,$param);
    }

    public function getAccessToken($code)
    {
        $param = [
            'client_id'     =>  'e4f3e204fdec4bfaa78210b9b34b2dd7',
            'client_secret' =>  '90c8fa7bb24de2493740d2f2ef1a873ecaa56db4',
            'grant_type'    =>  'authorization_code',
            'code'          =>  $code,
            'redirect'      =>  'http://450b6581.nat123.cc/pdd/pddResponse'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, 'https://open-api.pinduoduo.com/oauth/token');
        curl_setopt($ch, CURLOPT_REFERER, 'https://open-api.pinduoduo.com/oauth/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($param,true));
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}