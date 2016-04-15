<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 23.01.15
 * Time: 17:59
 */

class PlatformResponseViewEnum extends Enum
{
    const
        JSON_RESPONSE = 1
    ;

    protected static $names = array(
        self::JSON_RESPONSE => 'json'
    );

    public static function jsonResponse()
    {
        return new self(self::JSON_RESPONSE);
    }
}