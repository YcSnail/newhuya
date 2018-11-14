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

    public function addGift(){

        $dataArr  = input('post.');

        if (!$dataArr){
            ajaxRes(-1,'data is empty!');
        }

        if (!isset($dataArr['gift'])){
            ajaxRes(-1,'gift is empty!');
        }

        $giftArr = $dataArr['gift'];
        $setArr = array();

        $checkIdArr = [];

        $UserModel = model('User');
        $giftModel = model('Gift');

        // 循环礼物列表
        for ($i=0;$i<count($giftArr);$i++) {

            // 检查ID是否重复
            if (in_array($giftArr[$i]['id'],$checkIdArr)){
                continue;
            }

            $checkId = $this->checkGiftId($giftArr[$i]['id']);

            if ($checkId){
                continue;
            }

            $tmpArr = array();
            // 礼物过滤检测
            $tmpArr['name'] = $giftArr[$i]['giftName'];
            $tmpArr['count'] = $giftArr[$i]['count'];
            $tmpArr['price'] = $giftArr[$i]['price'];
            $tmpArr['total'] = $tmpArr['price'] * $tmpArr['count'];
            $tmpArr['gift_id'] = $giftArr[$i]['id'];

            $tmpArr['userid'] = $UserModel->getUserId($giftArr[$i]['username'],$giftArr[$i]['user_id']);
            $tmpArr['create_time'] = time();
            $tmpArr['gift_time'] = $giftArr[$i]['createtime'];
            $setArr[] = $tmpArr;

            $checkIdArr[] = $giftArr[$i]['id'];

            if ($setArr){

                $giftRes = $giftModel->addgift($setArr);
                if ($giftRes){
                    ajaxRes(0,'ok');
                }

            }

        }


        ajaxRes(-1,'insert Error');
    }


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
            $tmpArr['userid'] = $UserModel->getUserId($dataArr[$i]['username'],$dataArr[$i]['user_id'],$dataArr[$i]['yy_id']);

            $tmpArr['msg_time'] = $dataArr[$i]['createtime'];
            $tmpArr['create_time'] = time();

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

        if (empty($content)){
            return false;
        }

        if (strlen($content) <=3){
            return false;
        }

        $checkArr = ['分享了直播间','hahaha','哈哈哈','2333','6666','牛逼','收','高能预警',
            '前方高能反应','????','....','。。。。','支付宝','QQ','qq','？？？？','3333','¿¿¿¿','/{','激动的心'];

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
             $tmpArr['yy_id'] = $itemArr['yy_id'];
             $tmpArr['user_id'] = $itemArr['user_id'];

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

    /**
     * 检查数据库中 是否存在重复数据
     * @param $id
     * @return bool
     */
    private function checkGiftId($id){
        $giftModel = model('Gift');

        // 检查ID是否存在
        $res = $giftModel->getGift($id);

        if ($res){
            return true;
        }
        return false;
    }


}