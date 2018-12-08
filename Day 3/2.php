<?php

$input = file_get_contents('input');
$claims = explode("\n", trim($input));

$fabric = [];
$overlaps = [];

foreach ($claims as $claim) {
    [$id, $_, $position, $size] = str_getcsv($claim, ' ');

    [$x, $y] = explode(',', trim($position, ':'));
    [$w, $h] = explode('x', $size);

    for ($i=$x; $i < $x+$w; $i++) {
        for ($j=$y; $j < $y+$h; $j++) {
            if (isset($fabric["$i.$j"])) {
                $overlaps["$i.$j"] = true;
            } else {
                $fabric["$i.$j"] = true;
            }
        }
    }
}

foreach ($claims as $claim) {
    [$id, $_, $position, $size] = str_getcsv($claim, ' ');

    [$x, $y] = explode(',', trim($position, ':'));
    [$w, $h] = explode('x', $size);

    for ($i=$x; $i < $x+$w; $i++) {
        for ($j=$y; $j < $y+$h; $j++) {
            if (isset($overlaps["$i.$j"])) {
                continue 3;
            }
        }
    }

    echo $id;
    break;
}
