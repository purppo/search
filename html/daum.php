<?php
include_once 'simple_html_dom.php';
class daum
{
    public $base_url = 'http://search.daum.net/search?w=site&q=#keyword#&lpp=10&page=#page#';
    public function __construct($keyword,$search_url)
    {
        $this->keyword = $keyword;
        $this->search_url = $search_url;
        $this->page = 0;
    }
    
    public function getHtml()
    {
        $url = str_replace(array('#keyword#','#page#'), array(urlencode($this->keyword),$this->page), $this->base_url);
        $html = shell_exec('phantomjs  --load-images=false '.dirname(__FILE__).'/getHtml.js '.escapeshellarg($url));
        return $html;
    }
    
    
    public function getRank()
    {
        $rank = 0;
        $search_rank = 0;
        for ($page=1; $page <=5; $page+=1) {
            $this->page = $page;
            $html = self::getHtml();
            if(preg_match('/대한 검색결과가 없습니다/', $html)){
                $rank = -1;
                break;
            }
            $dom = str_get_html($html);
            if(!is_null($dom->find('.f_url',0))){
                foreach ($dom->find('.f_url') as $e) {
                    $search_rank++;
                    $urls[] = $e->plaintext;
                    if(strpos($e->plaintext, $this->search_url) !== FALSE){
                        $rank = $search_rank;
                        break;
                    }
                }
            }
            if(0 < $rank){
                break;
            }
        }
        return $rank;
    }
}
?>