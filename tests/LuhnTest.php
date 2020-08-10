<?php

namespace Selective\Luhn\Test;

use Selective\Luhn\Luhn;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class LuhnTest extends TestCase
{
    /**
     * Data provider about validating valid number
     *
     * @return array<mixed>
     */
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
     * @param string $validNumber A valid numeric string
     * @param bool $expected A expected numeric string
     *
     * @return void
     */
    public function testValidateValidNumber(string $validNumber, bool $expected): void
    {
        $luhn = new Luhn();

        $this->assertSame($expected, $luhn->validate($validNumber));
    }

    /**
     * Data provider about validating invalid number
     *
     * @return array<mixed>
     */
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
     * @param string $invalidNumber A invalid numeric string
     * @param bool $expected A expected numeric string
     *
     * @return void
     */
    public function testValidateInvalidNumber(string $invalidNumber, bool $expected): void
    {
        $luhn = new Luhn();

        $this->assertSame($expected, $luhn->validate($invalidNumber));
    }

    /**
     * Data provider about creating number
     *
     * @return array<mixed>
     */
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
     * @param string $number A valid numeric string
     * @param int $expected A expected numeric string
     *
     * @return void
     */
    public function testCreate(string $number, int $expected): void
    {
        $luhn = new Luhn();

        $this->assertSame($expected, $luhn->create($number));
    }

    /**
     * Test for creating on invalid numeric string
     *
     * @return void
     */
    public function testCreateOnInvalidNumericString(): void
    {
        $luhn = new Luhn();
        $invalidNumericString = 'this_is_invalid_numeric_string';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('An invalid numeric value was given: %s', $invalidNumericString));

        $luhn->create($invalidNumericString);
    }

    /**
     * Test for validating on invalid numeric string
     *
     * @return void
     */
    public function testValidateOnInvalidNumericString(): void
    {
        $luhn = new Luhn();
        $invalidNumericString = 'this_is_invalid_numeric_string';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('An invalid numeric value was given: %s', $invalidNumericString));

        $luhn->validate($invalidNumericString);
    }
}
