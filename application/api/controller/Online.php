<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  and yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 2018/11/18 Time: 18:22
// +----------------------------------------------------------------------

/**
 * 在线统计信息
 */

namespace app\api\controller;
use think\Model;

class Online extends Model {


    // 添加在线用户信息
    public function add(){

        $dataArr  = input('post.');

        if (!$dataArr){
            ajaxRes(-1,'data is empty!');
        }

        if (!isset($dataArr['online'])){
            ajaxRes(-1,'get error!');
        }

        $getArr = $dataArr['online'];

        $setArr['online_time'] = $getArr['time'];
        $setArr['count'] = $getArr['count'];
        $setArr['create_time'] = time();

        $onlineModel = model('online');
        $onlineRes = $onlineModel->addOnline($setArr);
        if ($onlineRes){
            ajaxRes(0,'ok');
        }
        ajaxRes(-1,'insert Error');

    }



}