<?php

/**
 * LazyConfiguration Interface
 */
interface LazyConfiguration extends IConfiguration
{
    /**
     * Apply Configuration
     * @return void
     */
    public static function configure();
}