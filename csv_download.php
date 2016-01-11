<?php
/**
 * Created by PhpStorm.
 * User: KeenSting
 * Date: 16/1/11
 * Time: 下午4:46
 * Name: 梁勋
 * Phone: 13126734215
 * QQ: 707719848
 * File Description: 强制打开页面后直接下载一个csv文件
 */

class CsvDownloader
{
    private  $test_arr=[
        ['梁勋','男','22','北京工业大学','安徽合肥'],
        ['梁小苍','男','22','北京林业大学','安徽合肥'],
        ['梁小白','男','22','北京交通大学','安徽合肥'],
        ['梁小黄','男','22','北京理工大学','安徽合肥']
    ];



    function __construct()
    {
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=人员信息.csv ");
        header("Content-Transfer-Encoding: binary ");

    }

    function __destruct()
    {
        unset($this->test_arr);
    }

    private function execute_operation()
    {
        foreach($this->test_arr as $v)
        {
            echo $v[0].','.$v[1].','.$v[2].','.$v[3].','.$v[4]."\n";
        }
    }


    function run()
    {
        $this->execute_operation();
    }
}

$demo=new CsvDownloader();
$demo->run();
