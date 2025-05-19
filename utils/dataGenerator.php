<?php

declare(strict_types=1);

use App\Constant;
use App\Event;

require_once __DIR__ . '/../vendor/autoload.php';

$dbName = Constant::DbName;
if (file_exists($dbName)) {
    unlink($dbName);
}

$db = new SQLite3($dbName);
$db->exec(file_get_contents(__DIR__ . '/../database/schemas/Events.sql'));

$ev = new Event($db);
$types = ['click', 'purchase', 'skip', 'click', 'click', 'click', 'purchase'];
$a = 10;
$b = 100_000;
$max = $a * $b;
$done = 0;
$baseTimestamp = strtotime('2022-11-24 00:00:00');
for ($j = 0; $j < $a; $j++) {
    $db->exec('BEGIN TRANSACTION');
    for ($i = 0; $i < $b; $i++) {
        $ev->insert(
            $types[array_rand($types)],
            date('Y-m-d H:i:s', strtotime('+ ' . $i + $j . ' seconds', $baseTimestamp)));
        $done++;
    }
    echo round($done / $max * 100, 2) . ' %' . PHP_EOL;
    $db->exec('COMMIT');
}

