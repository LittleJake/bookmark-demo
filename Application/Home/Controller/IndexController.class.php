<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model\UserModel;
class IndexController extends Controller
{

    //推荐书签
    public function indexAction()
    {
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

        //return $this->display();
    }

}