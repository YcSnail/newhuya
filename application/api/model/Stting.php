<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  and yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 2018/11/18 Time: 2:04
// +----------------------------------------------------------------------


namespace app\api\model;
use think\Model;

class Stting extends Model {

    protected $table = 'hy_stting';
    protected $createTime = 'start_time';


    public function getStting(){

        $res = Stting::where('id=1')
            ->field('start_time')
            ->find()
            ->toArray();
        return $res;
    }


}