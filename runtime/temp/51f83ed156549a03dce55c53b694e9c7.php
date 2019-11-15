<?php /*a:2:{s:66:"F:\phpstudy_pro\WWW\pdd\application\admin\view\user\user_list.html";i:1563781468;s:61:"F:\phpstudy_pro\WWW\pdd\application\admin\view\base\base.html";i:1565751064;}*/ ?>
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
    <blockquote class="layui-elem-quote quoteBox">
        <form class="layui-form">
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input type="text" class="layui-input searchVal" placeholder="请输入账号或昵称" />
                </div>
                <a class="layui-btn search_btn" data-type="reload">搜索</a>
            </div>
            <div class="layui-inline">
                <a class="layui-btn layui-btn-danger layui-btn-normal adduser_btn">添加</a>
            </div>
        </form>
    </blockquote>
    <table id="usersList" lay-filter="usersList"></table>
    <!--操作-->
    <script type="text/html" id="usersListBar">
        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
    </script>
</form>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="/js/extend.js"></script>

<script>
    layui.use(['form','layer','table'],function(){
        var form = layui.form,
            layer = parent.layer === undefined ? layui.layer : top.layer,
            $ = layui.jquery, table = layui.table;

        //用户列表
        var tableIns = table.render({
            elem: '#usersList',
            url : "<?php echo url('/admin/userList'); ?>",
            cellMinWidth : 95,
            page : true,
            limit:10,
            limits:[5,10,15,20],
            height : "full-125",
            id:'usersListTable',
            cols : [[
                {field: 'uid', title: 'uid', width:60, align:"center"},
                {field: 'user', title: '账号', width:350},
                {field: 'name', title: '昵称', align:'center'},
                {field: 'title', title: '所属组',  align:'center'},
                {field: 'login_count', title: '登陆次数登陆次数', align:'center'},
                {field: 'last_login_ip', title: '最后登录IP', align:'center'},
                {field: 'last_login_time', title: '最后登陆时间', align:'center'},
                {title: '操作', width:170, templet:'#usersListBar',fixed:"right",align:"center"}
            ]]
        });

        //搜索【此功能需要后台配合，所以暂时没有动态效果演示】
        $(".search_btn").on("click",function(){
            table.reload("usersListTable",{
                page: {
                    curr: 1 //重新从第 1 页开始
                },
                where: {
                    key: $(".searchVal").val()  //搜索的关键字
                }
            })
        });

        //添加用户
        function add(){
            var index = layui.layer.open({
                title : "添加用户",
                type : 2,
                content : "<?php echo url('/admin/edit'); ?>",
                success : function(layero, index){
                    var body = layui.layer.getChildFrame('body', index);
                    setTimeout(function(){
                        layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                            tips: 3
                        });
                    },500)
                }
            })
            layui.layer.full(index);
            window.sessionStorage.setItem("index",index);
            //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
            $(window).on("resize",function(){
                layui.layer.full(window.sessionStorage.getItem("index"));
            })
        }
        //编辑用户
        function edit(uid){
            var index = layui.layer.open({
                title : "编辑用户",
                type : 2,
                content : "<?php echo url('/admin/edit'); ?>"+'?uid='+uid,
                success : function(layero, index){
                    var body = layui.layer.getChildFrame('body', index);
                    setTimeout(function(){
                        layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                            tips: 3
                        });
                    },500)
                }
            })
            layui.layer.full(index);
            window.sessionStorage.setItem("index",index);
            //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
            $(window).on("resize",function(){
                layui.layer.full(window.sessionStorage.getItem("index"));
            })
        }

        $(".adduser_btn").click(function(){
            add();
        })

        //列表操作
        table.on('tool(usersList)', function(obj){
            var layEvent = obj.event, data = obj.data;
            if(layEvent === 'edit'){ //编辑
                edit(data.uid);
            } else if(layEvent === 'del'){ //删除
                layer.confirm('确定删除操作？',{icon:3, title:'提示信息'},function(index){
                    $.post("<?php echo url('/admin/delete'); ?>",{uid:data.uid},function(data){
                        var icon=5;
                        if(data.code){
                            icon=6;
                        }
                        layer.msg(data.msg, {icon:icon,time: 1500}, function () {
                            if(data.code){
                                obj.del();
                            }
                        });
                    })
                });
            }
        });

    })
</script>

</body>
</html>