<?php

namespace Selective\Luhn\Test;

use Selective\Luhn\Luhn;
use PHPUnit\Framework\TestCase;

class LuhnTest extends TestCase
{
    public function providerValidateValidNumber(): array
    {
        return [
            ['1982', true],
            ['19828', true],
            ['67', true],
            ['79927398713', true]
        ];
    }

    /**
     * @dataProvider providerValidateValidNumber
     *
     * @param string $validNumber
     * @param bool $expected
     */
    public function testValidateValidNumber(string $validNumber, bool $expected): void
    {
        $luhn = new Luhn();

        $this->assertSame($expected, $luhn->validate($validNumber));
    }

    public function providerValidateInvalidNumber(): array
    {
        return [
            ['19829', false],
            ['677', false],
            ['123456', false],
            ['79927398710', false],
            ['79927398711', false],
            ['79927398712', false],
            ['79927398714', false],
            ['79927398715', false],
            ['79927398716', false],
            ['79927398717', false],
            ['79927398718', false],
            ['79927398719', false],
        ];
    }

    /**
     * @dataProvider providerValidateInvalidNumber
     *
     * @param string $invalidNumber
     * @param bool $expected
     */
    public function testValidateInvalidNumber(string $invalidNumber, bool $expected): void
    {
        $luhn = new Luhn();

        $this->assertSame($expected, $luhn->validate($invalidNumber));
    }

    public function providerCreateNumber(): array
    {
        return [
            ['1982', 8],
            ['7992739871', 3],
            ['5181271099000012', 2],
            ['7992739871', 3],
        ];
    }

    /**
     * @dataProvider providerCreateNumber
     *
     * @param string $number
     * @param int $expected
     */
    public function testCreate(string $number, int $expected): void
    {
        $luhn = new Luhn();

        $this->assertSame($expected, $luhn->create($number));
    }
}
