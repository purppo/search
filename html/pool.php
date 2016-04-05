<?php

class MyWork extends Threaded {

    public $name;

    public function __construct($name) {
        echo "Constructing worker $name\n";
        $this->name = $name;
    }

    public function run() {
        echo "Worker $this->name start running\n";
        for ($i = 1; $i <= 5; $i++) {
            echo "Worker $this->name : $i\n";
            sleep(1);
        }
    }

}

class MyWorker extends Worker {
    public function run() {}
}

$pool = new SearchPool(3, \MyWorker::class);
$pool->submit(new MyWork("A"));
$pool->submit(new MyWork("B"));
$pool->submit(new MyWork("C"));
$pool->shutdown();