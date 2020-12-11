<?php

$input = file_get_contents("input_data.txt");

$input_values = explode("\r\n", $input);
$counter = count($input_values);
$values = [];

for($i = 0; $i <= $counter; $i++) {
    $values[$input_values[$i]] = true;
    $find = 2020 - $input_values[$i];
    if(@$values[$find]) {
        echo $input_values[$i] * $find;
        exit;
    }
}

// Result: 259716