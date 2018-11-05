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

        $page = $dataArr['page'];
        $pageNum = $dataArr['pageNum'];

        if ($dataArr['type'] =='user'){

            $danmuRes = $UserModel->getUser($dataArr['search'],$pageNum,$page);

        }

        if ($danmuRes){
            ajaxRes(0,$danmuRes);
        }

        ajaxRes(-1,'暂未记录当前用户弹幕!');

    }

}