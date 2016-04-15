<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.12.14
 * Time: 11:37
 */
abstract class PlatformBase
{
    public static function create()
    {
        return new static();
    }
}