<?php

interface ILazyConfiguration extends IConfiguration
{
    /**
     * Apply Configuration
     * @return void
     */
    public static function configure();
}