<?php
include_once 'simple_html_dom.php';
class naver
{
    public $base_url = 'https://search.naver.com/search.naver?display=10&doc_sources=&ie=utf8&nso=&qdt=&query=#search_keyword#&qvt=&sm=tab_nmr&sort=1&source=0&srcharea=0&where=site&start=#page#';
    public $keyword;
    public $search_url;
    public function __construct($keyword,$search_url)
    {
        $this->keyword = $keyword;
        $this->search_url = $search_url;
    }
    
     public function getHtml()
    {
        //네이버는 포털사이트이기떄문에 통합검색이아니고 사이트를 찾는다
        $url = str_replace(array("#search_keyword#","#page#"), array(urlencode($this->keyword),$this->page), $this->base_url);
        $html = shell_exec('phantomjs --load-images=false '.dirname(__FILE__).'/getHtml.js '.escapeshellarg($url));
        return $html;
    }

    public function getRank()
    {
        $rank = 0;
        $search_rank = 0;
        for ($page=1; $page <=51; $page+=10) {
            $this->page = $page;
            $html = self::getHtml();
            if(preg_match('/대한 검색결과가 없습니다/', $html)){
                $rank = -1;
                break;
            };
            $dom = str_get_html($html);
            if(!is_null($dom->find('.url',0))){
                foreach ($dom->find('.url') as $e) {
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