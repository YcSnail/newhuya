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

class User extends Model{


    /**
     * 获取用户id
     * @param $userName 查询用户名
     * @return string 返回用户ID
     */
    public function getUserId($userName){

        $getUserRes = User::where('username', $userName)
            ->field('id')->find();

        if (!$getUserRes){
            $getUserRes['id'] = $this->addUser($userName);
        }

        return $getUserRes['id'];
    }


    /**
     * 新增用户
     * @param $userName 新增用户名
     * @return string 返回用户ID
     */
    private function addUser($userName){

        // 新增一条数据
        $insertUser  = [
            'username'=>$userName,
            'sign'=>0,
            'create_time'=>time()
        ];
        $insertRes = User::create($insertUser);

        if (!$insertRes){
            ajaxRes(-1,'新增用户失败!');
        }
        $getUserId = User::getLastInsID();
        return $getUserId;
    }



}