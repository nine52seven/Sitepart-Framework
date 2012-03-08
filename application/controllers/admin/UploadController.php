<?php
/**
 *    writed by Chaing
 */

class Admin_UploadController extends AdminControllerAbstract
{
    //是否需要登录验证
    public $_verification = true;

    public function indexAction()
    {
        $this->smarty->display( 'admin/upload1.html' );
    }
    
    /**
     * 上传
     */
    public function successAction()
    {
        
        $this->smarty->display( 'admin/upload2.html' );
    }
}

