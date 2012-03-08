<?php
/**
 *    writed by Chaing
 */

class Demo_LoginController extends SiteControllerAbstract
{
    //是否需要登录验证
    public $_verification = false;

    function indexAction()
    {
        if (isset($this->params['redirect']) and !empty($this->params['redirect'])) {
            $redirect = $this->params['redirect'];
        } else {
            $redirect = '/demo/';
        }
        
        if ($this->_request->isPost()) {
            $filterChain    = $this->_getFilterChainInstance();
            $username          = $filterChain->filter($this->params['user_username']);
            $password       = $filterChain->filter($this->params['user_password']);
            if ($username == $this->config->admin->username && $password == $this->config->admin->password) {
                $userInfo = array('username' => $username, 
                                  'password' => $password,
                                  'name'     => $this->config->admin->name
                                );
                $this->session->userInfo = $userInfo;
                $this->smarty->assign('userInfo', $userInfo);
                $this->_redirect($redirect); 
                    
            } else {
                $this->smarty->assign('errMessge', '认证错误,请重新输入');
            }

        }
        $this->smarty->assign('redirect', $redirect);
        $this->smarty->display( 'demo/login.html' );
    }
    
    function logoutAction()
    {
        Zend_Session::destroy();
        $redirect = '/demo/';
        $this->_redirect($redirect);
    }
}

