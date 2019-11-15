<?php


namespace app\admin\validate;
use think\Validate;

class Goods extends Validate
{
    protected $rule = [
        'goods_id' => 'unique:goods'
    ];
    protected $message = [
        'goods_id.unique' => '商品<span style="color:red">已导入</span>'
    ];
}