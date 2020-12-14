<?php

declare(strict_types=1);

$input = file_get_contents('input');
$instructions = explode("\n", trim($input));
$mask = null;
$memory = [];

foreach ($instructions as $instruction) {
    [$action, $value] = explode(' = ', $instruction);

    if ($action === 'mask') {
        $mask = $value;
        continue;
    }

    preg_match('/mem\[(\d+)]/', $action, $matches);
    $address = $matches[1];

    $addresses = findAddresses($address, $mask);

    foreach ($addresses as $address) {
        $memory[$address] = $value;
    }
}

echo array_sum($memory);

function findAddresses($address, $mask): array
{
    $binaryArray = str_split(str_pad(decbin($address), 36, '0', STR_PAD_LEFT));

    foreach (str_split($mask) as $bit => $bitMaskValue) {
        if ($bitMaskValue === '0') {
            continue;
        }

        $binaryArray[$bit] = $bitMaskValue;
    }

    $combinations = generateCombinations(implode('', $binaryArray));

    return array_map(fn($combination) => bindec($combination), $combinations);
}

function generateCombinations(string $binary): array
{
    $combinations = [];
    $split = explode('X', $binary, 2);

    if (count($split) === 1) {
        return [$binary];
    }

    foreach ([0, 1] as $bit) {
        $combination = $split[0].$bit.$split[1];
        $insideCombinations = generateCombinations($combination);

        array_push($combinations, ...$insideCombinations);
    }

    return $combinations;
}
