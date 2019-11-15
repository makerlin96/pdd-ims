<?php


namespace app\admin\controller;

use pdd\PddApi;

class Test
{
    public function index()
    {
        $model = new PddApi();
        $param = [
            'page' => 1,
            'page_size' => 20,
        ];
        return $model->getPddData('pdd.ddk.goods.pid.query',$param);
    }
}