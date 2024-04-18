<?php

declare(strict_types=1);

namespace Tests;

use Oct8pus\NanoIP\IPv6;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \Oct8pus\NanoIP\IPv6
 */
final class IPv6Test extends TestCase
{
    public function test() : void
    {
        $ip = new IPv6('2001:0DB8:7654:0010:FEDC:0000:0000:3210');
        self::assertSame('2001:0DB8:7654:0010:FEDC:0000:0000:3210', $ip->str());
        self::assertSame('2001:0DB8:7654:0010:FEDC:0000:0000:3210', (string) $ip);
        self::assertSame([0x2001, 0x0DB8, 0x7654, 0x0010, 0xFEDC, 0x0000, 0x0000, 0x3210], $ip->bytes());
        self::assertSame('0010000000000001:0000110110111000:0111011001010100:0000000000010000:1111111011011100:0000000000000000:0000000000000000:0011001000010000', $ip->binary());
    }
}
