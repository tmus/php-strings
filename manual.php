<?php

require_once __DIR__ . '/vendor/autoload.php';

use Tommus\String\Stringo;

$string = Stringo::fromSplit('WHAT THE');

var_dump($string);