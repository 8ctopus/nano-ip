<?php

declare(strict_types=1);

namespace Oct8pus\NanoIP;

interface RangeInterface
{
    public function contains(int|IPv4|string $address) : bool;
}
