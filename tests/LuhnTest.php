<?php

namespace Selective\Luhn\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Selective\Luhn\Luhn;

/**
 * Test.
 */
class LuhnTest extends TestCase
{
    /**
     * Data provider about validating valid number.
     *
     * @return array<mixed>
     */
    public function providerValidateValidNumber(): array
    {
        return [
            ['1982'],
            ['19828'],
            ['67'],
            ['79927398713'],
        ];
    }

    /**
     * @dataProvider providerValidateValidNumber
     *
     * @param string $validNumber A valid numeric string
     *
     * @return void
     */
    public function testValidateValidNumber(string $validNumber): void
    {
        $luhn = new Luhn();

        $this->assertTrue($luhn->validate($validNumber));
    }

    /**
     * Data provider about validating invalid number.
     *
     * @return array<mixed>
     */
    public function providerValidateInvalidNumber(): array
    {
        return [
            ['19829'],
            ['677'],
            ['123456'],
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
     * @param string $invalidNumber A invalid numeric string
     *
     * @return void
     */
    public function testValidateInvalidNumber(string $invalidNumber): void
    {
        $luhn = new Luhn();

        $this->assertFalse($luhn->validate($invalidNumber));
    }

    /**
     * Data provider about creating number.
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
     * Test for creating on invalid numeric string.
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
     * Test for validating on invalid numeric string.
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
