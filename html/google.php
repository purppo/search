<?php
include_once 'simple_html_dom.php';
class google
{
    public $url = 'https://www.google.co.kr/search?q=';
    public function __construct($keyword,$search_url)
    {
        $this->keyword = $keyword;
        $this->search_url = $search_url;
        $this->page = 0;
    }
    
    public function getHtml()
    {
        $html = shell_exec('phantomjs --load-images=false '.dirname(__FILE__).'/getHtml.js '.escapeshellarg($this->url.urlencode($this->keyword).'&&start='.$this->page));
        return $html;
    }
    
    
    public function getRank()
    {
        $rank = 0;
        for ($page=0; $page <=50; $page+=10) {
            $this->page = $page;
            $html = self::getHtml();
            if(preg_match('/일치하는 검색결과가 없습니다/', $html)){
                $rank = -1;
                break;
            }
            $dom = str_get_html($html);
            if(!is_null($dom->find('cite',0))){
                $search_rank = 0;
                foreach ($dom->find('cite') as $e) {
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