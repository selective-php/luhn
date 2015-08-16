<?php

/**
 * Luhn algorithm
 * 
 * The Luhn algorithm or Luhn formula, also known as the "modulus 10" or 
 * "mod 10" algorithm, is a simple checksum formula used to validate a 
 * variety of identification numbers, such as credit card numbers, 
 * IMEI numbers, National Provider Identifier numbers in the US, and 
 * Canadian Social Insurance Numbers. It was created by IBM scientist 
 * Hans Peter Luhn and described in U.S. Patent No. 2,950,048, filed 
 * on January 6, 1954, and granted on August 23, 1960.
 *  
 * @author odan
 * @copyright 2015-2016 odan
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link https://github.com/odan/luhn
 * 
 */

namespace Molengo;

class Luhn
{

    /**
     * Returns the luhn check digit
     *
     * @param string $s numbers as string
     * @return int checksum digit
     */
    public function create($s)
    {
        // Add a zero check digit
        $s = $s . '0';
        $sum = 0;
        // Find the last character
        $i = strlen($s);
        $odd_length = $i % 2;
        // Iterate all digits backwards
        while ($i-- > 0) {
            // Add the current digit
            $sum+=$s[$i];
            // If the digit is even, add it again. Adjust for digits 10+ by subtracting 9.
            ($odd_length == ($i % 2)) ? ($s[$i] > 4) ? ($sum+=($s[$i] - 9)) : ($sum+=$s[$i]) : false;
        }
        return (10 - ($sum % 10)) % 10;
    }

    /**
     * Check luhn number
     *
     * @param string $number
     * @return bool
     */
    public function validate($number)
    {
        $sum = 0;
        $numDigits = strlen($number) - 1;
        $parity = $numDigits % 2;
        for ($i = $numDigits; $i >= 0; $i--) {
            $digit = substr($number, $i, 1);
            if (!$parity == ($i % 2)) {
                $digit <<= 1;
            }
            $digit = ($digit > 9) ? ($digit - 9) : $digit;
            $sum += $digit;
        }
        return (0 == ($sum % 10));
    }
}
