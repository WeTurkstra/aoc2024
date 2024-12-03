<?php
$data = file('part1.txt', FILE_IGNORE_NEW_LINES);
$data = implode("", $data);

preg_match_all("/mul\((\d*),(\d*)\)/", $data, $matches);

$sum = 0;
for ($i = 0; $i < count($matches[1]); $i++) {
    var_dump($i);
    var_dump( $matches[1][$i] * $matches[2][$i]);
    $sum += $matches[1][$i] * $matches[2][$i];
}

echo $sum;