<?php
namespace Home\Controller;

class IndexController extends BaseController
{

    //推荐书签
    public function indexAction()
    {
        $this ->isLogin();

        $bookmark = D('bookmark');

        $bookmarks = $bookmark ->query('select * from (select url,count(url) as c from bookmark group by url) as U where U.c > 2');

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