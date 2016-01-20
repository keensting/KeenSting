<?php
/**
 * Created by PhpStorm.
 * User: KeenSting
 * Date: 16/1/20
 * Time: 下午3:48
 * Name: 梁勋
 * Phone: 13126734215
 * QQ: 707719848
 * File Description: redis key
 */

class redis_key
{
    private $redis;

    function __construct()
    {
        $this->redis=new Redis();
        $this->redis->connect('127.0.0.1',6379);
        echo $this->redis->ping();
    }

    function __destruct()
    {
        $this->redis->close();
    }

    private function set_key()
    {
        $this->redis->set('name','keensting');
        $this->redis->set('age',22);
        $this->redis->set('sex','male');
        $this->redis->set('school','BJUT');
        $this->redis->set('phone','13126734215');
        $this->redis->set('email','keensting@163.com');
    }

    private function get_key()
    {
        echo $this->redis->get('name')."\n";
        echo $this->redis->get('age')."\n";
        echo $this->redis->get('sex')."\n";
        echo $this->redis->get('school')."\n";
        echo $this->redis->get('phone')."\n";
        echo $this->redis->get('email')."\n";
    }

    function run()
    {
        $this->set_key();
        $this->get_key();

    }


}
$demo=new redis_key();
$demo->run();