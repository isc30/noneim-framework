<?php

// Isc Framework for PHP
// https://bitbucket.org/ivansanz/php-framework
// ivansanzcarasa@gmail.com

// Solution directory for relative path inclusion
$solutionDir = dirname(__FILE__) . '/../../Solution/';

// Include IFramework
require_once $solutionDir . 'Core/IFramework.php';

// Init project
IFramework::init($solutionDir, 'WebApp');
