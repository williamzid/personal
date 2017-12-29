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
include_once('spider/WebSpider.php');
include_once('DataBase/Mysql.php');

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

$arr = array(-19,-32,-23,-4,2,45,23,443);

$arr = quickSort($arr);




$arr = array('a', 'b', 'c', 'd');

foreach ( $arr as &$val ) {  // 该foreach 会导致 $val = &$arr[3];

}

foreach ( $arr as $val ) {
    print_r($arr);
    echo '<br/>';
}
exit;
// 循环数组时的怪现象
$arr = array(0, 1, 2, 3);

foreach ( $arr as $v )
{

}

var_dump(current($arr));  // 数组指针停留在数组结尾处， 取不到值. false

echo '<br/>';

$arr = array(0, 1, 2, 3);

foreach ( $arr as $val=>$key ) { // foreach 使用的 $arr 是   $arr的副本.
    $arr[$key] = $val;  // 修改之后，就会产生分裂。 foreach 遍历的是 $arr 的副本。 但是原数组的指针已经走了一步.
}

var_dump(current($arr)); // 1

exit;

//db connect
$db = new Mysql();
$db->getClassStringLeton();
exit;


//spider
$web_spider = new WebSpider();
$web_spider->getChoiesSkuAndImages();
exit;
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



