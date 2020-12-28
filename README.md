# Luhn

[Luhn](https://en.wikipedia.org/wiki/Luhn_algorithm) (modulus 10 or mod 10 algorithm) for PHP

[![Latest Version on Packagist](https://img.shields.io/github/release/selective-php/luhn.svg)](https://packagist.org/packages/selective/luhn)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![build](https://github.com/selective-php/luhn/workflows/build/badge.svg)](https://github.com/selective-php/luhn/actions)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/selective-php/luhn.svg)](https://scrutinizer-ci.com/g/selective-php/luhn/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/selective-php/luhn.svg)](https://scrutinizer-ci.com/g/selective-php/luhn/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/selective/luhn.svg)](https://packagist.org/packages/selective/luhn/stats)

## Requirements

* PHP 7.3+ or 8.0+

## Installation

```
composer require selective/luhn
```

## Usage

### Create a number

```php
<?php

use Selective\Luhn\Luhn;

$luhn = new Luhn();

echo $luhn->create('7992739871'); // 3
```

### Validate a number

```php
<?php

use Selective\Luhn\Luhn;

$luhn = new Luhn();

$luhn->validate('79927398713'); // true
$luhn->validate('79927398710'); // false
```

## License

* MIT
