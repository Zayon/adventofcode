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
        $validPassports++;
    }
}

echo $validPassports;
