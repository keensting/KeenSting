<?php
/**
 * Created by PhpStorm.
 * User: KeenSting
 * Date: 16/1/19
 * Time: 下午3:51
 * Name: 梁勋
 * Phone: 13126734215
 * QQ: 707719848
 * File Description: music API
 */

//error_reporting(0);

class music
{
    protected $name;//音乐名称
    protected $timeout;//等待时间
    protected $offset;//偏移量
    protected $number;//资源数目

    function __construct($name,$time,$offset=0,$number=15)
    {
        $this->name=$name;
        $this->timeout=$time;
        $this->offset=$offset;
        $this->number=$number;
    }

    protected function get_content()
    {
        $url='http://s.music.163.com/search/get/?s='.urlencode($this->name).'&type=1&limit='.$this->number.'&offset='.$this->offset;
//        $url='http://so.1ting.com/all.do?q='.urlencode($this->name);
        if(!function_exists('file_get_contents'))//当php没有该方法,使用curl获取内容
        {
            $ch=curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$this->timeout);
            $file_content=curl_exec($ch);
            curl_close($ch);
        }else
        {
            $file_content=file_get_contents($url);
        }
        return $file_content;
    }

    public function get_music_info()
    {
        $data=$this->get_content();
        $data=json_decode(json_encode(json_decode($data)),true);
        foreach($data['result']['songs'] as $v)
        {
            $list[]=[
                'name'=>$v['name'],
                'artist'=>$v['artists'][0]['name'],
                'album'=>$v['album']['name'],
                'img'=>$v['album']['picUrl'],
                'audio'=>$v['audio']
            ];
        }
        echo json_encode($list);

    }


}

$demo=new music('青春修炼手册',5);
$demo->get_music_info();