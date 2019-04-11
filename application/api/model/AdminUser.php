<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  and yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 2018/10/29 Time: 23:14
// +----------------------------------------------------------------------
namespace app\api\model;
use think\Db;
use think\Model;


class AdminUser extends Model{

    public function getDanmu($userName,$pageNum,$page){

        // 获取用户信息ID
        $userArr = $this->getUserId($userName);

        // 判断是否为数字
        if (empty($userArr) ){
            ajaxRes(-1,'当前用户不存在!');
        }

        // 获取对应的用户ID
        $userId = $userArr[0]['id'];
        $userName = $userArr[0]['username'];

        //
        //获取当前用户弹幕数量
        $total = $this->getDanmuTotal($userId);
        $danmuObj['total'] = $total[0]['count(id)'];
        $danmuObj['username'] = $userName;
        // 获取指定用户的弹幕数据

        $page = ( $page -1 ) * $pageNum;
        $danmuObj['data'] = $this->getDanmuList($userId,$pageNum,$page);

        return $danmuObj;
    }

    private function getUserId($userName){
        return Db::query('SELECT id,username FROM hy_user where username=:username limit 1',['username'=>$userName]);
    }

    private function getDanmuList($userId,$pageNum,$page){
        return Db::query('SELECT *,from_unixtime(msg_time) AS send_time FROM hy_danmu where userid=:userid ORDER BY msg_time DESC limit '.$page.','.$pageNum,['userid'=>$userId]);
    }

    private function getDanmuTotal($userId){
        return Db::query('SELECT count(id) FROM hy_danmu where userid=:userid',['userid'=>$userId]);
    }



}