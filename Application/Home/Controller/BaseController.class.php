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
        return session('?user_id');
    }

}