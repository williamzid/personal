<?php
/**
 * Created by PhpStorm.
 * User: williamzid
 * Date: 2017/3/23
 * Time: 上午11:11
 */
require_once('simple_html_dom.php');
class WebSpider
{
    protected $url;

    /**
     * 抓取网页内容
     */
    public function getWebContents()
    {
        $curl = curl_init();
        //curl_setopt($curl,CURLOPT_URL,'http://shanghai.anjuke.com');
        curl_setopt($curl, CURLOPT_URL, 'www.anjuke.com');

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPGET, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
//        curl_setopt($curl, CURLOPT_HEADERFUNCTION, function ($curl, $str) use (&$set_cookie) {
//            list($name, $value) = array_map('trim', explode(":", $str, 2));
//            $name = strtolower($name);
//            if ('set-cookie' == $name) {
//                $set_cookie[] = $value;
//            }
//            return strlen($str);
//        });

        $html = curl_exec($curl);
        $curl_info = curl_getinfo($curl);

        var_dump($curl_info);
        exit;
        curl_close($curl);
        $cookie = array();
        foreach ($set_cookie as $c) {
            $tmp = explode(':', $c);
            $cookie[] = $tmp[0];
        }
        $cookie_str = "Cookie:" . implode(";", $cookie);
        echo implode(";", $cookie);
        exit;
        $headers[] = $cookie;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://guangzhou.anjuke.com/');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, implode(";", $cookie));
        $html = curl_exec($curl);

        var_dump($html);
        exit;

    }

    /**
     * simple_html_dom
     */
    public function simpleHtmlDom()
    {
        $file = file_get_html();
    }

    /**
     * 获取anjuke小区图片信息
     */
    public function getAnjuekeImage()
    {
        $partten = '/<ul[ ]*id="imagelist"[\s\S]*\<\/ul\>/U';
        $shein_patten = '/div[ ]*class="swiper-wrapper"[\s\S]*\<\/ul\>/U';
        $partten_url = '/src="([\s\S]*)"/U';
        $partten_size = '/\/([\d]*x[\d]*).(jpg|jpeg|png)$/U';
        $partten_name = '/name="main_cont"[\s\S]*class="contor"[\s\S]*class="pic-title"[\s\S]*title="(.*)"/U';

        $max_id = 10;
        $anjuke_key = 1;
        for (; $anjuke_key < $max_id; $anjuke_key++) {

            $images_ids = [];
            $ch = curl_init();
            //$url = "http://shanghai.anjuke.com/community/photos2/b/details/" . $anjuke_key . "_1";
            $url = 'http://www.shein.com/Multicolor-Tie-dye-V-Neck-Sleeveless-Knotted-Shift-Dress-p-290744-cat-1727.html';
            curl_setopt($ch, CURLOPT_HTTPGET, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);

            $output = curl_exec($ch);
            $curl_info = curl_getinfo($ch);
            $images_url = [];
            echo 'Anjuke_community_id:' . $anjuke_key, PHP_EOL;
            if (!empty($curl_info) && $curl_info['http_code'] == 200) {
                preg_match($shein_patten, $output, $matches);
                if (!empty($matches[0])) {
                    preg_match_all($partten_url, $matches[0], $matches2);

                    if (!empty($matches2[1])) {
                        $images_url = $matches2[1];
                    }
                }
            }
            if (!empty($images_url)) {
                preg_match($partten_name, $output, $matches3);
                if (!empty($matches3[1])) {
                    $community_name = $matches3[1];
                }

                if (!empty($community_name)) {
                    foreach ($images_url as &$image_url) {
                        $image_url = preg_replace($partten_size, '/m.jpg', $image_url);
                        try {
                            //插入数据
                        } catch (\Exception $e) {
                            echo "上传图片 $image_url 出现问题", PHP_EOL;
                        }
                    }

                }
                curl_close($ch);

                $partten_community_info1 = '/\<dl[ ]*class="comm-r-detail float-r"\>([\s\S]*)\<\/dl\>/U';
                $partten_community_info2 = '/\<dl[ ]*class="comm-l-detail float-l"\>([\s\S]*)\<\/dl\>/U';

                $partten_wuye_gongsi = '/\<dt\>物业公司\<\/dt\>[\s\S]*\<dd\>([\s\S]*)\<\/dd\>/U';
                $partten_wuye_feiyong = '/\<dt\>物业费用\<\/dt\>[\s\S]*\<dd\>([\s\S]*)\<\/dd\>/U';
                $partten_zonghushu = '/\<dt\>总户数\<\/dt\>[\s\S]*\<dd\>([\s\S]*)\<\/dd\>/U';
                $partten_rongjilv = '/\<dt\>容积率\<\/dt\>[\s\S]*\<dd\>([\s\S]*)\<\/dd\>/U';
                $partten_tingchewei = '/\<dt\>停车位\<\/dt\>[\s\S]*\<dd\>([\s\S]*)\<\/dd\>/U';
                $partten_lvhualv = '/\<dt\>绿化率\<\/dt\>[\s\S]*\<dd\>([\s\S]*)\<\/dd\>/U';
                $partten_zongjianmian = '/\<dt\>总建面\<\/dt\>[\s\S]*\<dd\>([\s\S]*)\<\/dd\>/U';
                $partten_kaifashang = '/\<dt\>开发商\<\/dt\>[\s\S]*\<dd\>([\s\S]*)\<\/dd\>/U';
                $partten_jianzaoniandai = '/\<dt\>建造年代\<\/dt\>[\s\S]*\<dd\>([\s\S]*)\<\/dd\>/U';
                $partten_jieshao = '/\<div[ ]*id="comm-description"[\s\S]*\<div[ ]*class="desc-cont"\>([\s\S]*)\<\/div\>/U';


                $ch = curl_init();
                $url = "http://shanghai.anjuke.com/community/view/" . $anjuke_key;
                curl_setopt($ch, CURLOPT_HTTPGET, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $url);

                $output = curl_exec($ch);
                $curl_info = curl_getinfo($ch);

                if (!empty($curl_info) && $curl_info['http_code'] == 200) {
                    preg_match($partten_community_info1, $output, $matches_community_info1);
                    preg_match($partten_community_info2, $output, $matches_community_info2);
                    preg_match($partten_jieshao, $output, $matches_jieshao);

                    $need_update = 0;
                    $manage_model = new ManageCompany();
                    $update_extend_arr = [];

                    if (!empty($matches_jieshao[1])) {
                        $update_extend_arr['intro'] = $matches_jieshao[1];
                    }

                    if (!empty($matches_community_info1[1])) {
                        $community_output = $matches_community_info1[1];
                        preg_match($partten_zonghushu, $community_output, $matches_zonghushu);
                        preg_match($partten_rongjilv, $community_output, $matches_rongjilv);
                        preg_match($partten_tingchewei, $community_output, $matches_tingchewei);
                        preg_match($partten_lvhualv, $community_output, $matches_lvhualv);
                        preg_match($partten_zongjianmian, $community_output, $matches_zongjianmian);
                        preg_match($partten_kaifashang, $community_output, $matches_kaifashang);
                        preg_match($partten_jianzaoniandai, $community_output, $matches_jianzaoniandai);

                        if (!empty($matches_zonghushu[1]) && $matches_zonghushu[1] != '暂无数据') {
                            $update_extend_arr['house_total'] = $matches_zonghushu[1];
                        }
                        if (!empty($matches_rongjilv[1]) && $matches_rongjilv[1] != '暂无数据') {
                            $update_extend_arr['contain_pert'] = $matches_rongjilv[1];
                        }
                        if (!empty($matches_tingchewei[1]) && $matches_tingchewei[1] != '暂无数据') {
                            $update_extend_arr['carbarn_state'] = $matches_tingchewei[1];
                        }
                        if (!empty($matches_lvhualv[1]) && $matches_lvhualv[1] != '暂无数据') {
                            $update_extend_arr['green_pert'] = $matches_lvhualv[1];
                        }
                        if (!empty($matches_zongjianmian[1]) && $matches_zongjianmian[1] != '暂无数据') {
                            $update_extend_arr['area'] = $matches_zongjianmian[1];
                        }
                        if (!empty($matches_jianzaoniandai[1]) && $matches_jianzaoniandai[1] != '暂无数据') {
                            $month_signal = 0;
                            if (preg_match('/\-/', $matches_jianzaoniandai[1])) {
                                $format = 'Y-m';
                                $jianzaoniandai = substr($matches_jianzaoniandai[1], 0, 7);
                            } else {
                                $format = 'Y';
                                $jianzaoniandai = substr($matches_jianzaoniandai[1], 0, 4);
                            }

                            $update_extend_arr['build_date'] = Carbon::createFromFormat($format, $jianzaoniandai)->startOfMonth()->format('Y-m-d H:i:s');
                        }


                        $need_update = 1;
                    }

                    if (!empty($matches_community_info2[1])) {
                        $community_output = $matches_community_info2[1];
                        preg_match($partten_wuye_gongsi, $community_output, $matches_wuye_gongsi);
                        preg_match($partten_wuye_feiyong, $community_output, $matches_wuye_feiyong);
                        if (!empty($matches_wuye_gongsi[1]) && $matches_wuye_gongsi[1] != '暂无数据') {
                            $manage_info = $manage_model->where('name', $matches_wuye_gongsi[1])->get()->toArray();
                            if (!empty($manage_info)) {
                                $update_extend_arr['manage_company_id'] = $manage_info[0]['id'];
                            } else {
                                $add_company_model = new ManageCompany();
                                $add_company_model->name = $matches_wuye_gongsi[1];
                                $add_company_model->save();
                                $update_extend_arr['manage_company_id'] = $add_company_model->id;
                            }
                        }

                        if (!empty($matches_wuye_feiyong[1]) && $matches_wuye_feiyong[1] != '暂无数据') {
                            $update_extend_arr['manage_pay'] = $matches_wuye_feiyong[1];
                        }

                        $need_update = 1;
                    }


                    curl_close($ch);
                }
            }
        }
    }

    /**
     *
     */
    public function getChoiesSkuAndImages()
    {
//        $partten = '/[ ]*product_infos[\s\S]*';
//        $partten_url = '/src="([\s\S]*)"/U';
//        $ch = curl_init();
//        $url = 'https://www.choies.com/ajax/catalog_do_filter?catalog_id=562&type=init&limit=100&current_url=https://www.choies.com/new-c-562?sort=2&need_page=0';
//        curl_setopt($ch, CURLOPT_HTTPGET, 1);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_URL, $url);
//
//        $output = curl_exec($ch);
//        $curl_info = curl_getinfo($ch);
//        if (!empty($curl_info) && $curl_info['http_code'] == 200) {
//            preg_match($partten, $output, $matches);
//            if (!empty($matches[0])) {
//                preg_match_all($partten_url, $matches[0], $matches2);
//
//                if (!empty($matches2[1])) {
//                    $images_url = $matches2[1];
//                }
//            }
//        }
//

        $base_url = 'https://www.choies.com/ajax/catalog_do_filter?catalog_id=562&type=init&limit=48&need_page=';
        $current_url = 'current_url=https://www.choies.com/new-c-562?sort=2&page=';
        $this->mysqlConnect();
        for($page = 1 ; $page<10 ; $page++){
            $need_page = ($page > 1) ? 1 :0;
            $url =  $base_url.$need_page."&".$current_url.$page;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPGET, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $output = curl_exec($ch);
            $curl_info = curl_getinfo($ch);
            if(!empty($curl_info) && $curl_info['http_code'] == 200){
                $products = json_decode($output,true);
                $product_infos = $products['product_infos'];
                foreach($product_infos as $key => $single){

                }
            }

        }


    }

}
