# nano ip

[![packagist](http://poser.pugx.org/8ctopus/nano-ip/v)](https://packagist.org/packages/8ctopus/nano-ip)
[![downloads](http://poser.pugx.org/8ctopus/nano-ip/downloads)](https://packagist.org/packages/8ctopus/nano-ip)
[![min php version](http://poser.pugx.org/8ctopus/nano-ip/require/php)](https://packagist.org/packages/8ctopus/nano-ip)
[![license](http://poser.pugx.org/8ctopus/nano-ip/license)](https://packagist.org/packages/8ctopus/nano-ip)
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

## run tests

    composer test

## clean code

    composer fix(-risky)
