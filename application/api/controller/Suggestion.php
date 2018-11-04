<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  and yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 2018/11/4 Time: 16:59
// +----------------------------------------------------------------------


namespace app\api\controller;
use think\Controller;
use think\Validate;


class Suggestion extends Controller {

    public function add(){
        $dataArr  = input('post.');

        $chekToken = Validate::token('__token__','',['__token__'=>input('__token__')]);

        if (!$chekToken){
            ajaxRes(-1,'非法请求');
        }

        $content = $dataArr['suggestion'];

        $Suggestion = model('Suggestion');

        $saveRes =  $Suggestion->add($content);

        if ($saveRes){
            ajaxRes(0,'已经记录反馈建议!');
        }
        ajaxRes(-1,'保存失败!');

    }

}