<?php


namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Duo as duoModel;
use pdd\PddApiAuth;

class Duo extends Common
{
    public function loginDuo()
    {
        return $this->fetch();
    }
    public function getDuoMessageCode()
    {
        if($this->request->isAjax())
        {
            $mobile = $this->request->post('mobile');
            $url = 'https://jinbao.pinduoduo.com/network/api/common/createMessageCode';
            $header = [
                'Host: jinbao.pinduoduo.com',
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:68.0) Gecko/20100101 Firefox/68.0',
                'Accept: application/json, text/plain, */*',
                'Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2',
                'Accept-Encoding: gzip, deflate, br',
                'Content-Type: application/json;charset=utf-8',
                'Content-Length: 24',
                'Connection: keep-alive',
                'Referer: https://jinbao.pinduoduo.com/',
                'TE: Trailers'
            ];
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode(['mobile'=>$mobile]));
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_NONE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_REFERER,'https://jinbao.pinduoduo.com/');
            curl_setopt($ch,CURLOPT_ACCEPT_ENCODING,'gzip, deflate, br');
            curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
            curl_setopt($ch,CURLOPT_COOKIEJAR,'/tmp/cookie');
            curl_setopt($ch,CURLINFO_HEADER_OUT,true);
            $res = curl_exec($ch);
            //print_r(curl_getinfo($ch,CURLINFO_HEADER_OUT));
            curl_close($ch);
            return json_decode($res,true);
        }else{
            $this->error('非法访问！','/');
        }
    }

    public function auth()
    {
        $code = $this->request->get('code');
        $pddApiAuth = new PddApiAuth();
        $res = $pddApiAuth->getAccessToken($code);
        $res = json_decode($res,true);
        if(isset($res['error_response']))
        {
            return $this->error('授权失败，'.$res['error_response']['error_msg'].':)','/admin/index.html');
        }else{
            $model = duoModel::get(['u_id'=>$this->uid]);
            if(is_null($model))
            {
                $model = new duoModel();
            }
            $model->u_id = $this->uid;
            $model->access_token = $res['access_token'];
            $model->code = $code;
            $model->owner_name=$res['owner_name'];
            $model->owner_id=$res['owner_id'];
            $model->refresh_token =$res['refresh_token'];
            $model->expired_time = strtotime(date('Y-m-d H:i:s')) + 86400;
            $model->save();
            return $this->success('授权成功:)','/admin/index.html');
        }
        //var_dump(json_decode($res,true));
    }
}