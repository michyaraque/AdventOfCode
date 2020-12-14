<?php

$input = file_get_contents("input_data.txt");

$arr = explode("\r\n", $input);
$input_lenght = strlen($arr[0]);
$input_counter = count($arr);
$actual_position = [0, 0];
$finish_counter = false;
$trees = 0;
$i = 0;

while(!$finish_counter) {
    $actual_position = [$actual_position[0] + 3, $actual_position[1] + 1];
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
echo "Total trees: ".$trees;

// Result: 211 trees