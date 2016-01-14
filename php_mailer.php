<?php
/**
 * Created by PhpStorm.
 * User: KeenSting
 * Date: 16/1/12
 * Time: 下午8:35
 * Name: 梁勋
 * Phone: 13126734215
 * QQ: 707719848
 * File Description: php文件描述
 */

class Mailer
{
    protected $destination;//目的地址
    protected $source;//源地址
    protected $pass;//密码
    protected $log_filer;//日志文件指针
    protected $relay_host;//邮件smtp服务器
    protected $smtp_port;//邮件端口
    protected $auth;//是都需要验证用户
    protected $time_out;//默认终止时间
    protected $host_name;//在HELO命令中使用
    protected $sock;

    function  __construct($smtp_server,$port,$user,$pass,$auth)
    {
        date_default_timezone_set('PRC');
        $this->log_filer=fopen('mail_log.log','a+');
        $this->smtp_port=$port;
        $this->relay_host=$smtp_server;
        $this->source=$user;
        $this->pass=$pass;
        $this->time_out=30;
        $this->auth=$auth;
        $this->host_name="localhost";
    }


    function __destruct()
    {
        fclose($this->log_filer);
    }

    /**写入日志文件
     * @param $message
     */
    protected function write_log($message)
    {
        fwrite($this->log_filer,date('Y-m-d h:i:sa').' : '.$message);
    }

    /**创建邮件实体实现发送
     * @param $to
     * @param $from
     * @param string $subject
     * @param string $body
     * @param $type
     */
    function create_mail($to, $from, $subject="", $body="", $type)
    {
        $mail_from=addslashes($from);
        $header="MIME-Version:1.0\r\n";//申明邮件

        if($type=='HTML')//如果邮件内容以HTML形式展现
        {
            $header.="Content-Type:text/html\r\n";
        }
        $mail_to=addslashes($to);
        $header.='TO: '.$mail_to."\r\n";
        $header.="From: $from<".$from.">\r\n";
        $header.="Subject: ".$subject."\r\n";
        $header.="Date: ".date('r')."\r\n";
        $header.="X-Mailer:By Redhat (php/".phpversion().")\r\n";
        list($msec,$sec)=explode(" ",microtime());
        $header.="Message-ID: <".date('Y-m-d H:i:s',$sec).".".($msec*1000000).".".$mail_from.">\r\n";
        //检查目标邮箱是否可以到达
        if($this->smtp_sockopen_relay())//邮件服务器成功连接
        {
            $this->send($mail_from,$mail_to,$header,$body);
            $this->write_log("mail has been sent!");
        }



    }


    /**发送过程
     * @param $from
     * @param $to
     * @param $header
     * @param $body
     * @return bool
     */
    function send($from, $to, $header, $body)
    {
        if(!$this->smtp_cmd('HELO',$this->host_name)){
            return $this->smtp_error('send HELO command');
        }

        if($this->auth)
        {
            if(!$this->smtp_cmd('AUTH LOGIN', base64_encode($this->source)))
            {
                return $this->smtp_error('send AUTH info');
            }
        }
        if(!$this->smtp_cmd('',base64_encode($this->pass)))
        {
            return $this->smtp_error('send pass info');
        }

        if(!$this->smtp_cmd('MAIL','FROM:<'.$from.'>'))
        {
            return $this->smtp_error('sending Mail from command');
        }
        if(!$this->smtp_cmd('RCPT',"TO:<$to>"))
        {
            return $this->smtp_error('send RCPT to command');
        }
        if(!$this->smtp_cmd('DATA'))
        {
            return $this->smtp_error('send DATA to command');
        }

        fputs($this->sock,$header."\r\n".$body);
        $this->write_log('message send!'."\r\n");


        fputs($this->sock,"\r\n.\r\n");
        if(!$this->smtp_state())
        {
            $this->smtp_error('handle EOM');
        }

        if(!$this->smtp_cmd('QUIT'))
        {
            return $this->smtp_error('send QUIT command');
        }


    }


    /**smtp传输命令,检查状态
     * @param $cmd
     * @param string $arg
     * @return bool
     */
    function smtp_cmd($cmd, $arg='')
    {
        if(!empty($arg))
        {
            if(empty($cmd))
                $cmd=$arg;
            else
                $cmd.=' '.$arg;
        }
        fputs($this->sock,$cmd."\r\n");
        return $this->smtp_state();
    }

    /**错误日志记录
     * @param $mes
     * @return bool
     */
    function smtp_error($mes)
    {
        $this->write_log("Error: Error occurred while ".$mes."\n");
        return false;
    }


    /**检查邮箱smtp服务器是否可用
     * @return bool
     */
    function smtp_sockopen_relay()
    {
        $this->write_log("Trying to ".$this->relay_host.':'.$this->smtp_port."\n");
        $this->sock=@fsockopen($this->relay_host,$this->smtp_port,$errno,$errstr,$this->time_out);
//        print_r($this->sock);
        if(!($this->sock && $this->smtp_state()))
        {
            $this->write_log("Error: Cannot connenct to relay host ".$this->relay_host."\n");

            $this->write_log("Error: ".$errstr." (".$errno.")\n");
            return false;
        }else
        {
            $this->write_log("Connected to relay host ".$this->relay_host."\n");

            return true;
        }
    }


    /**检查smtp是否正常可用
     * @return bool
     */
    function smtp_state()
    {
        $response=str_replace("\r\n","",fgets($this->sock,512));
//        print_r($response);
        if(!ereg("^[23]",$response))
        {
            fputs($this->sock,"QUIT\r\n");
            fgets($this->sock,512);
            $this->write_log('Error: remote host return:'.$response);
            return false;
        }else
        {
            return true;
        }
    }






}

$demo =new Mailer('smtp.qq.com',25,'707719848@qq.com','your mail password',true);
$demo->create_mail('keensting@163.com','707719848@qq.com','just a test','hello mail!','HTML');