<?php
/**
 * Created by PhpStorm.
 * User: KeenSting
 * Date: 16/1/12
 * Time: 下午2:53
 * Name: 梁勋
 * Phone: 13126734215
 * QQ: 707719848
 * File Description: 通过设置文件的header来开放跨域请求
 */

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:x-requested-with,content-type');



echo 'ok';