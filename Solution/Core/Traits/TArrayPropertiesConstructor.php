<?php

/**
 * Array properties constructor Trait
 * @package Core
 * @subpackage Traits
 */
trait TArrayPropertiesConstructor
{
    /**
     * Constructor
     * @param array $properties Array of properties to initialize (property => value)
     * @throws PropertyNotFoundException
     */
    public function __construct($properties = array())
    {
        foreach ($properties as $key => $value)
        {
            if (property_exists($this, $key))
            {
                $this->{$key} = $value;
            }
            else
            {
                throw new PropertyNotFoundException($key);
            }
        }
    }
}