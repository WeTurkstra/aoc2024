<?php
$data = file('part1.txt', FILE_IGNORE_NEW_LINES);

$left = [];
$right = [];
foreach ($data as $line) {
    $parts = explode('   ', $line);
    $left[] = $parts[0];
    $right[] = $parts[1];
}
sort($left);
sort($right);

$sum = 0;
foreach($left as $leftValue) {
    $count = 0;
    foreach($right as $rightValue) {
        if($leftValue == $rightValue) {
            $count++;
        }
    }
    $sum += ($leftValue * $count);
}


echo $sum;
