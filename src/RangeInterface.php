<?php

declare(strict_types=1);

namespace Oct8pus\NanoIP;

interface RangeInterface
{
    public function contains(string|int|IPv4 $ip) : bool;
}
