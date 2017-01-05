<?php

/**
 * Isc Framework for PHP5
 * ivansanzcarasa@gmail.com
 */

// Define current directory for relative path inclusion
$CURRENT_DIR = dirname(__FILE__) . '/';

require_once $CURRENT_DIR . 'Application/Configuration.php'; // Include Configuration
require_once $CURRENT_DIR . 'Application/Core/IFramework.php'; // Include IFramework
IFramework::init(); // Init Application