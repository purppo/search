<?php
include_once 'simple_html_dom.php';
class bing
{
    public $url = 'https://www.bing.com/search?q=';
    public function __construct($keyword,$search_url)
    {
        $this->keyword = $keyword;
        $this->search_url = $search_url;
        $this->page = 1;
    }
    
    public function getHtml()
    {
        $html = shell_exec('phantomjs  --load-images=false '.dirname(__FILE__).'/getHtml.js '.escapeshellarg($this->url.urlencode($this->keyword).'
        &first='.$this->page));
        return $html;
    }
    
    
    public function getRank()
    {
        $rank = 0;
        $search_rank = 0;
        $page = 1;
        for ($page=1; $page<=51; $page+=10) {
            $this->page = $page;
            $html = self::getHtml();
            if(preg_match('/No results found for/', $html)){
                $rank = -1;
                break;
            };
            $dom = str_get_html($html);
            foreach($dom->find('li') as $element) {
                if(preg_match("/b_algo/", $element->class)){
                    $search_rank++;
                    $url[]= $element->find("a", 0)->href;
                    if(strpos($element->find("a", 0)->href, $this->search_url) !== FALSE){
                        $rank = $search_rank;
                        break;
                    }
                    
                }
            }
        }
        return $rank;
    }
}
?>