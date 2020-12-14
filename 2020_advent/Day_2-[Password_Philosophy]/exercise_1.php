<?php

$input = file_get_contents("input_data.txt");

$arr = explode("\r\n", $input);
$correct_passwords = 0;

foreach ($arr as $data) {
    preg_match('/(?<first_position>[\d]+)\-(?<last_position>[\d]+)\s(?<letter>[\w]):\s(?<password>[^\n]+)/', $data, $regex_data);
    $count_char = @array_count_values(str_split($regex_data['password']))[$regex_data['letter']];
    if($count_char >= $regex_data['first_position'] && $count_char <= $regex_data['last_position']) {
        ++$correct_passwords;
    }
}

echo $correct_passwords;

// Result: 474 correct passwords