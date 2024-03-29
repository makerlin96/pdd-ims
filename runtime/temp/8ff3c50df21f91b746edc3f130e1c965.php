<?php /*a:2:{s:63:"F:\phpstudy_pro\WWW\pdd\application\admin\view\system\menu.html";i:1563781468;s:61:"F:\phpstudy_pro\WWW\pdd\application\admin\view\base\base.html";i:1565751064;}*/ ?>
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
    html, body {
        height: 100%;
    }
</style>
<form class="layui-form">
    <blockquote class="layui-elem-quote quoteBox">
        <form class="layui-form">
            <div class="layui-inline">
                <a class="layui-btn layui-btn-danger layui-btn-normal" onclick="add();">添加节点</a>
                <a class="layui-btn  layui-btn-normal" onclick="openAll();">展开或折叠全部</a>
            </div>
        </form>
    </blockquote>
</form>
<script type="text/html" id="type">
    {{ d.menu == 1 ? '菜单' : '行为' }}
</script>
<script type="text/html" id="status">
    <input type="checkbox" name="menustatus" value="{{d.id}}" lay-skin="switch" lay-text="显示|隐藏" lay-filter="menustatus"
           {{ d.status== 1 ? 'checked' : '' }}>
</script>
<script type="text/html" id="order">
    <input name="{{d.id}}" data-id="{{d.id}}" class="list_order layui-input" value=" {{d.sort}}" size="10"/>
</script>
<script type="text/html" id="icon">
    <span class="icon {{d.icon}}"></span>
</script>
<script type="text/html" id="action">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
</script>
<table class="layui-table" id="treeTable" lay-filter="treeTable"></table>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="/js/extend.js"></script>

<script>
    var ptable = null, treeGrid = null, tableId = 'treeTable', layer = null, $ = null, form = null
    layui.config({
        base: '/layui/extend/'
    }).extend({
        treeGrid: 'treeGrid'
    }).use(['jquery', 'treeGrid', 'layer', 'form'], function () {
        $ = layui.jquery;
        treeGrid = layui.treeGrid;
        layer = layui.layer;
        form = layui.form;
        ptable = treeGrid.render({
            id: tableId,
            elem: '#' + tableId,
            idField: 'id',
            url: "<?php echo url('/admin/menu'); ?>",
            cellMinWidth: 100,
            treeId: 'id',//树形id字段名称
            treeUpId: 'pid',//树形父id字段名称
            treeShowName: 'title',//以树形式显示的字段
            height: 'full-140',
            isFilter: false,
            iconOpen: false,//是否显示图标【默认显示】
            isOpenDefault: false,//节点默认是展开还是折叠【默认展开】
            onDblClickRow: false,//去除双击事件
            cols: [[
                {field: 'id', title: '编号'},
                {field: 'icon', align: 'center', title: '图标', templet: '#icon'},
                {field: 'title', title: '权限名称',},
                {field: 'name', title: '控制器/方法',},
                {field: 'menu', align: 'center', title: '类型', toolbar: '#type'},
                // {field: 'status',align: 'center',title: '状态',toolbar: '#status'},
                {field: 'sort', align: 'center', title: '排序'},
                {width: 160, align: 'center', title: '操作', templet: '#action'}
            ]],
            page: false
        });
        treeGrid.on('tool(' + tableId + ')', function (obj) {
            var data = obj.data;
            if (obj.event === 'del') {
                layer.confirm('确定删除操作？', {icon: 3, title: '提示信息'}, function (index) {
                    $.post("<?php echo url('/admin/deleteMenu'); ?>", {id: data.id}, function (data) {
                        var icon = 5;
                        if (data.code) {
                            icon = 6;
                        }
                        layer.msg(data.msg, {icon: icon}, function () {
                            if (data.code) {
                                obj.del();//删除对应的行
                            }
                        });
                    });
                });
            }
            if (obj.event === 'edit') {
                edit(data.id)
            }
        });
    });

    /**
     * 添加菜单
     */
    function add() {
        var index = layui.layer.open({
            type: 2,
            title: '添加菜单',
            content: "<?php echo url('/admin/editMenu'); ?>",
            success: function (layero, index) {
                var body = layui.layer.getChildFrame('body', index);
                setTimeout(function () {
                    layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                }, 500)
            }
        });
        layui.layer.full(index);
        window.sessionStorage.setItem("index",index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(window.sessionStorage.getItem("index"));
        })
    }

    /**
     * 编辑菜单
     * @param id
     */
    function edit(id) {
        var index = layui.layer.open({
            type: 2,
            title: '编辑菜单',
            content: "<?php echo url('/admin/editMenu'); ?>" + '?id=' + id,
            success: function (layero, index) {
                var body = layui.layer.getChildFrame('body', index);
                setTimeout(function () {
                    layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                }, 500)
            }
        });
        layui.layer.full(index);
        window.sessionStorage.setItem("index", index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize", function () {
            layui.layer.full(window.sessionStorage.getItem("index"));
        })
    }

    function openAll() {
        var treedata = treeGrid.getDataTreeList(tableId);
        treeGrid.treeOpenAll(tableId, !treedata[0][treeGrid.config.cols.isOpen]);
    }
</script>

</body>
</html>