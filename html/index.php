<?php
/**
 * Index 2011.03.27
 * 
 */
$indexPath = dirname(__FILE__);
$rootPath = substr($indexPath, 0, strrpos($indexPath, DIRECTORY_SEPARATOR ));
define('ROOT_PATH', $rootPath);
define('__ZEND_PATH__', '/www/public/libs/ZendFramework-1.10.6/library');
define('__SMARTY_PATH__', '/www/public/libs/Smarty-2.6.18');

// Define include path
ini_set('include_path', str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, 
    ini_get('include_path')             . PATH_SEPARATOR .
    __ZEND_PATH__ . PATH_SEPARATOR .
    ROOT_PATH . '/application/models'   . PATH_SEPARATOR .
    ROOT_PATH . '/lib'              . PATH_SEPARATOR 
//    '.'
));

error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 'On');
date_default_timezone_set('UTC');

//自动加载类
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);

//对象注册表
$registry = Zend_Registry::getInstance();

//配置文件
$config = new Zend_Config_Ini( ROOT_PATH . '/config/config.ini');
$registry -> set('config',$config);

//smarty
require_once __SMARTY_PATH__ . "/Smarty.class.php";
$smarty = new Smarty;
$smarty->template_dir = ROOT_PATH . "/application/views/templates";      // 模板目录
$smarty->compile_dir  = ROOT_PATH . "/application/views/templates_c";   // 编译后的文件目录

//注册smarty
$registry->set('smarty',$smarty);

$front = Zend_Controller_Front::getInstance();
//关闭输出错误,为了使用ErrorController
$front -> throwExceptions(false);
//$front->throwExceptions(true);

//禁用zf自带的view视图
$front->setParam('noViewRenderer', TRUE);
$arrayControllerDirectory = array(
                                'default' => ROOT_PATH . '/application/controllers/',
                                'admin' => ROOT_PATH . '/application/controllers/admin/',
                                'demo' => ROOT_PATH . '/application/controllers/demo/',
                                );
$front->setControllerDirectory( $arrayControllerDirectory );


//路由设定
/*
$router = $front->getRouter();
$router_config = new Zend_Config_Ini( ROOT_PATH . '/config/router.ini', 'production');
//$router = new Zend_Controller_Router_Rewrite();
$router->addConfig($router_config, 'routes');
//var_dump($router);
*/

//未知controller处理
$plugin = new Zend_Controller_Plugin_ErrorHandler();
$front->registerPlugin($plugin);

//session
$options = array("strict" => true);
Zend_Session::setOptions($options);
Zend_Session::start();

//数据库
$db = Zend_Db::factory($config->database);
Zend_Db_Table::setDefaultAdapter($db);
//$db->query('SET NAMES UTF8');
$registry -> set('db',$db);

//log
/*
$logConfig = $config->log->toArray();
$writer = new Zend_Log_Writer_Stream($logConfig['file']);
$logger = new Zend_Log($writer);
$registry->set('logger',$logger);
*/

try{
    $front->dispatch();
} catch (Exception $e){
    //var_dump($e);
    echo $e->getMessage();
}
