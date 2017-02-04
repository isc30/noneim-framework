<?php

/**
 * Installer
 */
abstract class Installer extends StaticClass implements IInstaller
{
    /** @var bool */
    public static $isDefault = false;
}