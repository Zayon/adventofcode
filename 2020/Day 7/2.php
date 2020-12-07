<?php

declare(strict_types=1);

$input = file_get_contents('input');
$rules = explode("\n", trim($input));

echo countBagsForColor('shiny gold');

function countBagsForColor(string $color): int
{
    global $rules;
    $count = 0;
    $colorRule = current(preg_grep("/^$color/", $rules));

    [, $requiredBags] = explode(' bags contain ', $colorRule, 2);
    $requiredBags = explode(', ', $requiredBags);

    foreach ($requiredBags as $requiredBag) {
        preg_match('/(\d+) (.*) bag/', $requiredBag,$matches);

        if ($matches === false || $matches === []) {
            // Contains no other bags
            return 0;
        }

        [, $number, $subColor] = $matches;
        $count += $number + $number * countBagsForColor($subColor);
    }

    echo "$color contains $count bags\n";
}
