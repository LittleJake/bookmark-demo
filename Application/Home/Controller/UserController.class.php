<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jake
 * Date: 3/24/2019
 * Time: 10:06 PM
 *
 * Stay simple, stay naive.
 *
 */
namespace Home\Controller;

class UserController extends BaseController
{
    //登录
    public function loginAction()
    {
        /*
        $rule = array(
            array('email', 'email', '错误的邮箱', 1, 'unique', 1),
            array('repass', 'pass', '两次密码不一致', 1, 'confirm', 1),
            array('username', 'require', '账号已存在', 1, 'unique', 1)
        );

        $user = D('User');


        $data['email'] = '5451212';
        $data['username'] = '123123';
        $data['pass'] = md5('123123');
        $data['repass'] = md5('121233123');
        if($user->validate($rule)->create($data, 1))
        {
            $user->data($data)->add();
            echo '123';
        }
        else
            exit($user->getError());
        */

        if($this->isLogin())
            return $this->redirect('user/listBookmark');


        if(IS_POST){
            $username = I('post.username', '');
            $password = I('post.password', '');
            $repassword = I('post.repassword', '');
            $email = I('post.email', '');


            $rule = array(
                array('email', 'email', '错误的邮箱', 1, 'unique', 1),
                array('repass', 'pass', '两次密码不一致', 1, 'confirm', 1),
                array('username', 'require', '账号已存在', 1, 'unique', 1)
            );


            $user = D('user');
            $data['pass'] = $password;
            $data['repass'] = $repassword;
            $data['username'] = $username;
            $data['email'] = $email;

            //if($user->validate($rule)->create($data, 1))
            //    $user->data($data)->add();

        }


        $this->assign('page_title', '登录');
        return $this->display();
    }

    //注册
    public function regAction()
    {
        if($this->isLogin())
            return $this->redirect('user/listBookmark');

        if(IS_POST){
            $username = I('post.username', '');
            $password = I('post.password', '');
            $repassword = I('post.repassword', '');
            $email = I('post.email', '');


            $rule = array(
                array('email', 'email', '错误的邮箱', 1, 'unique', 1),
                array('repass', 'pass', '两次密码不一致', 1, 'confirm', 1),
                array('username', 'require', '账号已存在', 1, 'unique', 1)
            );


            $user = D('user');
            $data['pass'] = $password;
            $data['repass'] = $repassword;
            $data['username'] = $username;
            $data['email'] = $email;

            if($user->validate($rule)->create($data, 1))
                $user->data($data)->add();

        }

        $this->assign('page_title', '注册');
        return $this->display();
    }

    //忘记密码
    public function forgotAction()
    {
        if($this->isLogin())
            return $this->redirect('user/listBookmark');

        if(IS_POST){
            $username = I('post.username', '');
            $password = I('post.password', '');
            $repassword = I('post.repassword', '');
            $email = I('post.email', '');


            $rule = array(
                array('email', 'email', '错误的邮箱', 1, 'unique', 1),
                array('repass', 'pass', '两次密码不一致', 1, 'confirm', 1),
                array('username', 'require', '账号已存在', 1, 'unique', 1)
            );


            $user = D('user');
            $data['pass'] = $password;
            $data['repass'] = $repassword;
            $data['username'] = $username;
            $data['email'] = $email;

            //if($user->validate($rule)->create($data, 1))
            //    $user->data($data)->add();

        }

        $this->assign('page_title', '忘记密码');
        return $this->display();
    }

    //添加书签
    public function addBookmarkAction()
    {
        if(!$this->isLogin())
            return $this->redirect('user/login');

        if(IS_POST){}

        $this->assign('page_title', '增加书签');
        return $this->display();

    }

    //修改书签
    public function changeBookmarkAction()
    {
        if(!$this->isLogin())
            return $this->redirect('user/login');

        if(IS_POST){}

        $this->assign('page_title', '书签修改');
        return $this->display();

    }

    //书签列表
    public function listBookmarkAction()
    {
        if(!$this->isLogin())
            return $this->redirect('user/login');

        $this->assign('page_title', '书签列表');
        return $this->display();

    }

    public function bookmarkHandlerAction(){
        if(IS_POST){}

    }
}

