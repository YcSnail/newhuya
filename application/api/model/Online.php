<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  and yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 2018/11/18 Time: 20:35
// +----------------------------------------------------------------------


namespace app\api\model;
use think\Model;

class Online  extends Model {

    // 设置当前模型对应的完整数据表名称
    protected $table = 'hy_online';
    protected $createTime = 'online_time';

    public function addOnline($DataArr){
        $res = Online::save($DataArr);
        return $res;
    }


}