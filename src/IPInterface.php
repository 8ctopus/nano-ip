<?php

declare(strict_types=1);

namespace Oct8pus\NanoIP;

interface IPInterface
{
    public function __toString() : string;

    public function str() : string;

    public function bytes() : array;

    public function binary() : string;
}
