<?php
/**
 * Created by PhpStorm.
 * User: KeenSting
 * Date: 16/1/12
 * Time: 下午3:04
 * Name: 梁勋
 * Phone: 13126734215
 * QQ: 707719848
 * File Description: 测试php子线程
 */

class children
{
    protected $file;
    function __construct()
    {
        $this->file=fopen('log.txt','a+') or die('file open failed!');
    }

    function __destruct()
    {
        fclose($this->file);
    }

    function run()
    {
        for($i=1;$i<10;$i++) {
            $child = pcntl_fork();//下面的代码,父子进程同时执行
            if ($child == -1) {
                echo 'child create failed!';
            } else if ($child) {
                fwrite($this->file,'father thread,pid='.$child."\n");
                pcntl_wait($status);
            }
            else {
                fwrite($this->file,'children!'."\n");
            }
        }
    }
}
$demo=new children();
$demo->run();