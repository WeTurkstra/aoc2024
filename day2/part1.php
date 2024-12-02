<?php
$data = file('part1.txt', FILE_IGNORE_NEW_LINES);

$safe = 0;
foreach ($data as $line) {
    $numbers = explode(' ', $line);

    if(isSafe($numbers)) {
        $safe++;
    }

}

echo $safe;

function isSafe($numbers)
{
    //To check if numers are all increase or decrease sort the array. Nothing should change!
    $original = $numbers;
    sort($original);
    //check if original and sorted numbers are the same
    if($numbers !== $original && array_reverse($numbers) !== $original) {
        return false;
    }

    $previous = array_shift($numbers);
    foreach ($numbers as $number) {
        $diff = $previous - $number;
        $diff = abs($diff);

        $previous = $number;

        if($diff < 1 || $diff > 3) {
            return false;
        }
    }

    return true;
}