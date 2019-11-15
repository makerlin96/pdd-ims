<?php


namespace app\admin\model;
use think\Model;

class Goods extends Model
{
    public function searchGoodsNameAttr($query,$value)
    {
        if($value)
        {
            $query->where('goods_name','like','%'.$value.'%');
        }
    }
    public function searchMallNameAttr($query,$value)
    {
        if($value)
        {
            $query->where('mall_name','like','%'.$value.'%');
        }
    }
}