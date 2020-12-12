<?php

declare(strict_types=1);

$input = file_get_contents('input');
$passwords = explode("\n", trim($input));

$validPasswords = 0;
foreach ($passwords as $password) {
    [$policy, $password] = explode(':', $password);
    [$range, $letter] = explode(' ', $policy);
    [$min, $max] = explode('-', $range);

    $count = substr_count($password, $letter);

    if ($count >= $min && $count <= $max) {
        $validPasswords++;
    }
}

echo $validPasswords;
