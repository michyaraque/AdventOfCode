<?php

$input = file_get_contents("input_data.txt");

$arr = explode("\r\n", $input);

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}
$bag_colors = 0;

$structure = [
    'light red' => ['bright white' => 1, 'muted yellow' => 2],
    'dark orange' => ['bright white' => 3, 'muted yellow' => 4],
    'bright white' => ['shiny gold', 1],
    'muted yellow' => ['shiny gold' => 2, 'faded blue' => 9],
    'shiny gold' => ['dark olive' => 1, 'vibrant plum' => 2],
    'dark olive' => ['faded blue' => 3, 'dotted black' => 4],
    'vibrant plum' => ['faded blue' => 5, 'dotted black' => 6],
    'faded blue' => [],
    'dotted black' => []
];

$pattern = "/(?<first_bag>[\w]+\s[\w]+)\sbag(?:s)?\scontain\s(?:(?<no_bag>no other bag(?:s)?))?(?:(?<second_bag_num>[\d]+)\s(?<second_bag>[^\.,]+)\sbag(?:s)?(?:(?:[.,]\s)?(?<third_bag_num>[\d]+)\s(?<third_bag>[^\.,]+)\sbag(?:s)?)?(?:[,.\s]+(?<fourth_bag_num>[\d]+)\s(?<fourth_bag>[\w\s]+)\sbag(?:s)?)?(?:[,\s]+(?<fifth_bag_num>[\d]+)\s(?<fifth_bag>[\w\s]+)\sbag(?:s)?)?)?/";

function emptyFilter($var){
    return ($var !== NULL && $var !== FALSE && $var !== "");
}

// Filtering the array

foreach($arr as $luggage) {
    preg_match($pattern, $luggage, $data);
    $new_structure[] = [
        $data['first_bag'] ?? "" => $data['first_bag_num'] ?? 1, 
        $data['second_bag'] ?? "" => $data['second_bag_num'] ?? 1, 
        $data['third_bag'] ?? "" => $data['third_bag_num'] ?? 1, 
        $data['fourth_bag'] ?? "" => $data['fourth_bag_num'] ?? 1, 
        $data['fifth_bag'] ?? "" => $data['fifth_bag_num'] ?? 1
    ];
    
    /*if(array_intersect($new_structure, ['shiny gold'])) {
        ++$bag_colors;
    }*/
}
$test = array_values(array_filter(array_map('array_filter', $new_structure)));
    echo json_encode($test)."\n";
