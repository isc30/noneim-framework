<?php

////
// Isc Framework for PHP5
// ivansanzcarasa@gmail.com
////

// Define solution directory for relative path inclusion
$solutionDir = dirname(__FILE__) . '/Solution/';

// Include IFramework
require_once $solutionDir . 'Core/IFramework.php';

// Init project
IFramework::init($solutionDir, 'UnitTests');