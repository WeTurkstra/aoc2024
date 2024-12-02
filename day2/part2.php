<?php
$data = file('part1.txt', FILE_IGNORE_NEW_LINES);

$safe = 0;
foreach ($data as $line) {
    $numbers = explode(' ', $line);

    if (isSafeDamped($numbers)) {
        $safe++;
    }
}

echo $safe;

function isSafeDamped($numbers)
{
    if (isSafe($numbers)) {
        return true;
    }

    $numberElements = count($numbers);
    for ($i = 0; $i < $numberElements; $i++) {
        $original = $numbers;
        unset($original[$i]);

        if (isSafe(array_values($original))) {
            return true;
        }
    }

    return false;
}

function isSafe($numbers)
{
    //To check if numers are all increase or decrease sort the array. Nothing should change!
    $original = $numbers;
    sort($original);

    //check if original and sorted numbers are the same
    if ($numbers !== $original && array_reverse($numbers) !== $original) {

        return false;
    }

    $previous = array_shift($numbers);

    foreach ($numbers as $key => $number) {
        $diff = $previous - $number;
        $diff = abs($diff);

        $previous = $number;

        if ($diff < 1 || $diff > 3) {

            return false;
        }
    }

    return true;
}