<?php

$input = file_get_contents("input_data.txt");

function countBiomeTrees(int $x, int $y, string $input): int {
    $arr = explode("\r\n", $input);
    $input_lenght = strlen($arr[0]);
    $input_counter = count($arr);
    $actual_position = [0, 0];
    $finish_counter = false;
    $trees = 0;

    while(!$finish_counter) {
        $actual_position = [$actual_position[0] + $x, $actual_position[1] + $y];
        if(empty($arr[$actual_position[1]])) {
            $finish_counter = true;
        }
        if(!$finish_counter) {
            $split_line = str_split(@$arr[$actual_position[1] % $input_counter]);
            if(@$split_line[$actual_position[0] % $input_lenght] == '#') {
                ++$trees;
            }
        }
    }
    return $trees;
}

echo "Total trees: ".countBiomeTrees(1, 1, $input) * countBiomeTrees(3, 1, $input) * countBiomeTrees(5, 1, $input) * countBiomeTrees(7, 1, $input) * countBiomeTrees(1, 2, $input);

// Result: 3584591857 total of multiplied trees