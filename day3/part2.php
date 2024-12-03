<?php
$data = file('part1.txt', FILE_IGNORE_NEW_LINES);
$data = implode("", $data);

$explode = explode("don't()", $data);
var_dump(count($explode));
$sum = parseDoableLines($explode[0]);
unset($explode[0]);
foreach($explode as $line) {
    $parts = explode('do()', $line);
    for ($i = 1; $i < count($parts); $i++) {
           $sum += parseDoableLines($parts[$i]);

    }

}

echo $sum;


function parseDoableLines($line)
{
    preg_match_all("/mul\((\d*),(\d*)\)/", $line, $matches);

    $sum = 0;
    for ($i = 0; $i < count($matches[1]); $i++) {
        $sum += $matches[1][$i] * $matches[2][$i];
    }

    return $sum;
}