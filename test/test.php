<?php

require_once __DIR__ . '/../src/Luhn.php';

echo "<pre>\n";

$luhn = new Luhn();
var_dump($luhn->getLuhn('1982'));       // 8
var_dump($luhn->checkLuhn('19828'));    // true
var_dump($luhn->checkLuhn('19829'));    // false
var_dump($luhn->encodeNumber('1'));     // 0531060250431210196
var_dump($luhn->encodeNumber('1', '201502'));   // 2015020531060250431210198
var_dump($luhn->encodeNumber('2', '201502'));   // 2015022180751460551862045
var_dump($luhn->encodeNumber('3', '201502'));
var_dump($luhn->encodeNumber('10000', '201502'));
var_dump($luhn->encodeNumber('20000', '201502'));
var_dump($luhn->encodeNumber('2147483647', '201502'));
