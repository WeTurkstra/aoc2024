<?php
$data = file('part1.txt', FILE_IGNORE_NEW_LINES);
$map = parseMap($data);

$count = 0;
for ($x = 0; $x < count($map); $x++) {
    for ($y = 0; $y < count($map[$x]); $y++) {
        if ($map[$x][$y] == '.') {
            $copyMap = $map;

            $copyMap[$x][$y] = '#';
            if(run($copyMap)) {
                $count++;
            }
        }
        echo ($x + 1) * ($y + 1) . "\n";
    }

}

echo $count;

function run(array $pMap)
{
    $map = $pMap;
    $position = findStart($map);

    $directions = [
        [0, 1],  // Right
        [1, 0],  // Down
        [0, -1], // Left
        [-1, 0], // Up
    ];

    $visitedPositions = [];

    $currentDirection = 3;
    $moves = 0;
    while (!outOfBounds($map, $position) ) {
        $nextPosition = [$position[0] + $directions[$currentDirection][0], $position[1] + $directions[$currentDirection][1]];
        if(array_search([$nextPosition[0], $nextPosition[1], $currentDirection], $visitedPositions) !== false) {
            return true;
        }

        if (outOfBounds($map, $nextPosition)) {
            break;
        }
        if ($map[$nextPosition[0]][$nextPosition[1]] == '#') {
            //rotate
            $currentDirection = getNextDirection($currentDirection);
        } else {
            //move
            if ($map[$nextPosition[0]][$nextPosition[1]] != 'X') {
                $visitedPositions[] = [$nextPosition[0], $nextPosition[1], $currentDirection];
                $moves++;
            }
            $map[$nextPosition[0]][$nextPosition[1]] = 'X';
            $position = $nextPosition;
        }
    }
    return false;
}

function parseMap($data)
{
    $map = [];
    foreach ($data as $line) {
        $map[] = str_split($line);
    }

    return $map;
}

function findStart($map)
{
    for ($x = 0; $x < count($map); $x++) {
        for ($y = 0; $y < count($map[$x]); $y++) {
            if ($map[$x][$y] == '^') {
                return [$x, $y];
            }
        }
    }
    return false;
}

function outOfBounds($map, $position) {
    return $position[0] < 0 || $position[1] < 0 || $position[0] >= count($map)  || $position[1] >= count($map[0]);
}

function getNextDirection($currentDirection){
    if($currentDirection == 3) {
        return 0;
    }
    return $currentDirection+1;
}