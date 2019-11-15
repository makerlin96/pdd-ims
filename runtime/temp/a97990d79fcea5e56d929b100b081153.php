<?php /*a:2:{s:74:"F:\phpstudy_pro\WWW\pdd\application\admin\view\goods\pdd_goods_search.html";i:1565768561;s:61:"F:\phpstudy_pro\WWW\pdd\application\admin\view\base\base.html";i:1565751064;}*/ ?>
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
<div class="layui-card">
    <div class="layui-card-header">
        搜索面板
    </div>
    <div class="layui-card-body">
        <form class="layui-form" id="searchPanel">
            <div class="layui-form-pane layui-inline">
                <div class="layui-form-item layui-inline">
                    <label for="goodsName" class="layui-form-label">商品标题</label>
                    <div class="layui-input-inline">
                        <input name="goodsName" id="goodsName" type="text" class="layui-input layui-input-inline" placeholder="请输入商品标题">
                    </div>

                    <label for="sortType" class="layui-form-label">排序方式</label>
                    <div class="layui-input-inline">
                        <select name="sortType" id="sortType" class="layui-form-select">
                            <option value="0" selected="selected">0.综合排序</option>
                            <option value="1">1.按佣金比率升序</option>
                            <option value="2">2.按佣金比例降序</option>
                            <option value="3">3.按价格升序</option>3-;
                            <option value="4">4.按价格降序</option>
                            <option value="5">5.按销量升序</option>
                            <option value="6">6.按销量降序</option>
                            <option value="7">7.优惠券金额排序升序</option>
                            <option value="8">8.优惠券金额排序降序</option>
                            <option value="9">9.券后价升序排序</option>
                            <option value="10">10.券后价降序排序</option>
                            <option value="11">11.按照加入多多进宝时间升序</option>
                            <option value="12">12.按照加入多多进宝时间降序</option>
                            <option value="13">13.按佣金金额升序排序</option>
                            <option value="14">14.按佣金金额降序排序</option>
                            <option value="15">15.店铺描述评分升序</option>
                            <option value="16">16.店铺描述评分降序</option>
                            <option value="17">17.店铺物流评分升序</option>
                            <option value="18">18.店铺物流评分降序</option>
                            <option value="19">19.店铺服务评分升序</option>
                            <option value="20">20.店铺服务评分降序</option>
                            <option value="27">27.描述评分击败同类店铺百分比升序</option>
                            <option value="28">28.描述评分击败同类店铺百分比降序</option>
                            <option value="29">29.物流评分击败同类店铺百分比升序</option>
                            <option value="30">30.物流评分击败同类店铺百分比降序</option>
                            <option value="31">31.服务评分击败同类店铺百分比升序</option>
                            <option value="32">32.服务评分击败同类店铺百分比降序</option>
                        </select>
                    </div>
                    <label for="withCoupon" class="layui-form-label">优惠券</label>
                    <div class="layui-input-inline">
                        <select name="withCoupon" id="withCoupon" class="layui-form-select">
                            <option value="true">仅优惠券商品</option>
                            <option value="false" selected="selected">所有商品</option>
                        </select>
                    </div>
                    <label for="cat" class="layui-form-label">商品类目</label>
                    <div class="layui-input-inline">
                        <select name="cat" id="cat" class="layui-form-select">
                            <option value="0" selected="selected">0 |- 所有分类</option>
                            <?php if(is_array($cats) || $cats instanceof \think\Collection || $cats instanceof \think\Paginator): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_id']; ?> |- <?php echo $cat['cat_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <label for="merchantType" class="layui-form-label">
                        店铺类型
                    </label>
                    <div class="layui-input-inline">
                        <select name="merchantType" id="merchantType" class="layui-form-select">
                            <option value="0" selected="selected">全部类型</option>
                            <option value="1">个人</option>
                            <option value="2">企业</option>
                            <option value="3">旗舰店</option>
                            <option value="4">专卖店</option>
                            <option value="5">专营店</option>
                            <option value="6">普通店</option>
                        </select>
                    </div>
                    <a href="javascript:void (0);" id="search" class="layui-btn layui-btn-radius">
                        搜索
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<table id="goodsList" lay-filter="goodsList"></table>
<script type="text/html" id="toolbar">
    <a href="javascript:void(0);" class="layui-btn" id="import">导入所选数据</a>
    <a href="javascript:void(0);" class="layui-btn" id="importAll">导入所有已采集数据</a>
</script>

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
                    <a target="_blank" href="https://mobile.yangkeduo.com/chat_detail.html?mall_id={{d.mall_id}}&goods_id={{d.goods_id}}" id="contactBusiness" class="layui-btn layui-btn-normal layui-btn-xs layui-btn-radius">联系商家</a>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="goodsPlan">
    {{# if(d.zs_duo_id!=0){}}
    <a href="javascript:void (0);" class="layui-btn layui-btn-danger layui-btn-xs">已有招商推广计划</a><br>
    {{# }else{}}
    <a href="javascript:void (0);" class="layui-btn layui-btn-xs">暂无招商推广计划</a><br>
    {{# }}}
    <a href="javascript:void (0);" lay-event="searchPlan" class="layui-btn layui-btn-radius layui-btn-normal layui-btn-xs">查询商品推广计划</a>
</script>
<script type="text/html" id="coupon">
<div class="layui-row">
    {{# if(!d.has_coupon){}}
        <span style="color: red;"><b>该商品暂无优惠券</b></span>
    {{# }else{}}
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
    {{# }}}
</div>
</script>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="/js/extend.js"></script>

<script type="text/javascript">
    layui.use(['element','form','layer','table','util'],function () {
        let element = layui.element,
            form = layui.form,
            layer = layui.layer,
            util = layui.util,
            table = layui.table;
        //导入商品
        $("body").on('click','#import',function () {
            let checkStatus = table.checkStatus('goodsList');
            if(checkStatus.data.length==0)
            {
                layer.msg('你还没有选择数据哦:)');
                return false;
            }
            layer.confirm('是否确认导入所选数据？',function () {
                $.ajax({
                    url:'<?php echo url("/admin/importGoodsInfo"); ?>',
                    type:'post',
                    dateType:'json',
                    data:checkStatus,
                    beforeSend:function () {
                        layer.load(3)
                    },
                    success:function (data) {
                        layer.closeAll('loading');
                        if(data === 1)
                        {
                            layer.msg('导入成功:)');
                        }else{
                            let content = '以下商品已导入，本次未进行导入操作<br>';
                            if(data.code == 0)
                            {
                                layer.msg(data.msg);
                                return false;
                            }
                            for(let i = 0; i<data.length;i++)
                            {
                                content =content + data[i] + '<br>';
                            }
                            layer.open({
                                title:'提示',
                                content:content,
                                area:['680px','500px']
                            })
                        }
                    }
                })
            })
        });

        //表格渲染
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
                    field:'mall_name',
                    title:'商品信息',
                    unresize:true,
                    align:'center',
                    templet:'#goodsBaseInfo',
                    width:500
                },
                {
                    field:'has_coupon',
                    title:'优惠券信息',
                    sort:true,
                    unresize:true,
                    align:'center',
                    templet:'#coupon'
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
                    field:'zs_duo_id',
                    title:'推广计划',
                    sort:true,
                    unresize:true,
                    align:'center',
                    toolbar:'#goodsPlan'
                }
            ]],
            url:'<?php echo url("/admin/pddGoodsSearch"); ?>',
            method:'post',
            page:true,
            limit:15,
            limits:[15,30,50,100],
            title:'商品列表',
            height:'full-151',
            id:'goodsList',
            toolbar:'#toolbar'
        });

        //商品推广计划查询
        table.on('tool(goodsList)',function (obj) {
            const data = obj.data;
            const layEvent = obj.event;
            const tr = obj.tr;
            /*if(layEvent === 'searchPlan')
            {
                let content = "<?php echo url('/admin/goodsPlan'); ?>";
                layer.open({
                    type:2,
                    title:data.goods_name.substring(0,18)+'：商品推广计划',
                    content:"https://jinbao.pinduoduo.com/promotion/single-promotion?pageNumber=1&keyword="+data.goods_id,
                    area:['30%','50%'],
                    closeBtn:1,
                    shadeClose:true,
                    anim:1,
                    maxmin:true,
                    fixed:true,
                    resize:false,
                    scrollbar:false,
                })
            }*/
            layer.msg('当前版本尚未上线此功能，请耐心等待后续版本更新……',{time:5000});
        });

        //商品查询
        $("#search").on('click',function () {
            table.reload('goodsList',{
                page:{
                    curr:1
                },
                where:{
                    goodsName:$("#goodsName").val(),
                    sortType:$("#sortType").val(),
                    withCoupon:$("#withCoupon").val(),
                    cat:$("#cat").val(),
                    merchantType:$("#merchantType").val()
                }
            })
        });

        //导入所有已查询的商品
        $("#importAll").on('click',function () {
            layer.msg('此操作将会加重服务器负担，请问是否确认操作？');
        })
    });
</script>

</body>
</html>