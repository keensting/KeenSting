<?php
/**
 * Created by PhpStorm.
 * User: KeenSting
 * Date: 16/1/11
 * Time: 下午5:36
 * Name: 梁勋
 * Phone: 13126734215
 * QQ: 707719848
 * File Description: 二维数组排序
 */


class TwoDimensionSort
{
    public  $test_arr=[
        [
            'name'=>'keensting',
            'age'=>22,
            'height'=>183
        ],
        [
            'name'=>'wenjin',
            'age'=>31,
            'height'=>168,
        ],
        [
            'name'=>'xiaohua',
            'age'=>18,
            'height'=>172,
        ]
    ];


    public  function two_dimension_sort()
    {
        $array=$this->test_arr;
        foreach($array as $v)
        {
            $keys[]=$v['age'];
        }
        array_multisort($keys,SORT_ASC,$array);
        print_r($array);
    }
}
$demo=new TwoDimensionSort();
$demo->two_dimension_sort();