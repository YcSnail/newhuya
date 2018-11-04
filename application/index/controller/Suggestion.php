<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  and yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 2018/11/4 Time: 0:31
// +----------------------------------------------------------------------


namespace app\index\controller;

use think\Controller;

class Suggestion extends Controller{
    public function index()
    {

        $token = $this->request->token('__token__', 'sha1');
        $this->assign('token', $token);
        return view(__FUNCTION__);
    }

}