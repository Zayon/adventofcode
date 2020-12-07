<?php

declare(strict_types=1);

$input = file_get_contents('input');
$rules = explode("\n", trim($input));

function countColorRules(string $color): void
{
    global $rules, $colorsThatCanEventuallyContainAtLeastOneShinyGoldBag;
    $colorRules = preg_grep("/$color/", $rules);

    foreach ($colorRules as $colorRule) {
        [$newColor] = explode(' bags contain ', $colorRule, 2);
        if ($newColor === $color) {
            continue;
        }

        $colorsThatCanEventuallyContainAtLeastOneShinyGoldBag[] = $newColor;
        countColorRules($newColor);
    }
}

$colorsThatCanEventuallyContainAtLeastOneShinyGoldBag = [];

countColorRules('shiny gold');

echo count(array_unique($colorsThatCanEventuallyContainAtLeastOneShinyGoldBag));



