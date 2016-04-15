<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 12:01
 */
class ArticleOperationEnum extends OperationEnum
{
    const
        SEARCH = 201,
        AUTO_SAVE = 202;

    protected static $operation = array(
        self::SEARCH => 'search',
        self::AUTO_SAVE => 'autoSave'
    );

    public static function search()
    {
        return new self(self::SEARCH);
    }

    public static function autoSave()
    {
        return new self(self::AUTO_SAVE);
    }


}