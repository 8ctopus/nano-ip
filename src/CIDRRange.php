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

            case 'object':
                break;

            default:
                throw new IPException("unhandled type - {$type}");
        }

        if ($address instanceof IPv4) {
            return $address->long() >= $this->start->long() && $address->long() <= $this->end->long();
        }

        if ($address instanceof IPv6) {
            throw new IPException('not implemented');
            //return $address->str() >= $this->start->long() && $address->long() <= $this->end->long();
        }
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

