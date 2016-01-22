<?php
/**
 * Created by PhpStorm.
 * User: KeenSting
 * Date: 16/1/22
 * Time: 下午9:08
 * Name: 梁勋
 * Phone: 13126734215
 * QQ: 707719848
 * File Description: redis 消息订阅 publish|subscribe
 */

class redis_subscribe
{

    private $redis;

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

    //发布
    protected function  publish()
    {
        $this->redis->publish('keensting','my name is liangxun');
        $this->redis->publish('keensting','i am a student from BJUT');
    }

    //订阅
    protected function subscribe()
    {
        $this->redis->subscribe('test',function($data){
            print_r($data);
        });
    }


    function run()
    {
        $this->publish();
    }
}
$demo=new redis_subscribe();
$demo->run();