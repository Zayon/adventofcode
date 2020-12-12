<?php

declare(strict_types=1);

$input = file_get_contents('input');
$instructions = explode("\n", trim($input));

$variants = [];
$end = count($instructions);

do {
    $i=0;
    $inAVariant = false;
    $accumulator = 0;
    $executedInstructions = [];

    while (!in_array($i, $executedInstructions, true)) {
        if ($i === $end) {
            break 2;
        }

        $executedInstructions[] = $i;
        $instruction = $instructions[$i];

        [$operation, $argument] = explode(' ', $instruction);

        if (!$inAVariant && in_array($operation, ['jmp', 'nop']) && !in_array($i, $variants)) {
            $variants[] = $i;
            $inAVariant = true;

            $operation = $operation === 'nop' ? 'jmp' : 'nop';
        }

        if ($operation === 'jmp') {
            $i += $argument;
            continue;
        }

        if ($operation === 'acc') {
            $accumulator += $argument;
        }

        $i++;
    }

    echo "infinite loop detected\n";
} while (true);

echo $accumulator;
