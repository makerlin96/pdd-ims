<?php /*a:2:{s:62:"F:\phpstudy_pro\WWW\pdd\application\admin\view\index\home.html";i:1566810672;s:61:"F:\phpstudy_pro\WWW\pdd\application\admin\view\base\base.html";i:1565751064;}*/ ?>
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


<div class="layui-row layui-col-space10 panel_box">
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a  href="javascript:void(0);">
            <div class="panel_icon layui-bg-green">
                <i class="layui-icon  layui-icon-rmb"></i>
            </div>
            <div class="panel_word">
                <span>PDD</span>
                <cite></cite>
            </div>
        </a>
    </div>
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:void(0);" data-url="" >
            <div class="panel_icon layui-bg-black">
                <i class="layui-icon  layui-icon-link"></i>
            </div>
            <div class="panel_word">
                <span>Github</span>
                <cite></cite>
            </div>
        </a>
    </div>
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:void(0);" >
            <div class="panel_icon layui-bg-red">
                <i class="layui-icon  layui-icon-download-circle"></i>
            </div>
            <div class="panel_word">
                <span>码云</span>
                <cite></cite>
            </div>
        </a>
    </div>
</div>
<blockquote class="layui-elem-quote main_btn">

</blockquote>
<div class="layui-row layui-col-space10">
    <div class="layui-col-lg6 layui-col-md12">
        <blockquote class="layui-elem-quote title">系统基本参数</blockquote>
        <table class="layui-table magt0">
            <colgroup>
                <col width="150">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <td>当前版本</td>
                <td class="version"><?php echo htmlentities($site_config['value']['version']); ?></td>
            </tr>
            <tr>
                <td>开发作者</td>
                <td class="author">Lewis</td>
            </tr>
            <tr>
                <td>服务器环境</td>
                <td class="server"><?php echo htmlentities(PHP_OS); ?></td>
            </tr>
            <tr>
                <td>运行环境</td>
                <td class=""><?php echo htmlentities(app('request')->server('SERVER_SOFTWARE')); ?></td>
            </tr>
            <tr>
                <td>框架版本号</td>
                <td class="server"><?php echo htmlentities(app()->version()); ?></td>
            </tr>
            <tr>
                <td>数据库版本</td>
                <td class="dataBase"><?php echo db()->query('select version() as version')[0]['version']; ?></td>
            </tr>
            <tr>
                <td>最大上传限制</td>
                <td class="maxUpload"><?php echo ini_get('upload_max_filesize'); ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="/js/extend.js"></script>

<script type="text/javascript" src="/layui/layui.js"></script>

</body>
</html>