<?php

/**
 * Isc Framework for PHP5
 * ivansanzcarasa@gmail.com
 */

// Define current directory for relative path inclusion
$CURRENT_DIR = dirname(__FILE__) . '/';

require_once $CURRENT_DIR . 'Solution/Configuration.php'; // Include Configuration
require_once $CURRENT_DIR . 'Solution/Core/IFramework.php'; // Include IFramework

IFramework::init('WebApp'); // Start project