<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 12:01
 */
class NewsOperationEnum extends OperationEnum
{
    const
        SEARCH = 201;

    protected static $operation = array(
        self::SEARCH => 'search'
    );

    public static function search()
    {
        return new self(self::SEARCH);
    }
}