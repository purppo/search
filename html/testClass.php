<?php
class SearchGoogle extends Thread
{
    public function __construct($query)
    {
        $this->query = $query;
    }
 
    public function run()
    {
        echo microtime(true).PHP_EOL;
        $this->html = file_get_contents('http://google.fr?q='.$this->query);
    }
}