<?php

/**
 * Lazy Configuration
 */
abstract class LazyConfiguration extends StaticClass implements ILazyConfiguration
{
    /** @var bool */
    public static $isDefault = false;
}