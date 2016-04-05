<?php
$site_id = "bing";
$keyword = "hotel";
$url = "kayak.com";
require_once(dirname(__FILE__).'/'.$site_id.'.php');

$s = new $site_id($keyword,$url);

echo $s->getRank();
exit;
$output[$site_id] = $s->getRank();

exit;
if(isset($_POST['url']) && $_POST['url'] !=""
&& isset($_POST['keyword']) && $_POST['keyword'] !=""
)
{
    $output = array(
        'google' => '1',
        'naver' => '30',
        'yahoo' => '80',
        'bing' => '10',
    );
}


echo json_encode($output);
