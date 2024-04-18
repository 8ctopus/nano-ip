<?php

declare(strict_types=1);

namespace Oct8pus\NanoIP;

class IPv4 implements IPInterface
{
    private readonly string $str;
    private readonly array $bytes;
    private readonly int $long;

    /**
     * Constructor
     *
     * @param int|string $address
     */
    public function __construct(int|string $address)
    {
        switch (gettype($address)) {
            case 'string':
                $this->str = $address;
                $this->long = ip2long($address);
                break;

            case 'integer':
                $this->str = long2ip($address);
                $this->long = $address;
                break;
        }
    }

    public function str() : string
    {
        return $this->str;
    }

    public function __toString() : string
    {
        return $this->str;
    }

    public function long() : int
    {
        return $this->long;
    }

    public function bytes() : array
    {
        if (isset($this->bytes)) {
            return $this->bytes;
        }

        $bytes = [];
        $bytes[] = ($this->long >> 24) & 0xFF;
        $bytes[] = ($this->long >> 16) & 0xFF;
        $bytes[] = ($this->long >> 8) & 0xFF;
        $bytes[] = $this->long & 0xFF;

        $this->bytes = $bytes;

        return $bytes;
    }

    public function binary() : string
    {
        $bytes = $this->bytes();

        return sprintf('%08b.%08b.%08b.%08b', $bytes[0], $bytes[1], $bytes[2], $bytes[3]);
    }
}
