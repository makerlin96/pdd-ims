<?php /*a:2:{s:68:"F:\phpstudy_pro\WWW\pdd\application\admin\view\goods\goods_list.html";i:1565769460;s:61:"F:\phpstudy_pro\WWW\pdd\application\admin\view\base\base.html";i:1565751064;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo htmlentities($site_config['value']['title']); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all"/>
    <link rel="stylesheet" href="/css/public.css" media="all"/>
    
</head>
<body class="childrenBody">

<style>
    .layui-table-cell {
        height: auto;
        line-height: 36px;
    }
    tbody tr{
        height: auto;
        line-height: 36px;
    }
    .coupon-info{height:auto;align-items:center}
    .coupon-info span{font-size:12px}
    .coupon-info span i{background-color:#e3544c;color:#fff;padding:0 3px}
    .coupon-info span:first-child{border:1px solid #e3544c;color:#e3544c;font-weight:700;padding-right:2px}

</style>
<div class="layui-form-pane layui-inline">
    <div class="layui-form-item layui-inline">
        <label for="goodsName" class="layui-form-label">关键字</label>
        <div class="layui-input-block">
            <input name="goodsName" id="goodsName" type="text" class="layui-input layui-input-inline" placeholder="请输入商品标题">
            <input name="mallName" id="mallName" type="text" class="layui-input layui-input-inline" placeholder="请输入店铺名称">
            <a id="search" data-type="reload" href="javascript:void(0);" class="layui-btn layui-btn-danger">搜索</a>
            <a id="searchReset" href="javascript:void (0)" class="layui-btn layui-primary" type="reset" data-type="reset">重置搜索条件</a>
        </div>
    </div>
</div>

<table id="goodsList" lay-filter="goodsList"></table>


<script type="text/html" id="goodsBaseInfo">
    <div class="layui-row">
        <div class="layui-col-md3">
                <div class="layui-col-md12">
                    <img src="{{d.goods_thumbnail_url}}" width="100" height="100" alt="">
                </div>
                <div class="layui-col-md12 layui-center">
                    <span style="font-size: 12px">{{d.mall_name.substring(0,8)}}</span>
                </div>
        </div>
        <div class="layui-col-md9">
            <div class="layui-row">
                <div class="layui-col-md12 layui-left">
                    <a target="_blank" href="https://mobile.yangkeduo.com/goods2.html?goods_id={{d.goods_id}}">
                        <span>{{d.goods_name.substring(0,26)}}</span>
                    </a>
                </div>
            </div>
            <div class="layui-row">
                <div class="layui-col-md3 layui-left" >
                    <div class="coupon-info">
                        <span>
                            <i>券</i>
                            ￥{{(d.coupon_discount/100).toFixed(2)}}
                        </span>
                    </div>
                </div>
                <div class="layui-col-md9 layui-left" >
                    <div class="layui-row">
                        <div class="layui-col-md6 layui-left">
                            <span>单买价：<b>￥{{(d.min_normal_price/100).toFixed(2)}}</b></span>
                        </div>
                        <div class="layui-col-md6 layui-right">
                            <span>拼团价：<b>￥{{(d.min_group_price/100).toFixed(2)}}</b></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-row">
                <div class="layui-col-md6 layui-left">
                    <span>佣金比例：<span style="color: red">{{d.promotion_rate/10}}%</span></span>
                </div>
                <div class="layui-col-md6 layui-left">
                    <span>
                        销量：
                        {{# if(d.sales_tip === '10万+'){}}
                        <span style="color: red">{{d.sales_tip}}</span>
                        {{# }else{}}
                        <span style="color: orange">{{d.sales_tip}}</span>
                        {{# }}}
                    </span>
                </div>
            </div>
            <div class="layui-row layui-right" style="position: relative; top: -10px;">
                <div class="layui-col-md12 layui-right">
                    {{# if(d.is_contact){}}
                    <a target="_blank" href="https://mobile.yangkeduo.com/chat_detail.html?mall_id={{d.mall_id}}&goods_id={{d.goods_id}}" id="contactBusiness" onclick="javascript:contact({{d.goods_id}})" class="layui-btn layui-btn-danger layui-btn-xs layui-btn-radius">已联系{{d.is_contact}}次</a>
                    {{# }else{}}
                    <a target="_blank" href="https://mobile.yangkeduo.com/chat_detail.html?mall_id={{d.mall_id}}&goods_id={{d.goods_id}}" id="contactBusiness" onclick="javascript:contact({{d.goods_id}})" class="layui-btn layui-btn-normal layui-btn-xs layui-btn-radius">联系商家</a>
                    {{# }}}
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="coupon">
    <div class="layui-row">
        <div class="layui-col-md12">
            <span>起：{{$.unixToDate(d.coupon_start_time)}}</span><br>
            <span>止：{{$.unixToDate(d.coupon_end_time)}}</span>
        </div>
        <div class="layui-col-md6 layui-left">
            <span>总：{{d.coupon_total_quantity}}</span>
        </div>
        <div class="layui-col-md6 layui-right">
            <span>余：{{d.coupon_remain_quantity}}</span>
        </div>
    </div>
</script>


<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="/js/extend.js"></script>

<script type="text/javascript">
    layui.use(['element','form','layer','table'],function () {
        let element = layui.element,
            form = layui.form,
            layer = layui.layer,
            table = layui.table;
        let goodsList = table.render({
            elem:'#goodsList',
            cols:[[
                {
                    field:'goods_id',
                    title:'商品ID',
                    type:'checkbox',
                    LAY_CHECKED:true,
                    sort:true,
                    unresize:true,

                },
                {
                    field:'is_contact',
                    title:'商品信息',
                    unresize:true,
                    sort:true,
                    align:'center',
                    templet:'#goodsBaseInfo',
                    width:500
                },
                {
                    field:'has_coupon',
                    title:'优惠券信息',
                    sort:true,
                    unresize:true,
                    templet:'#coupon',
                    align:'center'
                },
                {
                    field:'activity_type',
                    title:'活动类型',
                    sort:true,
                    unresize:true,
                    align:'center',
                    templet:'<div><span style="color: red;"><b>{{$.activityType(d.activity_type)}}</b></span></div>'
                },
                {
                    field:'min_group_price',
                    title:'券后拼团价',
                    sort:true,
                    unresize:true,
                    templet:'<div><span><b>￥{{ (d.min_group_price-d.coupon_discount)/100 }}</b></span></div>',
                    align:'center'
                },
                {
                    field:'min_normal_price',
                    title:'券后单买价',
                    sort:true,
                    unresize:true,
                    templet:'<div><b>￥{{ (d.min_normal_price-d.coupon_discount)/100 }}</b></div>',
                    align:'center'
                },
                {
                    field:'promotion_rate',
                    title:'佣金比例',
                    sort:true,
                    unresize:true,
                    align:'center',
                    templet:'<div><span style="color: red">{{d.promotion_rate/10}}%</span></div>'
                },
                {
                    field:'be_in_charge_of',
                    title:'所属账号',
                    sort:true,
                    unresize:true,
                    align:'center'
                }
            ]],
            url:'<?php echo url("/admin/goodsList"); ?>',
            method:'post',
            page:true,
            limit:15,
            limits:[10,15,30,50,100],
            title:'商品列表',
            height:'full-70',
            id:'goodsList'
        });
        $("#search").on('click',function () {
            table.reload("goodsList",{
                page: {
                    curr: 1 //重新从第 1 页开始
                },
                where: {
                    goodsName: $("#goodsName").val(),  //搜索的关键字
                    mallName:$("#mallName").val()
                }
            })
        });
        $("#searchReset").on('click',function () {
            $("#goodsName").val('')
            $("#mallName").val('')
            table.reload('goodsList',{
                page:{
                    curr:1
                },
                where:{
                    goodsName: '',  //搜索的关键字
                    mallName:''
                }
            })
        })
    });
    let contact = function (goods_id) {
        $.ajax({
            url:'<?php echo url("/admin/contact"); ?>',
            type:"POST",
            dataType:'JSON',
            data:{
              "goods_id":goods_id
            },
            success:function (data) {
                if(data === 1) {
                    window.location.reload();
                }else {
                    if(data.code == 0){
                        layer.msg(data.msg);
                    }else{
                        layer.msg('程序错误！',{time:10000})
                    }

                }
            }
        })
    }
</script>

</body>
</html>