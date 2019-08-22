<?php

/**
 * Luhn algorithm.
 *
 * The Luhn algorithm or Luhn formula, also known as the "modulus 10" or
 * "mod 10" algorithm, is a simple checksum formula used to validate a
 * variety of identification numbers, such as credit card numbers,
 * IMEI numbers, National Provider Identifier numbers in the US, and
 * Canadian Social Insurance Numbers. It was created by IBM scientist
 * Hans Peter Luhn and described in U.S. Patent No. 2,950,048, filed
 * on January 6, 1954, and granted on August 23, 1960.
 */

namespace Selective\Luhn;

use InvalidArgumentException;

/**
 * Luhn.
 */
class Luhn
{
    /**
     * Returns the luhn check digit.
     *
     * @param string $numbers numbers as string
     *
     * @return int checksum digit
     */
    public function create(string $numbers): int
    {
        $this->validateNumericString($numbers);

        // Add a zero check digit
        $numbers .= '0';
        $sum = 0;
        // Find the last character
        $i = strlen($numbers);
        $odd_length = $i % 2;
        // Iterate all digits backwards
        while ($i-- > 0) {
            // Add the current digit
            $sum += $numbers[$i];
            // If the digit is even, add it again. Adjust for digits 10+ by subtracting 9.
            ($odd_length == ($i % 2)) ? ($numbers[$i] > 4) ? ($sum += ((int)$numbers[$i] - 9)) : ($sum += $numbers[$i]) : false;
        }

        return (10 - ($sum % 10)) % 10;
    }

    /**
     * Check luhn number.
     *
     * @param string $number The number to validate
     *
     * @return bool Status
     */
    public function validate(string $number): bool
    {
        $this->validateNumericString($number);

        $sum = 0;
        $numDigits = strlen($number) - 1;
        $parity = $numDigits % 2;

        for ($i = $numDigits; $i >= 0; $i--) {
            $digit = (int)substr($number, $i, 1);
            if (!$parity == ($i % 2)) {
                $digit <<= 1;
            }
            $digit = ($digit > 9) ? ($digit - 9) : $digit;
            $sum += $digit;
        }

        return 0 == ($sum % 10);
    }

    private function validateNumericString(string $number): void
    {
        if (!preg_match('/^\d+$/', $number)) {
            throw new InvalidArgumentException(sprintf('An invalid numeric value was given: %s', $number));
        }
    }
}
