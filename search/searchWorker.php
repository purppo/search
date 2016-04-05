<?php
    class searchWorker extends Worker
    {
        static $data = array();
        public function run()
        {
            echo 'Running '.$this->getStacked().' jobs'.PHP_EOL;
        }
        public function addData($site_id,$rank)
        {
            //echo $site_id;
            //echo $rank;
            //echo 'zzz '.$this->getStacked().' jobs'.PHP_EOL;
            echo $site_id."\n";
            self::$data[$site_id] = $rank;
            
            //var_dump($this->data);
        }
        
        static public function getData(){
            echo "Asdasd";
            return self::$data;
        }
    }
?>
