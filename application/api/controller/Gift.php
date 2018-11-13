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

        $type = $dataArr['type'];

        $typeArr = ['today','week','total'];

        if (!in_array($type,$typeArr)){
            ajaxRes(-1,'非法请求!');
        }

        // 获取数据
        $GiftModel = model('Gift');

        $funName = 'Gift'.$type;

        $giftRes = $GiftModel->$funName();

        if ($giftRes){
            ajaxRes(0,$giftRes);
        }

        ajaxRes(-1,'数据不存在!');
    }


    public function getall(){

        $dataArr  = input('post.');

        if (!$dataArr){
            ajaxRes(-1,'data is empty!');
        }

        if (!isset($dataArr['type'])){
            ajaxRes(-1,'非法请求!');
        }

        $type = $dataArr['type'];

        if ($type != 'all'){
            ajaxRes(-1,'非法请求!');
        }

        // 获取数据
        $GiftModel = model('Gift');
        $giftData = [];

        $giftData['today'] =  $GiftModel->GiftToday();
        $giftData['week'] =  $GiftModel->GiftWeek();
        $giftData['total'] =  $GiftModel->GiftTotal();

        if ($giftData){
            ajaxRes(0,$giftData);
        }

        ajaxRes(-1,'数据不存在!');
    }


}