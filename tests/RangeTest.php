<?php

declare(strict_types=1);

namespace Tests;

use Oct8pus\NanoIP\IPv4;
use Oct8pus\NanoIP\IPException;
use Oct8pus\NanoIP\Range;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \Oct8pus\NanoIP\Range
 */
final class RangeTest extends TestCase
{
    public function test() : void
    {
        $range = new Range([
            '127.0.0.1',
            '192.168.100.0/22',
        ]);

        self::assertTrue($range->contains('127.0.0.1'));
        self::assertTrue($range->contains(new IPv4('127.0.0.1')));
        self::assertFalse($range->contains('192.168.99.255'));
        self::assertTrue($range->contains('192.168.100.0'));
        self::assertTrue($range->contains('192.168.100.1'));
        self::assertTrue($range->contains('192.168.100.255'));
        self::assertTrue($range->contains('192.168.101.0'));
        self::assertTrue($range->contains('192.168.101.255'));
        self::assertTrue($range->contains('192.168.102.0'));
        self::assertTrue($range->contains('192.168.102.255'));
        self::assertTrue($range->contains('192.168.103.0'));
        self::assertTrue($range->contains('192.168.103.255'));
        self::assertFalse($range->contains('192.168.104.0'));
    }

    public function testUnhandledType() : void
    {
        $range = new Range([
            '192.168.100.0-22',
            '127.0.0.1',
        ]);

        self::expectException(IPException::class);
        self::expectExceptionMessage('unhandled type - range');

        $range->contains('127.0.0.1');
    }
}
