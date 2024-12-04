<?php
$data = file('part1.txt', FILE_IGNORE_NEW_LINES);

$count = countXmas($data);

echo $count;

/**
 * @param array $data
 * @param $count
 * @return int
 */
function countXmas(array $data)
{
    $directions = [
        [0, 1],  // Right
        [1, 0],  // Down
        [0, -1], // Left
        [-1, 0], // Up
        [1, 1],  // Down-Right Diagonal
        [1, -1], // Down-Left Diagonal
        [-1, -1],// Up-Left Diagonal
        [-1, 1]  // Up-Right Diagonal
    ];

    $rows = count($data);
    $columns = count($data);
    $word = 'XMAS';
    $count = 0;
    for ($row = 0; $row < $rows; $row++) {
        for ($column = 0; $column < $columns; $column++) {
            if($word[0] != $data[$row][$column]){
                continue;
            }
            foreach ($directions as $direction) {
                for ($letter = 0; $letter < strlen($word); $letter++) {
                    $checkableRow = $row + $letter * $direction[0];
                    $checkableColumn = $column + $letter * $direction[1];

                    if ($checkableRow < 0 || $checkableColumn < 0 || $checkableRow >= $rows || $checkableColumn >= $columns || $data[$checkableRow][$checkableColumn] != $word[$letter]) {
                        continue 2;
                    }
                }
                $count ++;
            }
        }
    }

    return $count;
}