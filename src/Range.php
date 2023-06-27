<?php

declare(strict_types=1);

namespace Oct8pus\NanoIP;

class Range implements RangeInterface
{
    private readonly array $list;

    /**
     * Constructor
     *
     * @param array $list
     */
    public function __construct(array $list)
    {
        $this->list = $list;
    }

    /**
     * Check if ip address is in range
     *
     * @param  string|int|IPv4    $ip
     *
     * @return bool
     */
    public function contains(string|int|IPv4 $ip) : bool
    {
        if (!$ip instanceof IPv4) {
            $ip = new IPv4($ip);
        }

        foreach ($this->list as $item) {
            if (CIDR::isCIDR($item)) {
                $range = new CIDR($item);

                if ($range->contains($ip)) {
                    return true;
                }
            } else {
                if ($item === $ip->str()) {
                    return true;
                }
            }
        }

        return false;
    }
}
