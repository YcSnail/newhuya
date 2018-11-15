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
    public function getUserId($userName,$user_id,$yy_id = ''){

        $getUserRes = User::where('user_id', $user_id)
            ->field('id,yy_id,username')->find();

        if (!$getUserRes){
            $getUserRes['id'] = $this->addUser($userName,$user_id,$yy_id);
        }

        // 判断用户名是否已经修改
        if (isset($getUserRes['username']) && $getUserRes['username'] != $userName ) {

            // 更新用户名
            $upRes = $this->updataUserName($getUserRes['id'],$userName);
            if (!$upRes){
                ajaxRes(-1,'更新用户名 失败!');
            }

        }

            // 判断是否存在yyid
        if (isset($getUserRes['yy_id']) && $getUserRes['yy_id'] == 0 && $yy_id){

            // 添加yyid
            $upRes = $this->updataYyId($getUserRes['id'],$yy_id);

            if (!$upRes){
                ajaxRes(-1,'更新yyid 失败!');
            }

        }

        return $getUserRes['id'];
    }


    /**
     * 新增用户
     * @param $userName 新增用户名
     * @return string 返回用户ID
     */
    private function addUser($userName,$user_id,$yy_id =''){

        // 新增一条数据
        $insertUser  = [
            'username'=>$userName,
            'user_id'=>$user_id,
            'yy_id'=>$yy_id,
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

    /**
     * 更新用户yyid
     * @param $userId
     * @param $yyId
     * @return User
     */
    private function updataYyId($userId,$yyId){

        $upYyIdRes = User::where('id', $userId)
            ->update(['yy_id' => $yyId]);
        return $upYyIdRes;
    }


    /**
     * 更新用户名
     * @param $userId
     * @param $username
     * @return User
     */
    private function updataUserName($userId,$username){

        $upRes = User::where('id', $userId)
            ->update(['username' => $username]);
        return $upRes;
    }


}