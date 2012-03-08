<?php
/**
 *    writed by Chaing
 */

class Demo_IndexController extends SiteControllerAbstract
{
    //是否需要登录验证
    public $_verification = false;

    function indexAction()
    {
        $this->smarty->display( 'demo/index.html' );
    }
    
    function homeAction()
    {
        $this->smarty->display( 'demo/index.html' );
    }
}

