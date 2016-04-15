<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 12:01
 */
class RubricsOperationEnum extends OperationEnum
{
    const
        GET_ALL_LIST = 202,
        SEARCH = 201

    ;

    protected static $operation = array(
        self::GET_ALL_LIST => 'getAllList',
        self::SEARCH => 'search'
    );

    public static function getAllList()
    {
        return new self(self::GET_ALL_LIST);
    }

    public static function search()
    {
        return new self(self::SEARCH);
    }




}