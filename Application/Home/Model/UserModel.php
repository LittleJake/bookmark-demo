<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jake
 * Date: 3/24/2019
 * Time: 10:16 PM
 *
 * Stay simple, stay naive.
 *
 */

namespace Home\Model;


use Think\Model;

class UserModel extends Model
{
    protected $field = array('id', 'email', 'pass', 'username');
    protected $pk = 'id';

}