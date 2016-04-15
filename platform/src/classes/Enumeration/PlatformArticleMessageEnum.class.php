<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 22.01.15
 * Time: 12:50
 */
class PlatformArticleMessageEnum extends Enum
{
    const
        SAVE_TITLE = 1,
        SAVE_MESSAGE = 2,
        UPDATE_TITLE = 3,
        UPDATE_MESSAGE = 4
    ;

    protected static $names = array(
        self::SAVE_TITLE => 'Сохранение',
        self::SAVE_MESSAGE => 'Статья успешно сохраненна!!!',
        self::UPDATE_TITLE => 'Обновление',
        self::SAVE_MESSAGE => 'Статья успешно обновленна!!!'
    );

    public static function saveTitle()
    {
        return new self(self::SAVE_TITLE);
    }

    public static function updateTitle()
    {
        return new self(self::UPDATE_TITLE);
    }

    public static function saveMessage()
    {
        return new self(self::SAVE_MESSAGE);
    }

    public static function updateMessage()
    {
        return new self(self::UPDATE_MESSAGE);
    }
}