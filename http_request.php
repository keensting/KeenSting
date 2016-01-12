<?php
/**
 * Created by PhpStorm.
 * User: KeenSting
 * Date: 16/1/12
 * Time: 上午10:36
 * Name: 梁勋
 * Phone: 13126734215
 * QQ: 707719848
 * File Description: php模拟http请求
 */


class HttpRequester{

    protected $destination='http://test.php.com';
    protected $data=[
        'name'=>'keensting',
        'pwd'=>12345678,
        'type'=>'login'
    ];


    protected function sent_http_request()
    {
        $data=http_build_query($this->data);
        $stream=[
            'hhtp'=>[
                'method'=>'POST',
                'header'=>'Content-type:application/x-www-form-urlencoded',
                'content'=>$data,
            ],
        ];
        $context=stream_context_create($stream);
        $result=file_get_contents($this->destination,false,$context);
        return $result;
    }



    function run()
    {
        $this->sent_http_request();
    }


}

$demo=new HttpRequester();
$demo->run();