<?php
/**
 * Енумерейшейн модулей
 *
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 10:50
 */
class ModulesEnum extends Enum
{
    const
        MODULE_ARTICLE = 1,
        MODULE_NEWS = 2,
        MODULE_RUBRICS = 3,
        MODULE_MULTIMEDIA = 4
;


    protected static $names = array(
        self::MODULE_ARTICLE => 'Article',
        self::MODULE_NEWS => 'News',
        self::MODULE_RUBRICS => 'Rubrics',
        self::MODULE_MULTIMEDIA => 'Multimedia'
    );

    /**
     * Модуль Article
     * @return ModulesEnum
     */
    public static function article()
    {
        return new self(self::MODULE_ARTICLE);
    }

    public static function news()
    {
        return new self(self::MODULE_NEWS);
    }

    public static function rubrics()
    {
        return new self(self::MODULE_RUBRICS);
    }

    public static function multimedia()
    {
        return new self(self::MODULE_MULTIMEDIA);
    }
}