<?php

require_once __DIR__ . '/vendor/autoload.php';

use Tommus\String\Stringo;

$string = (bool) Stringo::from(null)->length();

var_dump($string);