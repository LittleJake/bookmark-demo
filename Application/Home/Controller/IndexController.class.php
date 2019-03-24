<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{

    //推荐书签
    public function indexAction()
    {
        return $this->display();
    }

}