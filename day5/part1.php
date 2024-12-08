<?php
$data = file('part1.txt', FILE_IGNORE_NEW_LINES);
$data = array_chunk($data, 1178);
$ordering = $data[0];
array_pop($ordering);
$ordering = parseOrdering($ordering);
$updates = parseUpdates($data[1]);

$sum = 0;

foreach ($updates as $update) {
    $applicableOrders = [];
    //find applicable orderings
    foreach ($ordering as $order) {
        if (!array_diff($order, $update)) {
            $applicableOrders[$order[0]][] = $order;
        }
    }

    $isOk = true;
    //test order of orderings
    foreach ($update as $key => $page) {
        if (!isset($applicableOrders[$page])) {
            continue;
        }

        foreach ($applicableOrders[$page] as $order) {
            $testableKey = array_search($order[1], $update);
            var_dump($key);
            var_dump($testableKey);
            if ($testableKey > $key) {
                continue;
            }
            $isOk = false;
        }

    }

    if ($isOk) {

        $count = floor(count($update) / 2);
        $sum += $update[$count];
    }
}

echo $sum;

function parseOrdering($ordering)
{
    $data = [];
    foreach ($ordering as $value) {
        $data[] = explode('|', $value);
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