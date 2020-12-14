<?php

$input = file_get_contents("input_data.txt");
$arr = explode("\r\n\r\n", $input);
$correct = 0;

foreach($arr as $group) {
    $data = preg_replace(["/\r/", "/\n/"], ['', ' '], $group);
    $data_split = str_split($data, 1);
    $data = explode(" ", $data);
    $count_groups = count($data);

    if($count_groups == 1) {
        $correct += strlen(trim($group));
    }

    $count_chars = array_count_values($data_split);

    foreach($count_chars as $i => $splitvalues) {
        if($splitvalues == $count_groups && $count_groups !== 1) {
            ++$correct;
        }
    }
}
echo $correct;

//Result: 3358 answers