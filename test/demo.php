<?php

require_once __DIR__ . '/../vendor/autoload.php';

echo "<pre>\n";

$luhn = new \Odan\Luhn\Luhn();
var_dump($luhn->create('1982'));       // 8
var_dump($luhn->validate('19828'));    // true
var_dump($luhn->validate('19829'));    // false

