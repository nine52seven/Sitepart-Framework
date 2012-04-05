Sitepart Framework
==================

简介
----
此框架是基于 **Zend Framewok** 来改写的,其中包含了:

  * [Zend Framework](http://framework.zend.com/)
  * [jQuery](http://jquery.org)
  * [bootstrap](http://twitter.github.com/bootstrap/)
  * [Smarty](http://smarty.net)

安装
----

此框架不自带zf库和smarty,需要在 `html/index.php` 文件中修改两个库文件的路径

    define('__ZEND_PATH__', '/www/public/libs/ZendFramework-1.10.6/library');   //修改成你自己的路径
    define('__SMARTY_PATH__', '/www/public/libs/Smarty-2.6.18');    //同上

`jQuery` 使用的是[Google Libraries API](http://code.google.com/intl/zh-CN/apis/libraries/)(貌似被和谐了)

在 `config/config.ini` 文件中,需要定义以下几个常量:

    [site]
    siteName    = Sitepart  ;站点名称
    siteUrl     = http://site-domain    ;站点域名
    siteDev     = threepoints   ;开发者

    [admin]
    username    = admin ;后台管理员信息
    password    = admin
    name        = 管理员

    [database]
    ;数据库连接,命名必须按照以下格式,以便在创建db对象时直接使用
    adapter       = PDO_MYSQL
    params.host     = localhost
    params.username = root
    params.password = root
    params.dbname   = dbname
    params.driver_options.1002  = "SET NAMES utf8"


需要开启web服务器的`rewrite`功能,下面是apache下的 `.htaccess` 文件,放在html目录下(已经自带)

    RewriteEngine on
    RewriteCond %{REQUEST_FILENAME} -s [OR]
    RewriteCond %{REQUEST_FILENAME} -l [OR]
    RewriteCond %{REQUEST_FILENAME} -d
    RewriteRule ^.*$ - [NC,L]
    RewriteRule ^.*$ index.php [NC,L]

还需要把 `application/views/template_c` 目录设置成可写

最后,把域名目录指到 `html` 目录下就ok了


目录结构说明
----------

<pre>
sitepart.net
|
|___application
|   |____controllers   //action文件
|   |____models        //数据模型
|   |____views         //smarty模板
|
|___config             //配置文件
|___doc                //文档
|___html               //静态文件
|   |____bootstrap     //boorstrap库
|   |____images        //图片
|   |____scripts       //js
|   |____styles        //css
|   |____index.php     //入口文件
|
|___lib //自定义库文件

</pre>


祝顺利!
-------
END
