<?php
/**
 * Created by PhpStorm.
 * User: KeenSting
 * Date: 16/1/22
 * Time: 上午10:17
 * Name: 梁勋
 * Phone: 13126734215
 * QQ: 707719848
 * File Description: redis list,list相当于于一个栈后进先出,取值的时候,栈顶的index为0,栈底为length;
 */

date_default_timezone_set('PRC');
class redis_list
{
    protected $redis;

    function __construct()
    {
        $this->redis=new Redis();
        if($this->redis->connect('127.0.0.1',6379)===false)
        {
            echo 'redis connection error!';
            exit;
        }
        echo $this->redis->ping();
    }

    function __destruct()
    {
        $this->redis->close();
    }


    protected function set_list()
    {
        for($i=0;$i<5;$i++)
        {
            $this->redis->lPush('test', 'keensting'.$i);
        }
    }


    protected function get_list()
    {
        //列表指定位置的值,无返回值
        $this->redis->lGet('test',2);
        //列表一个范围内的值,无返回值
        $this->redis->lGetRange('test',1,3);
        //返回列表指定位置的值(index 从0开始)
        print_r($this->redis->lIndex('test',3));
        //返回列表弹出的值;
        print_r($this->redis->lPop('test'));
        //返回列表的长度
        print_r($this->redis->lLen('test'));
        //返回一个范围内的list值
        print_r($this->redis->lRange('test',0,3));
    }

    function run()
    {
        $this->set_list();
        $this->get_list();
    }


}
$demo=new redis_list();
$demo->run();