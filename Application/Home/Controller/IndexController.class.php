<?php
namespace Home\Controller;

class IndexController extends BaseController
{

    //推荐书签
    public function indexAction()
    {
        $this ->isLogin();

        $bookmarks = array(array(
            'id' => '1',
            'title' => 'asd',
            'url' => 'http://url.com/'
        ));
        $this->assign('bookmarks', $bookmarks);
        $this->assign('page_title','首页');
        return $this->display();
    }

    //about
    public function aboutAction(){


        $this->assign( 'page_title', '关于');
        return $this->display();
    }

}