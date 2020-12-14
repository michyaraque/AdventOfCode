<?php

$input = file_get_contents("input_data.txt");
$arr = explode("\r\n\r\n", $input);

$answers = 0;
foreach($arr as $group) {
    $data = preg_replace(["/\r/", "/\n/"], ['', ' '], $group);
    $data = count_chars($data, 3);
    $answers += strlen(trim($data));
}

echo $answers;

//Result: 6551 answers