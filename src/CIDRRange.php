<?php

declare(strict_types=1);

namespace Oct8pus\NanoIP;

class CIDRRange implements RangeInterface
{
    private readonly string $range;
    private readonly IPv4 $start;
    private readonly IPv4 $end;
    private readonly int $width;

    /**
     * Constructor
     *
     * @param string $range
     */
    public function __construct(string $range)
    {
        $this->range = $range;

        if (!str_contains($range, '/')) {
            throw new IPException('invalid range');
        }

        [$address, $cidr] = explode('/', $range);

        $this->start = new IPv4($address);

        if (!ctype_digit($cidr)) {
            throw new IPException('invalid range (2)');
        }

        $cidr = (int) $cidr;

        if ($cidr > 32) {
            throw new IPException('invalid range (3)');
        }

        $this->width = 2 ** (32 - $cidr);

        $end = $this->start->long() | ($this->width - 1);

        $this->end = new IPv4($end);
    }

    public function __toString()
    {
        return sprintf('%s range contains %d addresses %s - %s', $this->range, $this->width, $this->start, $this->end);
    }

    /**
     * Check if ip address is in range
     *
     * @param int|IPv4|string $address
     *
     * @return bool
     */
    public function contains(int|IPv4|string $address) : bool
    {
        if (!$address instanceof IPv4) {
            $address = new IPv4($address);
        }

        return $address->long() >= $this->start->long() && $address->long() <= $this->end->long();
    }
}
