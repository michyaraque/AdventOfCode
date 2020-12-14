<?php

function structureLine($line_lenght, $value) {
    $counter_value = strlen($value);
    $value_line = $value . str_repeat(" ", $line_lenght - $counter_value) . "│";
    return $value_line;
}

$passport_card = "
┌─────────────────────────────────┐
│ Passport ID: %s
│ Country ID: %s
│ ─────────────────               │
│ ┌─────┐   │ Birthday: %s
│ │     │   │ Height: %s
│ │     │   │ Hair Color: %s
│ └─────┘   │ Eye Color: %s
│ Issue: %s
│ Exp: %s
│                                 │
│          %s
└─────────────────────────────────┘";

$input = file_get_contents("input_data.txt");
$arr = explode("\r\n\r\n", $input);

$passport_fields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid', 'cid'];
$valid_passports = 0;
$i = 0;
foreach($arr as $passport) {
    $passport_data = preg_replace(["/\r/", "/\n/"], ['', ' '], $passport);
    $passport_data = explode(' ', $passport_data);

    foreach($passport_data as $valid_fields) {
        list($name, $value) = explode(':', $valid_fields);
        $field_pair[$name] = $value;
        $fields_counter = count($passport_data);
        if($fields_counter == $i + 1) {
            
            if($fields_counter == 7 && empty($field_pair['cid']) || $fields_counter == 8) {
                ++$valid_passports;
                $is_aproved = true;
            } else {
                $is_aproved = false;
            }

            echo sprintf($passport_card, 
            structureLine(19, (!empty($field_pair['pid']) ? $field_pair['pid'] : "MISSING")), 
            structureLine(20, (!empty($field_pair['cid']) ? $field_pair['cid'] : "MISSING")), 
            structureLine(10, (!empty($field_pair['byr']) ? $field_pair['byr'] : "MISSING")), 
            structureLine(12, (!empty($field_pair['hgt']) ? $field_pair['hgt'] : "MISSING")), 
            structureLine(8, (!empty($field_pair['hcl']) ? $field_pair['hcl'] : "MISSING")), 
            structureLine(9, (!empty($field_pair['eyr']) ? $field_pair['eyr'] : "MISSING")), 
            structureLine(25, (!empty($field_pair['iyr']) ? $field_pair['iyr'] : "MISSING")), 
            structureLine(27, (!empty($field_pair['eyr']) ? $field_pair['eyr'] : "MISSING")),
            structureLine(24, ($is_aproved ? '✅ APROVED' : '❌ NOT APROVED')))."\n";
            unset($field_pair);
            $i = 0;
        } else {
            ++$i;
        }
    }
}
echo $valid_passports;

//result 254 WITH card ascii lookup