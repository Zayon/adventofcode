<?php

$content = file_get_contents('input');
$ids = explode("\n", $content);
$doubles = $triples = 0;

foreach ($ids as $id) {
    if (!$id) break;
    $has2 = $has3 = false;
    $chars = [];

    foreach(str_split($id) as $char) {
        if (in_array($char, $chars)) {
            continue;
        }
        $chars[] = $char;
        $count = substr_count($id, $char);

        if (!$has2 && $count === 2) {
            echo "$id has 2 $char".PHP_EOL;

            $has2 = true;
            $doubles++;
        }

        if (!$has3 && $count === 3) {
            echo "$id has 3 $char".PHP_EOL;
            $has3 = true;
            $triples++;
        }

        if ($has2 && $has3) break;
    }
}

echo "$doubles doubles\n";
echo "$triples triples\n";

echo PHP_EOL.'Checksum : '.$doubles*$triples;

