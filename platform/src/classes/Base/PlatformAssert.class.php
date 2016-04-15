<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 23.12.14
 * Time: 12:00
 */

final class PlatformAssert extends StaticFactory
{
    public static function isResource($resource , $message = null)
    {
        if (!is_resource($resource))
            throw new WrongArgumentException(
                $message .','. self::dumpArgument($resource)
            );
    }


    public static function isStripos($flag, $message)
    {
        if(stripos($message, $flag) === TRUE)
            throw new WrongArgumentException(
                $message . ',' .self::dumpArgument($flag)
            );
    }

    public static function dumpArgument($argument)
    {
        return 'argument: ['.print_r($argument, TRUE).']';
    }
}