<?php

declare(strict_types=1);

$input = file_get_contents('input');

[$rules, $myTicket, $nearbyTickets] = explode("\n\n", $input);

$rules = explode("\n", $rules);
[,$myTicket] = explode("\n", $myTicket);
$myTicket = explode(',', $myTicket);
$nearbyTickets = explode("\n", $nearbyTickets);
array_shift($nearbyTickets);

$length = count($myTicket);

$tmpRules = [];
foreach ($rules as $rule) {
    preg_match('/([\w ]+): ([\d\-]+) or ([\d\-]+)/', $rule, $matches);

    $ruleName = $matches[1];
    [$start1, $end1] = explode('-', $matches[2]);
    [$start2, $end2] = explode('-', $matches[3]);

    $tmpRules[$ruleName] = array_merge(range($start1, $end1), range($start2, $end2));
}

$rules = $tmpRules;

$validTickets = [$myTicket];

foreach ($nearbyTickets as $nearbyTicket) {
    $invalid = false;

    foreach (explode(',', $nearbyTicket) as $value) {
        foreach ($rules as $ruleName => $range) {
            if (in_array($value, $range)) {
                continue 2;
            }
        }

        $invalid = true;
        break;
    }

    if (!$invalid) {
        $validTickets[] = explode(',', $nearbyTicket);
    }
}

$possibleRules = [];

for ($i = 0; $i < $length; $i++) {
    $possibleRules[$i] = [];
    $values = array_column($validTickets, $i);

    foreach ($rules as $ruleName => $range) {
        $result = array_filter($values, fn ($e) => in_array($e, $range));

        $countResult = count($result);
        $countValues = count($values);

        if ($countResult === $countValues) {
            $possibleRules[$i][] = $ruleName;
        }
    }
}

$actualRules = [];

do {
    for ($i = 0; $i < $length; $i++) {
        $count = count($possibleRules[$i]);

        if ($count === 1) {
            $ruleName = current($possibleRules[$i]);
            echo "${i}th value must be $ruleName\n";
            $actualRules[$ruleName] = $i;
            removeRule($ruleName);
        }
    }
} while (count($actualRules) !== count($rules));

$valuesOfDeparturesFields = [];

foreach ($rules as $ruleName => $range) {
    if (!str_starts_with($ruleName, 'departure')) {
        continue;
    }

    $valuesOfDeparturesFields[] = $myTicket[$actualRules[$ruleName]];
}

echo array_product($valuesOfDeparturesFields);

function removeRule($ruleName): void
{
    global $possibleRules;

    foreach ($possibleRules as $i => $rule) {
        if (($key = array_search($ruleName, $rule)) !== false) {
            unset($possibleRules[$i][$key]);
        }
    }
}
