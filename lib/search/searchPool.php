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
        //$this->shutdown();
 
        return $this->data;
    }
    
    
    public function addData($data)
    {
        echo 'Pool '.PHP_EOL;
        $this->data = $data;
    }
    
    public function getData()
    {
        return self::data;
    }
    
}
?>