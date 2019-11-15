<?php /*a:2:{s:72:"F:\phpstudy_pro\WWW\pdd\application\admin\view\goods\mission_assign.html";i:1565767142;s:61:"F:\phpstudy_pro\WWW\pdd\application\admin\view\base\base.html";i:1565751064;}*/ ?>
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

<form class="layui-form">
    <div class="layui-row">
        <div class="layui-col-md3 layui-form-pane">
            <div class="layui-form-item">
                <label class="layui-form-label">分配给</label>
                <div class="layui-input-block">
                    <select name="uid" id="uid" lay-verify="required" class="layui-form-select">
                        <?php if(is_array($users) || $users instanceof \think\Collection || $users instanceof \think\Paginator): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $user['uid']; ?>"><?php echo $user['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="layui-col-md3 layui-form-pane">
            <div class="layui-form-item">
                <label class="layui-form-label">共</label>
                <div class="layui-input-block">
                    <select name="count" id="count" lay-verify="required" class="layui-form-select">
                        <option value="100">100条</option>
                        <option value="200">200条</option>
                        <option value="500">500条</option>
                        <option value="1000">1000条</option>
                        <option value="2000">2000条</option>
                        <option value="5000">5000条</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-col-md3 layui-form-pane layui-center">
            <a href="javascript:void(0);" onclick="javascript:start();" class="layui-btn layui-btn-normal layui-btn-radius">开始分配</a>
            <span style="color: red">剩余：<?php echo $sum; ?></span>
        </div>
    </div>
</form>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="/js/extend.js"></script>

<script type="text/javascript">
    layui.use(['element','form'],function () {
        let form = layui.form,
            element = layui.element;

        $(document).ready(function () {
            layui.layer.msg('当前剩余未分配商品：' + '<?php echo $sum; ?>' + '件',{time:5000})
        })
    });
    let start = function () {
        $.ajax({
            url:'<?php echo url("/admin/missionAssign"); ?>',
            type:'POST',
            dataType:'JSON',
            data:{
                uid:$("#uid").val(),
                count:$("#count").val()
            },
            success:function (data) {
                if(data){
                    layui.layer.msg('操作成功:)',{time: 2000});
                    window.location.reload();
                }else
                {
                    layui.layer.msg('操作失败:(<br>当前无未分配商品，请先采集:(',{time:3000})
                }
            }
        })
    };
</script>

</body>
</html>