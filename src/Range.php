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
     * @param IPv4|IPv6|string|int $address
     *
     * @return bool
     */
    public function contains(IPv4|IPv6|string|int $address) : bool
    {
        $type = gettype($address);

        switch ($type) {
            case 'integer':
                $address = new IPv4($address);
                break;

            case 'object':
                break;

            case 'string':
                $type = $this->getType($address);

                switch ($type) {
                    case 'ipv4':
                        $address = new IPv4($address);
                        break;

                    case 'ipv6':
                        $address = new IPv6($address);
                        break;

                    default:
                        throw new IPException("unhandled type - {$type}");
                }

                break;

            default:
                throw new IPException("unhandled type - {$type}");
        }

        foreach ($this->list as $item) {
            $type = $this->getType($item);

            switch ($type) {
                case 'ipv4':
                case 'ipv6':
                    if ($item === $address->str()) {
                        return true;
                    }

                    break;

                case 'cidr':
                    $range = new CIDRRange($item);

                    if ($range->contains($address)) {
                        return true;
                    }

                    break;

                default:
                    throw new IPException("unhandled type - {$type}");
            }
        }

        return false;
    }

    /**
     * Get ip address type
     *
     * @param string $str
     *
     * @return string
     */
    private function getType(string $str) : string
    {
        if (str_contains($str, '/')) {
            return 'cidr';
        }

        if (str_contains($str, '-')) {
            return 'range';
        }

        if (str_contains($str, '*')) {
            return 'wildcard';
        }

        if (str_contains($str, ':')) {
            return 'ipv6';
        }

        return 'ipv4';
    }
}
