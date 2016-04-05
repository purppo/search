<?php
ini_set( 'display_errors', 0);
$page_load_start_time = microtime(true);
//require_once(dirname(__FILE__).'/../inc/search/searchPool.php');
//require_once(dirname(__FILE__).'/../inc/search/searchWorker.php');

$sites = [
        'google'=>'google',
        'naver'=>'naver',
        'bing'=>'bing',
        'daum'=>'daum',
        'yahoo'=>'yahoo',
        ];
$keyword = isset($_POST['keyword'])?$_POST['keyword']:'repchecker';
$url = isset($_POST['url'])?$_POST['url']:'repchecker.jp';
foreach ($sites as $site_id => $site_name) {
    if(file_exists(dirname(__FILE__).'/'.$site_id.'.php')){
        require_once(dirname(__FILE__).'/'.$site_id.'.php');
        $s = new $site_id($keyword,$url);
        $output['rank'][$site_id] = $s->getRank();
    }else{
        $output['rank'][$site_id] = 0;
    }
}
$output['time'] = number_format((microtime(true) - $page_load_start_time),2)."s";
echo json_encode($output);