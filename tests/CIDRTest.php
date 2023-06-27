<?php

declare(strict_types=1);

namespace Tests;

use Oct8pus\NanoIP\CIDR;
use Oct8pus\NanoIP\IPException;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \Oct8pus\NanoIP\CIDR
 */
final class CIDRTest extends TestCase
{
    public function test() : void
    {
        $range = '192.168.100.0/22';

        $range = new CIDR($range);

        self::assertSame('192.168.100.0/22 range contains 1024 addresses 192.168.100.0 - 192.168.103.255', (string) $range);

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

    public function testInvalidRange() : void
    {
        self::expectException(IPException::class);
        self::expectExceptionMessage('invalid range');
        new CIDR('127.0.0.1');
    }

    public function testInvalidRange2() : void
    {
        self::expectException(IPException::class);
        self::expectExceptionMessage('invalid range (2)');

        new CIDR('127.0.0.1/a');
    }
}
