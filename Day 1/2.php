<?php

$i = 0;
$freqs = [$i];
$content = file_get_contents('input');
$changes = explode("\n", $content);

while (true) {
    foreach ($changes as $change) {
        $i += $change;

        if (in_array($i, $freqs)) {
            echo $i;
            break 2;
        }

        $freqs[] = $i;
    }
}
