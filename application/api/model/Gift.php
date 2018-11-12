<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  and yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 2018/11/11 Time: 19:30
// +----------------------------------------------------------------------


namespace app\api\model;
use think\Model;


class Gift  extends Model{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'hy_gift';

    public function addGift($DataArr){

        $res = Gift::saveAll($DataArr);
        return $res;
    }


    public function getGift($id){

        $res = Gift::where('gift_id', $id)
            ->find();
        return $res;
    }

}