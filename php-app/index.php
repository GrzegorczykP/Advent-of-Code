<?php
require_once __DIR__ . '/vendor/autoload.php';

$assigment = new App2022\Assignments\Day8(true);
$result = $assigment->run();

echo 'Task 1: ' . $result[0] . '<br>';
echo 'Task 2: ' . $result[1];
