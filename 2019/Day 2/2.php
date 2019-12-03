<?php

declare(strict_types=1);

$input = file_get_contents('input');
[$first, $second] = explode("\n", trim($input));

$initialMemoryState = $opcodes = explode(',', $first);

for ($noun = 0; $noun <= 99; $noun++) {
    for ($verb = 0;  $verb <= 99; $verb++) {
        $opcodes = $initialMemoryState;

        $opcodes[1] = $noun;
        $opcodes[2] = $verb;

        reset($opcodes);
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

        if ($opcodes[0] == 19690720) {
            echo 100 * $noun + $verb;
            exit();
        }
    }
}

