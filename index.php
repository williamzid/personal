<?php

/**
 * Created by PhpStorm.
 * User: williamzid
 * Date: 16/5/31
 * Time: 上午10:15
 */
include_once('GraphicFactory.php');
include_once('TextFactory.php');
include_once('DirtyWordsFilter.php');
include_once('leetcode/leetcode/php/leetcode442.php');

class Client
{
    private $someGraphicObject;
    private $someTextObject;

    public function __construct()
    {
        $this->someGraphicObject = new GraphicFactory();
        echo $this->someGraphicObject->startFactory() . "<br/>";
        $this->someTextObject = new TextFactory();
        echo $this->someTextObject->startFactory();
    }
}

$arr = [1,2,2,3,3,1,3,6,7,8,8,9,4,6];
$sol = new findAllDuplicatesInArray();
$res = $sol->solution($arr);
var_dump($res);exit;
$arr = [5,4,2,11,3,98,1,56,32,123,15,6,23];
$array_kth = leetcode($arr,3);
var_dump($array_kth);exit;
$arr2 = bubbleSort($arr);
$arr3 = quickSort($arr);
var_dump($arr3);exit;


//
//$handle = fopen('/etc/hosts', 'rb');
//while (feof($handle) !== true) {
//    echo fgetc($handle);
//}
//fclose($handle);

stream_filter_register('dirty_words_filter', 'DirtyWordsFilter');

$handle = fopen('abc', 'rb');

stream_filter_append($handle, 'dirty_words_filter');
while (feof($handle) !== true) {
    echo fgetc($handle);
}
fclose($handle);
exit;

$handle = fopen('abc', 'rb');
stream_filter_append($handle, 'string.toupper');
while (feof($handle) !== true) {
    echo fgetc($handle);
}
fclose($handle);
$dateStart = new \DateTime();

$dateInterval = \DateInterval::createFromDateString('-1 day');
$dataInterval = new \DateInterval('P2Y4DT6H8M');
$dataPeriod = new \DatePeriod($dateStart, $dateInterval, 30);

foreach ($dataPeriod as $date) {
    var_dump($date->format('Y-m-d'));
}
exit;


$input = '<p><script>alert("will you lllll");</script></p>';
echo htmlentities($input, ENT_QUOTES, 'UTF-8');
$worker = new Client();


function bubbleSort($array)
{
    $len = count($array);
    for($i = 1; $i < $len; $i++){
        for($k = 0;$k < $len - $i; $k++){
            if($array[$k] > $array[$k+1]){
                $temp = $array[$k+1];
                $array[$k+1] = $array[$k];
                $array[$k] = $temp;
            }
        }
    }
    return $array;
}

function quickSort($array)
{
    $len = count($array);
    if($len < 1){
        return $array;
    }
    $base_num = $array[0];

    $left_arr = $right_arr = [];
    for($i = 1; $i < $len; $i++){
        if($array[$i] > $base_num){
            $left_arr[] = $array[$i];
        }else{
            $right_arr[] = $array[$i];
        }
    }

    $left_arr = quickSort($left_arr);
    $right_arr = quickSort($right_arr);

    $arr = array_merge($left_arr,array($base_num),$right_arr);
    return $arr;
}

/**
 * leetcode 215 取数组第k大的值
 * @param $arr
 * @param $k
 * @return bool
 */
function leetcode($arr, $k)
{
    if(!is_array($arr)){
        return false;
    }
    rsort($arr);
    if(!empty($arr[$k-1])){
        return $arr[$k-1];
    }else{
        return false;
    }
}



