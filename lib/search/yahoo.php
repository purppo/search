<?php

class yahoo extends Thread
{
    public $url = 'https://www.google.co.jp/search?q=';
    public function __construct($query,$host)
    {
        $this->query = $query;
        $this->host = $host;
    }
 
    public function run()
    {
        //echo 'phantomjs '.dirname(__FILE__).'/getHtml.js '.escapeshellarg($this->url.urlencode($this->query)).PHP_EOL;
        $this->html = shell_exec('phantomjs '.dirname(__FILE__).'/getHtml.js '.escapeshellarg($this->url.urlencode($this->query)));
        
        /*
        $this->worker->addData(
        );
        
        $this->html = file_get_contents('http://google.fr?q='.$this->query);
         */
    }
}
?>