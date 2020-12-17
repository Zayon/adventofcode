<?php

declare(strict_types=1);

$input = file_get_contents('input');

[$rules, $myTicket, $nearbyTickets] = explode("\n\n", $input);

$rules = explode("\n", $rules);
[,$myTicket] = explode("\n", $myTicket);
$nearbyTickets = explode("\n", $nearbyTickets);
array_shift($nearbyTickets);

$tmpRules = [];
foreach ($rules as $rule) {
    preg_match('/(\w+): ([\d\-]+) or ([\d\-]+)/', $rule, $matches);

    $ruleName = $matches[1];
    [$start1, $end1] = explode('-', $matches[2]);
    [$start2, $end2] = explode('-', $matches[3]);

    $tmpRules[$ruleName] = array_merge(range($start1, $end1), range($start2, $end2));
}

$rules = $tmpRules;

$invalidValues = [];

foreach ($nearbyTickets as $nearbyTicket) {
    foreach (explode(',', $nearbyTicket) as $value) {
        foreach ($rules as $ruleName => $range) {
            if (in_array($value, $range)) {
                continue 2;
            }
        }

        $invalidValues[] = $value;
    }
}

echo array_sum($invalidValues).PHP_EOL;
