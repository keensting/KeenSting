<?php
/**
 * Created by PhpStorm.
 * User: KeenSting
 * Date: 16/1/20
 * Time: 下午6:35
 * Name: 梁勋
 * Phone: 13126734215
 * QQ: 707719848
 * File Description: redis hash
 */
//date_default_timezone_set('PRC');
class redis_hash
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

    private function set_hash()
    {
        $this->redis->hMset('test',[
            'name'=>'keensting',
            'age'=>22,
            'email'=>'keensting@163.com',
            'phone'=>'13126734215',
            'sex'=>'male'
        ]);

    }

    private function get_hash()
    {
        //获得一条记录中的一个键值
        echo $this->redis->hGet('test','name');
        //判断该条记录中是否存在该键
        echo $this->redis->hExists('test','name');
        //获取该记录的全部键&值
        print_r($this->redis->hGetAll('test'));
        //获取一条记录中的多个键值
        print_r($this->redis->hMGet('test',[
            'name','age','email','phone'
        ]));
        //获得该记录中所有的键
        print_r($this->redis->hKeys('test'));
        //获得该记录中所有的值
        print_r($this->redis->hVals('test'));
        //获得当前记录的长度
        print_r($this->redis->hLen('test'));
        //删除一条记录中的键值对
        $this->redis->hDel('test','name');

    }
    function run()
    {
        $this->set_hash();
        $this->get_hash();
    }

}
$demo=new redis_hash();
$demo->run();