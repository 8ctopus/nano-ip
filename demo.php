<?php

declare(strict_types=1);

use Oct8pus\NanoIP\CIDRRange;

require_once __DIR__ . '/vendor/autoload.php';

$range = '139.87.112.0/31';

$range = new CIDRRange($range);

echo $range;

$ips = [
    '192.168.104.1',
    '192.168.101.122',
    '192.168.101.1',
];

foreach ($ips as $ip) {
    if ($range->contains($ip)) {
        echo "{$ip} is in range\n";
    } else {
        echo "{$ip} is not in range\n";
    }
}
