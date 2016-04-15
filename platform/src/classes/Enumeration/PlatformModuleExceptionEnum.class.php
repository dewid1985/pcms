<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 31.12.14
 * Time: 9:49
 */
class PlatformModuleExceptionEnum extends Enum
{
    const
        ERROR_NO_OPERATION = 50;


    static protected $names = array(
        self::ERROR_NO_OPERATION => 'Error no operation module'
    );


    public static function getErrorNoOperation()
    {
        return new self(self::ERROR_NO_OPERATION);
    }
}