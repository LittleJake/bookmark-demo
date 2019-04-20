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
            return $this->redirect('listBookmark');


        if(IS_POST){
            $password = I('post.password', '');
            $email = I('post.email', '');
            if(!empty($password) && !empty($email)) {
                $user = D('user');

                $query = $user->getByEmail($email);

                if (empty($query))
                    return $this->error('错误邮箱');

                if ($query['pass'] == $this->secret($password)) {
                    session('user_id', $query['id']);
                    return $this->success("$query[username]，欢迎回来", 'index');
                } else
                    return $this->error('错误密码');
            }
            else
                return $this->error('错误');

        }


        $this->assign('page_title', '登录');
        return $this->display();
    }

    //注册
    public function regAction()
    {
        if($this->isLogin())
            return $this->redirect('listBookmark');

        if(IS_POST){
            $username = I('post.username', '');
            $password = I('post.password', '');
            $repassword = I('post.repassword', '');
            $email = I('post.email', '');

            if(!empty($password) && !empty($username) && !empty($repassword) && !empty($email)) {
                $rule = array(
                    array('email', 'email', '错误的邮箱', 1, 'unique', 1),
                    array('repass', 'pass', '两次密码不一致', 1, 'confirm', 1),
                    array('username', 'require', '账号已存在', 1, 'unique', 1)
                );


                $user = D('user');
                $data['pass'] = $this->secret($password);
                $data['repass'] = $this->secret($repassword);
                $data['username'] = $username;
                $data['email'] = $email;

                if ($user->validate($rule)->create($data, 1)) {
                    $user->data($data)->add();
                    return $this->success('注册成功', 'user/login');
                } else
                    return $this->error($user->getError());
            }
            else
                return $this->error('错误');
        }

        $this->assign('page_title', '注册');
        return $this->display();
    }

    //忘记密码
    public function forgotAction()
    {
        if($this->isLogin())
            return $this->redirect('listBookmark');

        if(IS_POST){
            $username = I('post.username', '');
            $email = I('post.email', '');



            if(!empty($username) && !empty($email)){
                $user = D('user');
                $con['username'] = $username;
                $con['email'] = $email;
                $query = $user->where($con)->find();

                if(!empty($query))
                {
                    $query['pass'] = $this->secret($this->r(10));
                    $user -> where($con)->save($query);
                    //邮件处
                }

                return $this->success('如果信息正确，您会收到一封包含临时密码的邮件', 'user/login');
            }
            else
                return $this->error('错误');
        }

        $this->assign('page_title', '忘记密码');
        return $this->display();
    }

    //添加书签
    public function bookmarkAction()
    {
        if(!$this->isLogin())
            return $this->redirect('user/login');

        $a = I('type', '');
        $id = I('id', '');


        if($a == 'add'){
            $data['url'] = urldecode(I('url', ''));

            $this->assign('data', $data);
            $this->assign('type', 'add');
            $this->assign('page_title', '增加书签');
        } else if($a == 'change') {
            if(empty($id))
                return $this->redirect('listBookmark');

            $bookmark = D('bookmark');
            $con['id'] = $id;
            $con['user_id'] = session('user_id');

            $data = $bookmark->where($con)->find();

            if(empty($data))
                return $this->redirect('listBookmark');

            $data['url'] = urldecode($data['url']);

            $this->assign('data', $data);
            $this->assign('type', 'change');
            $this->assign('page_title', '书签修改');

        } else {
            return $this->redirect('user/listBookmark');
        }





        return $this->display();
    }

    //书签列表
    public function listBookmarkAction()
    {
        if(!$this->isLogin())
            return $this->redirect('user/login');

        $bookmark = D('bookmark');
        $con['user_id'] = session('user_id');
        $data = $bookmark -> where($con)->select();

        $this ->assign('bookmarks', $data);
        $this->assign('page_title', '书签列表');
        return $this->display();

    }

    public function indexAction(){
        return $this->redirect('listBookmark');
    }

    public function bookmarkHandlerAction(){
        if(!$this->isLogin())
            return $this->redirect('user/login');

        if(IS_POST){
            $type = I('post.type', '');
            if(empty($type))
                return $this->redirect('listBookmark');

            $title = I('post.title', '');
            $url = I('post.url', '');
            $id = I('post.id', '');
            $user_id = session('user_id');
            $rule = array(
                array('url', 'url', '错误的URL', 1),
                array('title', '1,50', '标题错误', 1, 'length')
            );

            $data['title'] = $title;
            $data['url'] = $url;
            $data['user_id'] = $user_id;

            $con['user_id'] = $user_id;
            $con['id'] = $id;

            $bookmark = D('bookmark');

            if (!$bookmark->validate($rule)->create($data))
                return $this->error($bookmark->getError());

            if($type == 'add'){
                $data['url'] = urlencode($data['url']);
                $bookmark->add($data);
            }
            else if($type == 'change') {
                $data['url'] = urlencode($data['url']);
                $bookmark->where($con)->save($data);
            }

            return $this->success('成功', 'listBookmark');

        }

    }

    public function logoutAction(){
        session('user_id', null);
        return $this->success('退出', 'index/index');
    }

    public function delBookmarkAction(){
        if(!$this->isLogin())
            return $this->redirect('user/login');

        $con['user_id'] = session('user_id');
        $con['id'] = I('id', '');

        $bookmark = D('bookmark');
        if($bookmark -> where($con) ->delete())
            return $this->success('成功');

        return $this->error('错误');
    }
}

