<?php

declare(strict_types=1);

namespace Tests;

use Oct8pus\NanoIP\IPv4;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \Oct8pus\NanoIP\IPv4
 */
final class IPv4Test extends TestCase
{
    public function test() : void
    {
        $ip = new IPv4('127.0.0.1');
        self::assertSame(0x7F000001, $ip->long());
        self::assertSame([127, 0, 0, 1], $ip->bytes());
        self::assertSame('01111111.00000000.00000000.00000001', $ip->binary());

        $ip = new IPv4(0x7F000001);
        self::assertSame('127.0.0.1', $ip->str());
        self::assertSame('127.0.0.1', (string) $ip);
        self::assertSame('01111111.00000000.00000000.00000001', $ip->binary());
    }
}
