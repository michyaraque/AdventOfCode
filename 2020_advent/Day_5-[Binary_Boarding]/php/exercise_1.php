<?php

$input = file_get_contents("../input_data.txt");

$arr = explode("\r\n", $input);
$boards = [];

foreach($arr as $board_seat) {
    $board_data = str_replace(['F', 'B', 'L', 'R'], [0, 1, 0, 1], $board_seat);
    $board_data = str_split($board_data, 7);
    $board_seat_id = bindec($board_data[0]) * 8 + bindec($board_data[1]);
    $boards[] = $board_seat_id;
}
echo max($boards);

//Result 801