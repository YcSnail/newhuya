<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  and yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 2018/11/13 Time: 16:06
// +----------------------------------------------------------------------

/**
 * 礼物信息
 */

namespace app\api\controller;


use think\Collection;

class Gift extends Collection {


    public function get(){


        $dataArr  = input('post.');

        if (!$dataArr){
            ajaxRes(-1,'data is empty!');
        }


        if (!isset($dataArr['type'])){
            ajaxRes(-1,'非法请求!');
        }



    }



}