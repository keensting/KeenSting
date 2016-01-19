<?php
/**
 * Created by PhpStorm.
 * User: KeenSting
 * Date: 16/1/19
 * Time: 下午1:19
 * Name: 梁勋
 * Phone: 13126734215
 * QQ: 707719848
 * File Description: socket client;
 */

error_reporting(0);
class socket_client{

    protected $server_port=10208;
    protected $host='127.0.0.1';
    protected $socket;

    function __construct()
    {

        if(($this->socket=socket_create(AF_INET,SOCK_STREAM,SOL_TCP))===false)
        {
            echo 'socket_create() failed!  reason:'.socket_strerror(socket_last_error());
            exit;
        }

        echo 'connecting...';
        if($result=socket_connect($this->socket,$this->host,$this->server_port)===false)
        {
            echo 'socket_connect() failed!  reason:'.socket_strerror(socket_last_error($this->socket));
            exit;
        }

    }

    function run()
    {
        $in='233333333';
        socket_write($this->socket,$in,strlen($in));
        echo 'message sent!';
        $out=socket_read($this->socket,8192);
        echo 'reply infomation:'.$out;
        socket_close($this->socket);
    }

}

$demo=new socket_client();
$demo->run();