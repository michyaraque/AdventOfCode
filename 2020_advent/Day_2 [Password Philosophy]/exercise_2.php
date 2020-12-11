<?php

$input = file_get_contents("input_data.txt");

$arr = explode("\r\n", $input);
$correct_passwords = 0;
$i = 0;

foreach ($arr as $data) {
    preg_match('/(?<first_position>[\d]+)\-(?<last_position>[\d]+)\s(?<letter>[\w]):\s(?<password>[^\n]+)/', $data, $regex_data);
    $password_arr = str_split($regex_data['password']);

    if(@$password_arr[$regex_data['first_position'] - 1] == $regex_data['letter'] xor @$password_arr[$regex_data['last_position'] - 1] == $regex_data['letter']) {
        ++$correct_passwords;
    }
}

echo $correct_passwords;

// Result: 745 correct password with the new policy