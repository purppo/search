<?php
include 'testClass.php';
$searches = ['cats', 'dogs', 'birds'];
foreach ($searches as &$search) {
    $search = new SearchGoogle($search);
    $search->start();
    $search->join();
    echo substr($search->html, 0, 20);
}
 
foreach ($searches as $search) {
    
}