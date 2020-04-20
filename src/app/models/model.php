<?php

abstract class Enum 
{
    private static $constCacheArray = NULL;

    private static function getConstants() 
    {
        if (self::$constCacheArray == NULL) 
        {
            self::$constCacheArray = [];
        }

        $calledClass = get_called_class();

        if (!array_key_exists($calledClass, self::$constCacheArray)) 
        {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return self::$constCacheArray[$calledClass];
    }

    public static function isValidValue($value) 
    {
        $values = array_values(self::getConstants());
        return in_array($value, $values);
    }
}

abstract class UserType extends Enum 
{
    const BUYER = 'buyer';
    const STORE_OWNER = 'store_owner';
    const ADMINISTRATOR = 'administrator';
}

class Model
{
	public $data = array();
}