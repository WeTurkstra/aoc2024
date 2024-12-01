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
foreach($left as $key => $value) {
    $sum += abs($left[$key] - $right[$key]);
}

echo $sum;
