<?php

declare(strict_types=1);

use App\Constant;
use App\Event;

require_once 'vendor/autoload.php';

$dbName = Constant::DbName;
$db = new SQLite3($dbName);

$event = new Event($db);

$startTimer = microtime(true);
$stats = $event->getTypesStats();
echo sprintf(
        'Clicks: %s, purchases: %s, skips: %s',
        $stats['click'] ?? 0,
        $stats['purchase'] ?? 0,
        $stats['skip'] ?? 0
    ) . PHP_EOL;
echo sprintf('Time: %s s', round(microtime(true) - $startTimer, 3));

echo PHP_EOL . '----' . PHP_EOL;
$start = '2022-11-22';
$end = '2022-11-23';
$startTimer = microtime(true);
echo sprintf('Count (%s - %s): %s', $start, $end, $event->getEventsCount($start, $end)) . PHP_EOL;
echo sprintf('Time: %s s', round(microtime(true) - $startTimer, 3)) . PHP_EOL;
