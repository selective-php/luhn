<?php

/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 odan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
class Luhn
{

    /**
     * Returns the luhn check digit
     *
     * @param string $s numbers as string
     * @return int checksum digit
     */
    public function getLuhn($s)
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
     * http://de.wikipedia.org/wiki/Luhn-Algorithmus#PHP
     *
     * @param string $number
     * @return bool
     */
    public function checkLuhn($number)
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

    /**
     * Generate unique number by number with checksum
     *
     * @param string $strNumber number as string
     * @param string $strPrefix numeric prefix (only digits)
     * @return string
     */
    public function encodeNumber($strNumber, $strPrefix = '')
    {
        $strHex = substr(sha1($strNumber), 0, 12);
        $strReturn = $this->padHex($strHex);
        $strReturn = $strPrefix . $strReturn;
        $strReturn .= $this->getLuhn($strReturn);
        return $strReturn;
    }

    /**
     * Convert hex string to padded decimal numbers
     *
     * @param string $strHex
     * @return string
     */
    protected function padHex($strHex)
    {
        $strReturn = '';
        $arrBlocks = str_split($strHex, 2);
        foreach ($arrBlocks as $strHex) {
            $strReturn .= str_pad(hexdec($strHex), 3, '0', STR_PAD_LEFT);
        }
        return $strReturn;
    }

}
