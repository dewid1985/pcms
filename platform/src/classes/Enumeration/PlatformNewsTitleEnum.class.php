<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 09.02.15
 * Time: 14:40
 */
class PlatformNewsTitleEnum extends Enum
{

    const
        ADD_NEWS_TITLE = 1,
        SAVE_NEWS_TITLE = 2;

    protected static $names = array(
        self::ADD_NEWS_TITLE => "Cоздание новости",
        self::SAVE_NEWS_TITLE => "Обновление новости"
    );

    public static function addNews()
    {
        return new self(self::ADD_NEWS_TITLE);
    }

    public static function saveNews()
    {
        return new self(self::SAVE_NEWS_TITLE);
    }

}