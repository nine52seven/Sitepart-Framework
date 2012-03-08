<?php
/**
 *    writed by Chaing
 */

class ContactController extends SiteControllerAbstract
{
    //是否需要登录验证
    public $_verification = false;

    function indexAction()
    {
        $this->_forward('index', 'about');
        
        //$this->smarty->display( 'contact.html' );
    }
}

