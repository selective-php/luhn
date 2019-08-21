<?php

namespace Selective\Luhn\Test;

use Selective\Luhn\Luhn;
use PHPUnit\Framework\TestCase;

class LuhnTest extends TestCase
{
    public function providerValidateValidNumber(): array
    {
        return [
            ['1982'],
            ['19828'],
            ['67'],
        ];
    }

    /**
     * @dataProvider providerValidateValidNumber
     */
    public function testValidateValidNumber(string $validNumber): void
    {
        $luhn = new Luhn();

        $this->assertTrue($luhn->validate($validNumber));
    }

    public function providerValidateInvalidNumber(): array
    {
        return [
            ['19829'],
            ['677'],
            ['123456'],
        ];
    }

    /**
     * @dataProvider providerValidateInvalidNumber
     */
    public function testValidateInvalidNumber(string $invalidNumber): void
    {
        $luhn = new Luhn();

        $this->assertFalse($luhn->validate($invalidNumber));
    }

    public function providerCreateNumber(): array
    {
        return [
            ['1982', 8],
            ['7992739871', 3],
            ['5181271099000012', 2],
        ];
    }

    /**
     * @dataProvider providerCreateNumber
     */
    public function testCreate(string $number, int $expected): void
    {
        $luhn = new Luhn();

        $this->assertSame($expected, $luhn->create($number));
    }
}
