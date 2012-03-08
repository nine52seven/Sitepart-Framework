<?php
/**
 *    writed by Chaing
 */

class Admin_IndexController extends AdminControllerAbstract
{
    //是否需要登录验证
    public $_verification = false;

    function indexAction()
    {

        $this->smarty->display( 'admin/index.html' );
    }
    
    function homeAction()
    {
        $this->smarty->display( 'admin/index.html' );
    }
}

