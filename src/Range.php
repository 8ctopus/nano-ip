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
     * @param int|IPv4|string $address
     *
     * @return bool
     */
    public function contains(string|int|IPv4 $address) : bool
    {
        if (!$address instanceof IPv4) {
            $address = new IPv4($address);
        }

        foreach ($this->list as $item) {
            if (CIDR::isCIDR($item)) {
                $range = new CIDR($item);

                if ($range->contains($address)) {
                    return true;
                }
            } else {
                if ($item === $address->str()) {
                    return true;
                }
            }
        }

        return false;
    }
}
