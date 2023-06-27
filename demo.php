<?php

declare(strict_types=1);

use Oct8pus\NanoIP\CIDR;

require_once __DIR__ . '/vendor/autoload.php';

$range = '192.168.100.0/22';

$range = new CIDR($range);

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
