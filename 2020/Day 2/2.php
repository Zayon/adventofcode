<?php

declare(strict_types=1);

$input = file_get_contents('input');
$passwords = explode("\n", trim($input));

$validPasswords = 0;
foreach ($passwords as $password) {
    [$policy, $password] = explode(':', $password);
    [$positions, $letter] = explode(' ', $policy);
    [$pos1, $pos2] = explode('-', $positions);

    $password = trim($password);
    $pos1letter = substr($password, $pos1 - 1, 1);
    $pos2letter = substr($password, $pos2 - 1, 1);

    if (
        ($pos1letter === $letter && $pos2letter !== $letter) ||
        ($pos1letter !== $letter && $pos2letter === $letter)
    ) {
        $validPasswords++;
    }
}

echo $validPasswords;
