<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11.12.14
 * Time: 12:35
 */
abstract class PlatformBaseProcessor implements IPlatformProcessor
{
    public static function create()
    {
        return new static();
    }
}