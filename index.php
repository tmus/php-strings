<?php

require_once __DIR__ . '/vendor/autoload.php';

use Tommus\String\Stringo;

print Stringo::fromCapitalize('hello')->padLeft(20, 'x')->capitalize();