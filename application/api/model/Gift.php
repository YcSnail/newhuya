<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  and yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 2018/11/11 Time: 19:30
// +----------------------------------------------------------------------


namespace app\api\model;
use think\Db;
use think\Model;


class Gift  extends Model{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'hy_gift';

    protected $createTime = 'gift_time';

    public function addGift($DataArr){

        $res = Gift::saveAll($DataArr);
        return $res;
    }


    public function getGift($id){

        return Db::query('SELECT id FROM hy_gift where gift_id=:gift_id limit 1',['gift_id'=>$id]);
    }

    public function GiftReal(){

        $res = Gift::whereTime('gift_time', 'd')
            ->alias('g')
            ->join('user u','g.userid = u.id')
            ->field('u.username,g.name,g.total,g.count,g.price,g.count,g.gift_time')
            ->order('g.gift_time desc')
            ->select()
            ->toArray();
        return $res;
    }

    public function GiftToday(){
        $res = Gift::whereTime('gift_time', 'd')
            ->alias('g')
            ->join('user u','g.userid = u.id')
            ->field('u.username,u.yy_id,g.name,g.price,g.total,g.gift_time,sum(g.total) * 1000 as totals')
            ->order('totals desc')
            ->group('u.id')
            ->select()
            ->toArray();
        return $res;
    }


    public function GiftWeek(){
        $res = Gift::whereTime('gift_time', 'w')
            ->alias('g')
            ->join('user u','g.userid = u.id')
            ->field('u.username,u.yy_id,g.name,g.price,g.total,g.gift_time,sum(g.total) * 1000 as totals')
            ->order('totals desc')
            ->group('u.id')
            ->select()
            ->toArray();
        return $res;
    }

    public function GiftTotal(){
        $res = Gift::alias('g')
            ->join('user u','g.userid = u.id')
            ->field('u.username,u.yy_id,g.name,g.price,g.total,g.gift_time,sum(g.total) * 1000 as totals')
            ->order('totals desc')
            ->group('u.id')
            ->select()
            ->toArray();
        return $res;
    }



    public function getGiftCountDay(){

        $res = Gift::whereTime('gift_time', 'd')
            ->count();
        return $res;
    }


    public function getGiftCountWeek(){

        $res = Gift::whereTime('gift_time', 'w')
            ->count();
        return $res;
    }


    public function getGiftCountTotal(){

        $res = Gift::count();
        return $res;
    }



}