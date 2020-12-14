<?php

$input = file_get_contents("input_data.txt");

$arr = explode("\r\n", $input);
$airplane = array_fill(0, 127, array_fill(0, 8, "."));

foreach($arr as $board_seat) {
    $board_data = str_replace(['F', 'B', 'L', 'R'], [0, 1, 0, 1], $board_seat);
    $board_data = str_split($board_data, 7);
    $board_seat_row = bindec($board_data[0]);
    $board_seat_col = bindec($board_data[1]);
    $airplane[$board_seat_row][$board_seat_col] = "#";
}

$row = 0;
$col = 0;

for($i = 0; $i <= 127 * 8; ++$i) {

    if(@$airplane[$row][$col] !== "#" && $row >= 10 && $row <= 80 && $col !== 8) {
        $seat_id = $row * 8 + $col;
        echo "[AVAILABLE SEAT]: [Row: $row | Col: $col >> Seat ID: $seat_id]";
    };
    if($row % 127 == 0) {
        $row = 0;
        ++$col;
    }
    ++$row;
}

//Result 597