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
        $dataArr = $this->a_array_unique($danmuArr);
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


        $checkArr = ['分享了直播间','hahaha','哈哈哈','2333','6666','牛逼','收','高能预警','前方高能反应','????','....','。。。。'];

        $resCount = $content;

        for ($i=0;$i<count($checkArr);$i++){

            if (strstr($content,$checkArr[$i]) !== false){
                $resCount = false;
                break;
            }

        }

        return $resCount;
    }

    //二维数组去掉重复值
    private function a_array_unique($array){
        $out = array();

        foreach ($array as $key=>$value) {
            if (!in_array($value, $out)){
                $out[$key] = $value;
            }
        }

        $out = array_values($out);
        return $out;
    }



    /**
     * 判断字符串是否为 Json 格式
     *
     * @param  string     $data  Json 字符串
     * @param  bool       $assoc 是否返回关联数组。默认返回对象
     *
     * @return bool|array 成功返回转换后的对象或数组，失败返回 false
     */
    private function isJson($data = '', $assoc = false) {
        $data = json_decode($data, $assoc);
        if ($data && (is_object($data)) || (is_array($data) && !empty(current($data)))) {
            return $data;
        }
        return false;
    }

}