
<?php
/**
 * Created by PhpStorm.
 * User: KeenSting
 * Date: 16/1/19
 * Time: 上午11:21
 * Name: 梁勋
 * Phone: 13126734215
 * QQ: 707719848
 * File Description: socket server
 */

error_reporting(0);
class socket_server
{
    protected $host='127.0.0.1';
    protected $port=10208;
    protected $socket;

    function __construct()
    {
        //创建socket
        if(($this->socket=socket_create(AF_INET,SOCK_STREAM,SOL_TCP))===false)
        {
            echo 'socket_create() failed!  reason:'.socket_strerror(socket_last_error());
            exit;
        }
        //绑定端口
        if(socket_bind($this->socket,$this->host,$this->port)===false)
        {
            echo 'socket_bind() failed!  reason:'.socket_strerror(socket_last_error($this->socket));
            exit;
        }
        //监听
        if(socket_listen($this->socket,5)===false)
        {
            echo 'socket_listen() failed!  reason:'.socket_strerror(socket_last_error($this->socket));
            exit;
        }

    }


    function run()
    {
        //得到客户端的socket,并与之通讯!
        do{
            if(($remote_socket=socket_accept($this->socket))===false)
            {
                echo 'socket_accept() failed!  reason:'.socket_strerror(socket_last_error($this->socket));
                continue;
            }
            $message='<h1 style="color:cyan"> welcome!</h1>';
            socket_write($remote_socket,$message,strlen($message));//第一次接入,发送欢迎消息
            echo 'read client message!';
            $buf=socket_read($remote_socket,8192);
            echo 'message:'.$buf;
            $reply='server has receive your message:'.$buf;
            if(socket_write($remote_socket,$reply,strlen($reply))===false)
            {
                echo 'socket_write() failed!  reason:'.socket_strerror(socket_last_error($remote_socket));
                continue;
            }else
            {
                echo 'success!';
                socket_close($remote_socket);
            }
        }while(true);

        socket_close($this->socket);
        echo 'server shutdown!';
    }

}

$demo=new socket_server();
$demo->run();

