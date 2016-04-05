<?php
class SearchPool extends Pool
{
    public $data = [];
 
    public function process()
    {
        // Run this loop as long as we have
        // jobs in the pool
        
        while (count($this->work)) {
            $this->collect(function (SearchGoogle $job) {
                // If a job was marked as done
                // collect its results
                if ($job->isGarbage()) {
                    $this->data[$job->query] = $job->html;
                }
 
                return $job->isGarbage();
            });
        }
 
        // All jobs are done
        // we can shutdown the pool
        $this->shutdown();
 
        return $this->data;
    }
}

class Searcher extends Worker
{
    public $data = [];
    public function run()
    {
        echo 'Running '.$this->getStacked().' jobs'.PHP_EOL;
    }
    public function addData($data)
    {
        $this->data = array_merge($this->data, [$data]);
    }
}

class SearchGoogle extends Stackable
{
    public function __construct($query)
    {
        $this->query = $query;
    }
 
    public function run()
    {
        echo microtime(true).PHP_EOL;
 
        $this->html = file_get_contents('http://google.fr?q='.$this->query);
        $this->setGarbage();
    }
}

/*
class SearchGoogle extends Thread
{
    public function __construct($query)
    {
        $this->query = $query;
    }
 
    public function run()
    {
        echo microtime(true).PHP_EOL;
        $this->worker->addData(
            file_get_contents('http://google.fr?q='.$this->query)
        );
    }
}
 
// Stack our jobs on our worker
$worker   = new Searcher();
$searches = ['dogs', 'cats', 'birds'];
foreach ($searches as &$search) {
    $search = new SearchGoogle($search);
    $worker->stack($search);
}
 
// Start all jobs
$worker->start();
 
// Join all jobs and close worker
$worker->shutdown();

foreach ($worker->data as $html) {
    echo substr($html, 0, 20).PHP_EOL;
}
*/

$pool = new SearchPool(5, Worker::class);
$pool->submit(new SearchGoogle('cats'));
$pool->submit(new SearchGoogle('dogs'));
$pool->submit(new SearchGoogle('birds'));
$pool->submit(new SearchGoogle('planes'));
$pool->submit(new SearchGoogle('cars'));
 
$data = $pool->process();
var_dump($data);