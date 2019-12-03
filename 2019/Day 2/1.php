<?php

declare(strict_types=1);

$input = file_get_contents('input');
[$first, $second] = explode("\n", trim($input));

$opcodes = explode(',', $first);

$opcodes[1] = 12;
$opcodes[2] = 2;

$opcode = current($opcodes);

do {
    switch ($opcode) {
        case 1:
            $firstOperandPosition = next($opcodes);
            $secondOperandPosition = next($opcodes);
            $resultPosition = next($opcodes);

            $opcodes[$resultPosition] = $opcodes[$firstOperandPosition] + $opcodes[$secondOperandPosition];
            break;
        case 2:
            $firstOperandPosition = next($opcodes);
            $secondOperandPosition = next($opcodes);
            $resultPosition = next($opcodes);

            $opcodes[$resultPosition] = $opcodes[$firstOperandPosition] * $opcodes[$secondOperandPosition];
            break;
        case 99:
            break 2;
        default:
            throw new \RuntimeException("Something went wrong. Unexpected value $opcode");
    }

    $opcode = next($opcodes);
} while (true);

echo $opcodes[0];

