<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jake
 * Date: 3/24/2019
 * Time: 10:15 PM
 *
 * Stay simple, stay naive.
 *
 */

namespace Home\Model;


use Think\Model;

class BookmarkModel extends Model
{
    protected $field = array('id', 'title', 'content', 'user_id');
    protected $pk = 'id';
    protected $_validate = array(
        array('title', 'require', '标题错误'),
        array('content', 'url', '错误url')

    );
}