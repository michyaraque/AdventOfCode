<?php

$input = file_get_contents("input_data.txt");

$input_values = explode("\r\n", $input);

foreach($input_values as $numA) {
    foreach($input_values as $numB) {
        foreach($input_values as $numC) {
            if($numA+$numB+$numC == 2020) {
                echo $numA*$numB*$numC;
                exit;
            }
        }
    }
}

// Result: 120637440