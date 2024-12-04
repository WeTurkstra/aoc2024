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
    $occurences = [
        [
            ['M', '', 'S'],
            ['', 'A', ''],
            ['M', '', 'S']
        ],
        [
            ['S', '', 'M'],
            ['', 'A', ''],
            ['S', '', 'M']
        ],
        [
            ['M', '', 'M'],
            ['', 'A', ''],
            ['S', '', 'S']
        ],
        [
            ['S', '', 'S'],
            ['', 'A', ''],
            ['M', '', 'M']
        ]
    ];

    $rows = count($data);
    $columns = count($data);
    $count = 0;
    for ($row = 0; $row < $rows - 2 ; $row++) {
        for ($column = 0; $column < $columns - 2; $column++) {
            foreach($occurences as $occurence) {
                if($data[$row][$column] == $occurence[0][0] &&
                    $data[$row][$column + 2] == $occurence[0][2] &&
                    $data[$row + 2][$column] == $occurence[2][0] &&
                    $data[$row + 2][$column + 2] == $occurence[2][2] &&
                    $data[$row + 1][$column + 1] == $occurence[1][1]
                ) {
                    $count++;
                    continue 2;
                }
            }
        }
    }

    return $count;
}
