<?php

$arr = [2,4,-9];
unset($arr[1]);
var_dump($arr);
$arr = array_values($arr);
var_dump($arr);


