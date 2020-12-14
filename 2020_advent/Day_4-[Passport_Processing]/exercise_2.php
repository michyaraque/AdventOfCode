<?php


function structureLine(int $line_lenght, string $value): string {
    $counter_value = strlen($value);
    $value_line = $value . str_repeat(" ", $line_lenght - $counter_value) . "│";
    return $value_line;
}

function validatePassport(array $data) {
    $validation_counter = 0;

    if(!empty($data['byr']) && $data['byr'] <= 2002 && $data['byr'] >= 1920) {
        ++$validation_counter;
    }

    if(!empty($data['iyr']) && $data['iyr'] >= 2010 && $data['iyr'] <= 2020) {
        ++$validation_counter;
    }

    if(!empty($data['eyr']) && $data['eyr'] >= 2020 && $data['eyr'] <= 2030) {
        ++$validation_counter;
    }

    if(!empty($data['hgt']) && preg_match('/([\d]+)([A-Za-z]+)/', $data['hgt'], $height_values)) {
        if($height_values[2] == 'in' && $height_values[1] >= 59 && $height_values[1] <= 76 || $height_values[2] == 'cm' && $height_values[1] >= 150 && $height_values[1] <= 193) {
            ++$validation_counter;
        } 
    }
    if(!empty($data['hcl']) && preg_match('/\#([0-9A-F]+){3}([A-F0-9]+){3}/i', $data['hcl'])) {
        ++$validation_counter;
    }

    if(!empty($data['ecl']) && count(array_intersect(['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'], [$data['ecl']])) == 1) {
        ++$validation_counter;
    }
    
    if(!empty($data['pid']) && strlen($data['pid']) == 9) {
        ++$validation_counter;
    }

    return ($validation_counter == 7 ? true : false);
}

$passport_card = "
┌─────────────────────────────────┐
│ Passport ID: %s
│ Country ID: %s
│ ─────────────────────────────── │
│ ┌─────┐   │ Birthday: %s
│ │%s│   │ Height: %s
│ │     │   │ Hair Color: %s
│ └─────┘   │ Eye Color: %s
│ Issue: %s
│ Exp: %s
│ ─────────────────────────────── │
│          %s
└─────────────────────────────────┘";

$input = file_get_contents("input_data.txt");
$arr = explode("\r\n\r\n", $input);
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
            
            if($fields_counter == 7 && empty($field_pair['cid']) && validatePassport($field_pair) || $fields_counter == 8 && validatePassport($field_pair)) {
                ++$valid_passports;
                $is_aproved = true;
            } else {
                $is_aproved = false;
            }
            echo sprintf($passport_card, 
            structureLine(19, (!empty($field_pair['pid']) ? $field_pair['pid'] : "MISSING")), 
            structureLine(20, (!empty($field_pair['cid']) ? $field_pair['cid'] : "MISSING")), 
            structureLine(10, (!empty($field_pair['byr']) ? $field_pair['byr'] : "MISSING")), 
            ($is_aproved ? " ʘ‿ʘ " : " ಥ﹏ಥ"), 
            structureLine(12, (!empty($field_pair['hgt']) ? $field_pair['hgt'] : "MISSING")), 
            structureLine(8, (!empty($field_pair['hcl']) ? $field_pair['hcl'] : "MISSING")), 
            structureLine(9, (!empty($field_pair['ecl']) ? @$field_pair['ecl'] : "MISSING")), 
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

//result 184 WITH card ascii lookup