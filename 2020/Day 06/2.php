<?php

declare(strict_types=1);

$input = file_get_contents('input');
$groups = explode("\n\n", trim($input));
$sum = 0;

foreach ($groups as $group) {
    $answers = explode("\n", trim($group));

    if (count($answers) === 1) {
        $sum += strlen($answers[0]);
        continue;
    }

    $answersAsArray = array_map(function ($answer) {
        return str_split($answer);
    }, $answers);

    $sum += count(array_intersect(...$answersAsArray));
}

echo $sum;
