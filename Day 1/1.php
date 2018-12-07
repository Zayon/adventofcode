<?php

$i = 0;

$content = file_get_contents('input');
$changes = explode("\n", $content);

foreach ($changes as $change) {
    $i += $change;
}

echo $i;
