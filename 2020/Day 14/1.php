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
    $memory[$address] = applyMask($value, $mask);
}

echo array_sum($memory);

function applyMask($value, $mask): int
{
    $binaryArray = str_split(str_pad(decbin($value), 36, '0', STR_PAD_LEFT));

    foreach (str_split($mask) as $bit => $bitMaskValue) {
        if ($bitMaskValue === 'X') {
            continue;
        }

        $binaryArray[$bit] = $bitMaskValue;
    }

    return bindec(implode('', $binaryArray));
}
