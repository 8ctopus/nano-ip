<?php

declare(strict_types=1);

namespace Oct8pus\NanoIP;

class IPv6
{
    private readonly string $str;
    // REM private readonly int $long;
    private readonly array $bytes;

    /**
     * Constructor
     *
     * @param string $address
     */
    public function __construct(string $address)
    {
        $this->str = $address;
        // REM $this->long = ip2long($address);
    }

    public function __toString() : string
    {
        return sprintf('%s', $this->str);
    }

    /* REM
    public function long() : int
    {
        return $this->long;
    }
    */

    public function bytes() : array
    {
        if (isset($this->bytes)) {
            return $this->bytes;
        }

        $str = str_replace(':', '', $this->str);

        $pos = 0;
        $bytes = [];

        while ($pos < strlen($str)) {
            $bytes[] = hexdec(substr($str, $pos, 4));
            $pos += 4;
        }

        $this->bytes = $bytes;

        return $bytes;
    }

    public function str() : string
    {
        return $this->str;
    }

    public function binary() : string
    {
        $bytes = $this->bytes();

        return sprintf('%08b:%08b:%08b:%08b:%08b:%08b:%08b:%08b', $bytes[0], $bytes[1], $bytes[2], $bytes[3], $bytes[4], $bytes[5], $bytes[6], $bytes[7]);
    }
}
