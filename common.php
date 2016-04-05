<?php
ini_set('include_path',dirname(__FILE__).'/lib/');
ini_set('display_errors', 1);
session_start();
$page_load_start_time = microtime(true);
$dir = dirname(__FILE__);

mb_language("uni");
mb_language("Japanese");
mb_internal_encoding("UTF-8");

//Smarty読み込み
require_once 'CustomSmarty.php';
//$tmp = array_values( array_diff( explode('/', isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:''), array( "" ) ) );
$smarty = new Smarty;
$smarty->template_dir = $dir.'/tpl';
$smarty->compile_dir = $dir.'/tmp';
$smarty->default_modifiers = array('escape:"html"');
$smarty->default_modifiers = array('default:""');

$tpl_name = $dir.'/tpl/html'.dirname($_SERVER["SCRIPT_NAME"]).basename($_SERVER["PHP_SELF"],".php").'.tpl';
$file_name = basename($_SERVER["PHP_SELF"],".php");
$smarty->assign('file_name',$file_name);

function e($param,$flg = ''){
	if($flg == ''){
		echo "<pre>";var_dump($param);echo "<pre>";
	}else{
		echo "<!-- <pre>";var_dump($param);echo "<pre> -->";
	}
	
}

