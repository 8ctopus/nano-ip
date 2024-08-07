# nano ip

[![packagist](https://poser.pugx.org/8ctopus/nano-ip/v)](https://packagist.org/packages/8ctopus/nano-ip)
[![downloads](https://poser.pugx.org/8ctopus/nano-ip/downloads)](https://packagist.org/packages/8ctopus/nano-ip)
[![min php version](https://poser.pugx.org/8ctopus/nano-ip/require/php)](https://packagist.org/packages/8ctopus/nano-ip)
[![license](https://poser.pugx.org/8ctopus/nano-ip/license)](https://packagist.org/packages/8ctopus/nano-ip)
[![tests](https://github.com/8ctopus/nano-ip/actions/workflows/tests.yml/badge.svg)](https://github.com/8ctopus/nano-ip/actions/workflows/tests.yml)
![code coverage badge](https://raw.githubusercontent.com/8ctopus/nano-ip/image-data/coverage.svg)
![lines of code](https://raw.githubusercontent.com/8ctopus/nano-ip/image-data/lines.svg)

Experimental package to check if an IPv4 ip address is in a list of ranges.

## features

- CIDR ranges

## install

- `composer require 8ctopus/nano-ip`

## example

```php
use Oct8pus\NanoIP\CIDR;

require_once __DIR__ . '/vendor/autoload.php';

$range = '192.168.100.0/22';

$range = new CIDRRange($range);

echo $range;
```

```txt
192.168.100.0/22 range contains 1024 addresses 192.168.100.0 - 192.168.103.255
```

Test [CIDR ranges](https://ipinfo.io/tools/cidr-to-ip-range-converter) online
[Understand CIDR notation](https://michelburnett27.medium.com/understanding-cidr-notation-and-ip-address-range-3ad28194bc8d)
[More info](https://www.digitalocean.com/community/tutorials/understanding-ip-addresses-subnets-and-cidr-notation-for-networking)
[IP v6](https://www.cidr.eu/en/ipv6)

## run tests

    composer test

## clean code

    composer fix(-risky)
