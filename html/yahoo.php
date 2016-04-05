<?php
include_once 'simple_html_dom.php';
class yahoo
{
    public $base_url = 'http://search.yahoo.com/search?p=#keyword#&search.x=1&tid=top_ga1_sa&ei=UTF-8&pstart=1&fr=top_ga1_sa&b=#page#';
    public function __construct($keyword,$search_url)
    {
        $this->keyword = $keyword;
        $this->search_url = $search_url;
        $this->page = 0;
    }
    
    public function getHtml()
    {
        $url = str_replace(array('#keyword#','#page#'), array(urlencode($this->keyword),$this->page), $this->base_url);
        $html = shell_exec('phantomjs  --load-images=false  '.dirname(__FILE__).'/getHtml.js '.escapeshellarg($url));
        return $html;
    }
    
    
    public function getRank()
    {
        $rank = 0;
        $search_rank = 0;
        for ($page=1; $page <=51; $page+=10) {
            $this->page = $page;
            $html = self::getHtml();
            if(preg_match('/We did not find results/', $html)){
                $rank = -1;
                break;
            }
            $dom = str_get_html($html);
            if(!is_null($dom->find('em',0))){
                $search_rank = 0;
                foreach ($dom->find('em') as $e) {
                    if(preg_match('/^[0-9]+/', $e->plaintext)){
                        continue;
                    }
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