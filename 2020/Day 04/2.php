<?php

declare(strict_types=1);

$input = file_get_contents('input');
$passports = explode("\n\n", trim($input));

$keys = [
    'byr',
    'iyr',
    'eyr',
    'hgt',
    'hcl',
    'ecl',
    'pid',
//    'cid',
];

$validPassports = 0;

foreach ($passports as $passport) {
    $numberOfValidKeys = 0;
    $keyValuePairs = preg_split('/\s/', $passport);

    foreach ($keyValuePairs as $keyValuePair) {
        [$key, $value] = explode(':', $keyValuePair);
        if (in_array($key, $keys, true)) {
            $numberOfValidKeys++;
        }
    }

    if ($numberOfValidKeys === 7) {
        foreach ($keyValuePairs as $keyValuePair) {
            [$key, $value] = explode(':', $keyValuePair);
            if (in_array($key, $keys, true)) {
                switch ($key) {
                    case 'byr':
                        // (Birth Year) - four digits; at least 1920 and at most 2002.
                        if ($value < 1920 || $value > 2020) {
                            continue 3;
                        }
                        break;
                    case 'iyr':
                        // (Issue Year) - four digits; at least 2010 and at most 2020.
                        if ($value < 2010 || $value > 2020) {
                            continue 3;
                        }
                        break;
                    case 'eyr':
                        // (Expiration Year) - four digits; at least 2020 and at most 2030.
                        if ($value < 2020 || $value > 2030) {
                            continue 3;
                        }
                        break;
                    case 'hgt':
                        // (Height) - a number followed by either cm or in:
                        $unit = substr($value, -2);
                        $value = rtrim($value, 'cmin');
                        if ($unit === 'cm') { // if cm, the number must be at least 150 and at most 193.
                            if ($value < 150 || $value > 193) {
                                continue 3;
                            }
                        } elseif ($unit === 'in') { // if in, the number must be at least 59 and at most 76.
                            if ($value < 59 || $value > 76) {
                                continue 3;
                            }
                        } else {
                            continue 3;
                        }
                        break;
                    case 'hcl':
                        // (Hair Color) - a # followed by exactly six characters 0-9 or a-f.
                        if (!preg_match('/#[0-9a-f]{6}/', $value)) {
                            continue 3;
                        }
                        break;
                    case 'ecl':
                        // (Eye Color) - exactly one of: amb blu brn gry grn hzl oth.
                        if (!in_array($value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'])) {
                            continue 3;
                        }
                        break;
                    case 'pid':
                        // (Passport ID) - a nine-digit number, including leading zeroes.
                        if (!is_numeric($value) || strlen($value) !== 9) {
                            continue 3;
                        }
                        break;
                }
            }
        }
        $validPassports++;
    }
}

echo $validPassports;
