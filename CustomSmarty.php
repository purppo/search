<?php
/*-*-*-*-*-*-*-*-*-*-*
workin-career.jp

Paradigm Shift,Inc.
*-*-*-*-*-*-*-*-*-*-*/

require_once 'Smarty/Smarty.class.php';

class PlanManagerSmarty extends Smarty {
    function __construct($compiledTmpdir) {
        global $configWorkinCareer;

        parent::__construct();

        $this->template_dir = $configWorkinCareer->template->templateDir;
        $this->dirExistChk($configWorkinCareer->template->compiledTemplateDir.'/'.$compiledTmpdir);
        $this->compile_dir = $configWorkinCareer->template->compiledTemplateDir.'/'.$compiledTmpdir;

        $this->assign('error',array());
        $this->default_modifiers[] = 'escape:html';
    }

    //フォルダの存在確認&存在しない場合には作成
    function dirExistChk($dirPath){
    if(!file_exists($dirPath)){
        $a = explode("/",$dirPath);
        $dir = '/';
        for($i=0;$i<count($a);$i++){
            if(trim($a[$i]) == '') continue;
                $dir .= $a[$i].'/';
                if(!file_exists($dir)){ //フォルダ作成
                    mkdir($dir);
                }
            }
        }
    }

    function convert_encoding_to_eucjp($buff, &$smarty)
    {
    	return mb_convert_encoding($buff,"EUC-JP","SJIS");
    }
    function convert_encoding_to_sjis($buff, &$smarty)
    {
    	return mb_convert_encoding($buff,"SJIS","EUC-JP");
    }

}
?>