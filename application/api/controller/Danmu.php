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

        //
        $json  = input('post.');
        if (!$json){
            ajaxRes(-1,'data is empty!');
        }

        $dataArr = json_decode($json,true);

        $setArr = [];

        //1.移除重复弹幕
        $dataArr = $this->a_array_unique($dataArr);
        $UserModel = model('User');
        file_put_contents('c.log',count($dataArr));

        for ($i=0;$i<count($dataArr);$i++){

            file_put_contents('d.log',$dataArr[$i]['content']);

            $content = $this->checkDanmu($dataArr[$i]['content']);
            file_put_contents('e.log',$content);

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
            file_put_contents('e.log',$danmuRes);

            if ($danmuRes){
                file_put_contents('ok.log',$danmuRes);
                ajaxRes(0,'ok');
            }

        }
        file_put_contents('G.log','');

        ajaxRes(-1,'insert Error');
    }


    private function checkDanmu($content){

        $checkArr = ['分享了直播间','hahaha','哈哈哈','2333','6666','牛逼','收','高能预警','前方高能反应','????','....','。。。。'];
//        $checkArr = ['牛逼'];

        $resCount = $content;
        file_put_contents('d.log','d');

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

}