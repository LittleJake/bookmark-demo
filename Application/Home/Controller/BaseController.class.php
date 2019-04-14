<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jake
 * Date: 3/28/2019
 * Time: 11:47 AM
 *
 * Stay simple, stay naive.
 *
 */

namespace Home\Controller;


use Think\Controller;

class BaseController extends Controller
{


    protected function isLogin(){
        if(session('?user_id')){
            $this->assign('login', 1);
            $user = D('user');
            $query = $user->getById(session('user_id'));
            $this->assign('info', $query);
        }
        else
            $this->assign('login', 0);
        return session('?user_id');
    }

    protected function secret($pass) {
        return md5('salt' . $pass);
    }

    protected function r($n) {
        $str = 'abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLNMOPQRSTUVWXYZ!@#$%^&*()1234567890';

        $s = '';
        for($i = 0; $i < $n; $i++)
            $s .= substr($str,rand(0, strlen($str)-1),1);

        return $s;
    }
}