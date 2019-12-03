<?php

$content = file_get_contents('input');
$ids = explode("\n", trim($content));
sort($ids);

$currentId = $ids[0];
$diffIndex = 0;
$currentIdChars = str_split($currentId);

for ($i=0; $i < count($ids)-1; $i++) {
    $nextId = $ids[$i+1];
    $diffs = 0;
    $nextIdChars = str_split($nextId);

    for ($j=0; $j < count($currentIdChars); $j++) {
        if ($currentIdChars[$j] !== $nextIdChars[$j]) {
            $diffs++;

            if ($diffs > 1) {
                break;
            }

            $diffIndex=$j;
        }
    }

    if ($diffs === 1) {
        unset($currentIdChars[$diffIndex]);
        echo implode('', $currentIdChars);

        die();
    }

    $currentId = $nextId;
    $currentIdChars = $nextIdChars;
}
