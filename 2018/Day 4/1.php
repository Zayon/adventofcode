<?php

$input = file_get_contents('input');
$shifts = explode("\n", trim($input));

sort($shifts);

// first shift 
$firstShift = array_shift($shifts);
$action = substr($firstShift, 19);
sscanf($firstShift, '[1518-%d-%d %d:%d]', $previousMonth, $previousDay, $previousHour, $previousMinute);
sscanf($action, 'Guard #%d', $guard);
$state = 'awake';
$minutesAsleepByGuard = [
    $guard => [],
];

foreach ($shifts as $shift) {
    $action = substr($shift, 19);
    sscanf($shift, '[1518-%d-%d %d:%d]', $month, $day, $hour, $minute);

    if (false !== strpos($action, 'Guard')) {
        sscanf($action, 'Guard #%d', $guard);

        if (!isset($minutesAsleepByGuard[$guard])) {
            $minutesAsleepByGuard[$guard] = [];
        }
    }

    if (false !== strpos($action, 'asleep')) {
        $state = 'asleep';
    }

    if (false !== strpos($action, 'wakes')) {
        $dateTimeStart = new \DateTime("2018-$previousMonth-$previousDay $previousHour:$previousMinute:00");
        $dateTimeEnd = new \DateTime("2018-$month-$day $hour:$minute:00");

        while ($dateTimeStart->getTimestamp() !== $dateTimeEnd->getTimestamp()) {
            $dateTimeStart->add(new \DateInterval('PT1M'));

            if ($dateTimeStart->format('H') !== '00') {
                continue;
            }

            $minutesAsleepByGuard[$guard][] = $dateTimeStart->format('i');
        }

        $state = 'awake';
    }

    $previousMonth = $month;
    $previousDay = $day;
    $previousHour = $hour;
    $previousMinute = $minute;
}

$sleepiestGuard = $guard;
$sleepMinutes = 0;
foreach ($minutesAsleepByGuard as $guard => $minutes) {
    if (count($minutes) > $sleepMinutes) {
        $sleepiestGuard = $guard;
        $sleepMinutes = count($minutes);
    }
}

echo "sleepiest guard : $sleepiestGuard, slept $sleepMinutes minutes\n";
$minutesAsleepByGuard[$sleepiestGuard];

$tmp = array_count_values($minutesAsleepByGuard[$sleepiestGuard]);
asort($tmp);
end($tmp);
$minuteMostSlept = key($tmp);
echo "Minute most slept on $minuteMostSlept\n";

echo 'Result : '. $sleepiestGuard*$minuteMostSlept.PHP_EOL;
//var_dump($minutesAsleepByGuard);
