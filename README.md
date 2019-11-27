## 系统要求
 + php5.6+
 + ThinkPHP5.1.6+
 + 配置虚拟目录
 + URL重写（隐藏入口文件index.php）

## 安装步骤：

 + 第一步：
    + Composer方式：
     ~~~
        Composer install 或 Composer update
     ~~~
     
    + 手动下载ThinkPHP核心包，命名为thinkphp，放入根目录，推荐下载[releases包](https://github.com/top-think/framework/releases)
 + 第二步：执行SQL文件（根目录sql.sql文件）
 
 ## 验证码：
 + 环境要求：
    + 1.php_gd扩展 
    + 2.安装think-captcha扩展包
 
  ~~~
     composer require topthink/think-captcha=2.*
  ~~~
 
 + 配置验证码开启状态：应用配置目录captcha.php文件
 
 ~~~
    'is_open' => true
 ~~~
## 导出Excel：
 + 环境要求：zip扩展
 + 使用方法：
  ~~~
  $header = ['字段1'=>'integer','字段2'=>'string','字段3'=>'price'];
  return download_excel($data, $header , 'demo.xlsx');
  ~~~
  
 
## 默认账号密码
 + 默认账号：admin
 + 密码：123456

## 核心内容
 + 采用ThinkPHP5.1框架
 + 前端采用layui构建(layuicms构建，商用请联系layuicms作者，后端代码免费开源)
 + 用户管理
 + 配置管理
 + 菜单管理
 + 缓存管理
 + 权限管理
 + API接口校验
 
## 感谢
 + ThinkPHP
 + layui
 + layuicms

