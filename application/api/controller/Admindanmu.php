<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  and yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 2018/11/2 Time: 0:18
// +----------------------------------------------------------------------


namespace app\api\controller;
use think\Controller;


class Admindanmu extends Controller {

    public function get(){

        //
        $dataArr  = input('post.');

        // 判断数据是否存在
        if (!isset($dataArr['type']) || !isset($dataArr['search']) || !isset($dataArr['page']) || !is_numeric ($dataArr['page'])){
            ajaxRes(-1,'非法请求!');
        }

        // 查询弹幕
//        $dataArr['type'] = 'user';
//        $dataArr['search'] = 'aa';


        // 判断是 按用户 还是按 弹幕

        // 默认按用户处理
        $UserModel = model('AdminUser');

        $page = intval($dataArr['page']) ;
        $pageNum = intval($dataArr['pageNum']) == 0 ? 20 : intval($dataArr['pageNum']) ;

        if ($dataArr['type'] =='user'){

            $danmuRes = $UserModel->getDanmu($dataArr['search'],$pageNum,$page);

        }

        if ($danmuRes){
            ajaxRes(0,$danmuRes);
        }

        ajaxRes(-1,'暂未记录当前用户弹幕!');

    }

    /**
     * 获取弹幕统计数据和网站基本信息
     */
    public function getcount(){

        //
        $dataArr  = input('post.');

        // 判断数据是否存在
        if (!isset($dataArr['type']) && $dataArr['type'] !='getcount'){
            ajaxRes(-1,'非法请求!');
        }

        $DanmuModel = model('Danmu');
        $GiftModel = model('Gift');

        $SttingModel = model('Stting');

        $res = [];

        $res['dm']['today'] =$DanmuModel->getDanmuCountDay();
        $res['dm']['week'] =$DanmuModel->getDanmuCountWeek();
        $res['dm']['total'] =$DanmuModel->getDanmuCountTotal();

        $res['gift']['today'] =$GiftModel->getGiftCountDay();
        $res['gift']['week'] = $GiftModel->getGiftCountWeek();
        $res['gift']['total'] =$GiftModel->getGiftCountTotal();


        $stting = $SttingModel->getStting();
        $res['start_time'] = $stting['start_time'];

        if ($res){
            ajaxRes(0,$res);
        }
        ajaxRes(-1,'获取数据失败!');
    }



}