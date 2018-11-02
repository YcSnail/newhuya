<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  and yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 2018/10/29 Time: 23:08
// +----------------------------------------------------------------------
namespace app\api\controller;
use think\Controller;


class Danmu extends Controller {

    public function add(){

        $dataArr  = input('post.');

        if (!$dataArr){
            ajaxRes(-1,'data is empty!');
        }

        if (!isset($dataArr['danmu'])){
            ajaxRes(-1,'danmu is empty!');
        }

        $danmuArr = $dataArr['danmu'];

        $setArr = [];

        //1.移除重复弹幕
        $dataArr = $this->more_array_unique($danmuArr);
        $UserModel = model('User');

        for ($i=0;$i<count($dataArr);$i++){

            $content = $this->checkDanmu($dataArr[$i]['content']);

            if ($content == false){
                continue;
            }

            $tmpArr = [];
            // 弹幕过滤检测
            $tmpArr['content'] = $content;
            $tmpArr['userid'] = $UserModel->getUserId($dataArr[$i]['username']);
            $tmpArr['create_time'] = $dataArr[$i]['createtime'];
            $setArr[] = $tmpArr;
        }

        if ($setArr){

            $danmuModel = model('Danmu');
            $danmuRes = $danmuModel->addDanmu($setArr);
            if ($danmuRes){
                ajaxRes(0,'ok');
            }

        }

        ajaxRes(-1,'insert Error');
    }


    /**
     * 检查过滤弹幕
     * @param $content
     * @return bool
     */
    private function checkDanmu($content){

        if (strlen($content) <=3){
            return false;
        }


        $checkArr = ['分享了直播间','hahaha','哈哈哈','2333','6666','牛逼','收','高能预警','前方高能反应','????','....','。。。。','支付宝','QQ','qq'];

        $resCount = $content;

        for ($i=0;$i<count($checkArr);$i++){

            if (strstr($content,$checkArr[$i]) !== false){
                $resCount = false;
                break;
            }

        }

        return $resCount;
    }

    // 二维数组去重

    /**
     * @param array $arr
     */

    private function more_array_unique($arr=array()){

        $danmuArrRes = [];
        if (!is_array($arr)){
            ajaxRes(-1,'danmu is not array');
        }
         // 循环获取所有数据
         foreach ($arr as $itemArr) {
             $tmpArr = [];

             $tmpArr['username'] = $itemArr['username'];
             $tmpArr['content'] = $itemArr['content'];
             $tmpArr['createtime'] = $itemArr['createtime'];

             $checkDanmu = $this->schechDanmu($tmpArr['username'],$danmuArrRes,'username');

             // 判断是否内容重复
             // 循环获取  用户和内容  保存在新数组

             if ($checkDanmu === false){
                 $danmuArrRes[] = $tmpArr;

             }else
                 if ($danmuArrRes[$checkDanmu]['content'] != $tmpArr['content']){

                 // 含有重复值
                 //再次检查 判断是否用户重复
                 $danmuArrRes[] = $tmpArr;
             }

         }
         return $danmuArrRes;
    }

    private function schechDanmu($content,$danmuArr,$type = 'username'){

        if (!$danmuArr){
            return false;
        }

        $checkRes = array_search($content, array_column($danmuArr, $type));
        return $checkRes;
    }


}