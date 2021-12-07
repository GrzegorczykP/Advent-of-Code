<?php
require_once __DIR__ . '/base/init.php';

$assigment = new Assignments\Day2();
$result = $assigment->run();

echo 'Task 1: ' . $result[0] . '<br>';
echo 'Task 2: ' . $result[1];