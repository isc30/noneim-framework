<?php

/**
 * Lazy Configuration Interface
 * @package Core
 * @subpackage Interfaces
 */
interface ILazyConfiguration extends IConfiguration
{
    /**
     * Apply Configuration
     * @return void
     */
    public static function configure();
}