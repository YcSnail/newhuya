<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  and yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 2018/10/29 Time: 23:14
// +----------------------------------------------------------------------
namespace app\api\model;
use think\Model;

class AdminUser extends Model{

    public function getUser($userName){

        $danmuList = User::where('username',$userName)
            ->where('d.status',0)
            ->alias('u')
            ->join('danmu d','u.id = d.userid')
            ->field('u.username,d.content,d.create_time')
            ->order('create_time desc')
            ->select();

        return $danmuList;
    }


}