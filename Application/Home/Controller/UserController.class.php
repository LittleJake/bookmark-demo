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
        $this->assign('page_title', '登录');
        return $this->display();
    }

    //注册
    public function regAction()
    {
        return $this->display();
    }

    //忘记密码
    public function forgotAction()
    {
        return $this->display();
    }

    //添加书签
    public function addBookmarkAction()
    {
        return $this->display();

    }

    //修改书签
    public function changeBookmarkAction()
    {
        return $this->display();

    }

    //删除书签
    public function delBookmarkAction()
    {
        return $this->display();

    }

    //书签列表
    public function listBookmarkAction()
    {
        return $this->display();

    }
}

