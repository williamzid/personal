<?php
/**
 * Created by PhpStorm.
 * User: williamzid
 * Date: 16/7/14
 * Time: 上午11:14
 */
function getFilterWordHashTable($arr)
{
    $hash_table1 = [];
    $hash_table1_m = &$hash_table1;
    foreach ($arr as $arr_single) {

        $char_arr = [];
        for ($i = 0; $i < mb_strlen($arr_single); $i++) {
            $c = mb_substr($arr_single, $i, 1);
            $char_arr[] = $c;

            if (!empty($hash_table1_m[$c])) {

            } else {
                $hash_table1_m[$c] = [];
            }

            $hash_table1_m = &$hash_table1_m[$c];

        }
        $hash_table1_m = &$hash_table1;
        var_dump($hash_table1);
        exit;

    }


    return $hash_table1;
}


function find($content, $filter_hash)
{
    if (empty($content)) {
        return 0;
    }
    $rt1 = 0;
    $rt2 = 0;

    $content_single = mb_substr($content, 0, 1);


    if (isset($filter_hash[$content_single])) {

        if (empty($filter_hash[$content_single])) {
            return 1;
        } else {
            $rt1 = find(mb_substr($content, 1), $filter_hash[$content_single]);
        }

    }

    if (!$rt1) {
        $rt2 = find(mb_substr($content, 1), $filter_hash);
    }


    if ($rt1 || $rt2) {
        return 1;
    } else {
        return 0;
    }
}

$start_time = microtime(true);
$filter_word = explode(',', file_get_contents('/Users/williamzid/workspace/personal/assets/filter_word.txt'));
var_dump($filter_word);exit;

$content = file_get_contents('/Users/williamzid/workspace/personal/assets/filter_article.txt');
$filter_word_hash_table = getFilterWordHashTable($filter_word);
var_dump($filter_word_hash_table);
exit;

$rt = find($content, $filter_word_hash_table);
$end_time = microtime(true);

echo $end_time - $start_time;
print_r($rt);
exit;



//
//function getFilterWordHashTable($arr)
//{
//    $hash_table1 = [];
//
//    foreach ($arr as $arr_single) {
//        $char1 = mb_substr($arr_single, 0, 1);
//        $hash_table1[$char1][] = $arr_single;
//    }
//
//    $hash_table2 = [];
//
//    foreach ($hash_table1 as $hash_key1 => &$hash_table1_single) {
//        $second_char = [];
//        foreach ($hash_table1_single as $str_single) {
//            $char2 = mb_substr($str_single, 1, 1);
//            $second_char[$char2][] = $str_single;
//        }
//        $hash_table1_single = $second_char;
//    }
//
//    foreach ($hash_table1 as $hash_key2 => &$hash_table1_single2) {
//
//        foreach ($hash_table1_single2 as &$inner_hash_table) {
//            $third_char = [];
//            foreach ($inner_hash_table as $str_single2) {
//                $char2 = mb_substr($str_single2, 2, 1);
//                $third_char[$char2][] = $str_single2;
//            }
//            $inner_hash_table = $third_char;
//        }
//
//    }
//
//    return $hash_table1;
//}
//
//function find($content, $filter_hash, $count)
//{
//    if (empty($content)) {
//        return 0;
//    }
//    $rt1 = 0;
//    $rt2 = 0;
//
//    $content_single = mb_substr($content, 0, 1);
//
//
//    if (!empty($filter_hash[$content_single])) {
//        if ($count == 2) {
//            foreach ($filter_hash[$content_single] as $filter_content) {
//                if (mb_substr($filter_content, 2) == $content || mb_stristr($content, mb_substr($filter_content, 2))) {
//                    return 1;
//                    break;
//                }
//            }
//            $rt1 = 0;
//
//        } else {
//            $count++;
//            $rt1 = find(mb_substr($content, 1), $filter_hash[$content_single], $count);
//        }
//
//    }
//wiwimwmw sdas hsajajaslsldsain osndlandaldunwndaww w
//
//    $rt2 = find(mb_substr($kklcontent, 1), $filter_hash, 0);
//win
//
//    if ($rt1 || $rt2) {
//        return 1;
//    } else {
//        return 0;
//    }
//}