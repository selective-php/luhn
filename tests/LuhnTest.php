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
            ['79927398713']
        ];
    }

    /**
     * @dataProvider providerValidateValidNumber
     *
     * @param string $validNumber
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
            ['123456']
            ['79927398710'],
            ['79927398711'],
            ['79927398712'],
            ['79927398714'],
            ['79927398715'],
            ['79927398716'],
            ['79927398717'],
            ['79927398718'],
            ['79927398719'],
        ];
    }

    /**
     * @dataProvider providerValidateInvalidNumber
     *
     * @param string $invalidNumber
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
