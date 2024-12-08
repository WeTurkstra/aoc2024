<?php
$data = file('part1.txt', FILE_IGNORE_NEW_LINES);
$data = array_chunk($data, 1177);
$ordering = $data[0];
array_pop($ordering);
$ordering = parseOrdering($ordering);
$updates = parseUpdates($data[1]);

$sum = 0;

foreach ($updates as $update) {
    $original_update = $update;
    $isValid = true;
    for ($i = 1; $i < count($update); $i++) {
        if (!isset($ordering[$update[$i]])) {
            continue;
        }
        for ($j = 0; $j <= $i; $j++) {
            if( isset($ordering[$update[$i]][$update[$j]])) {
                $tmp = $update[$j];
                $update[$j] = $update[$i];
                $update[$i] = $tmp;
                $i = 1;
                $isValid = false;
                break;
            }
        }
    }

    if(!$isValid) {

        $count = floor(count($update) / 2);
        $sum += $update[$count];
    }
}

echo $sum;


function parseOrdering($ordering)
{
    $data = [];
    foreach ($ordering as $value) {
        $parts = explode('|', $value);
        $data[$parts[0]][$parts[1]] = true;
    }


    return $data;
}

function parseUpdates($ordering)
{
    $data = [];
    foreach ($ordering as $value) {
        $data[] = explode(',', $value);
    }

    return $data;
}