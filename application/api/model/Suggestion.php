<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  and yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 2018/11/4 Time: 18:41
// +----------------------------------------------------------------------


namespace app\api\model;
use think\Model;


class Suggestion extends Model{

    public function add($content){

        $saveData =
            [
                'content'  =>  $content,
                'create_time' =>  time(),
                'status'=>0
            ];
        $insertRes = Suggestion::create($saveData);

        if (!$insertRes){
            ajaxRes(-1,'新增用户失败!');
        }

        return $insertRes;
    }


}