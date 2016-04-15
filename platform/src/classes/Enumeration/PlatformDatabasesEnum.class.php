<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.12.14
 * Time: 9:51
 */
class PlatformDatabasesEnum extends Enum
{
    const
        /**
         * Добавляем константу с id
         *
         * пример TEST = 2
         */
        DEFAULT_DATABASES  = 1,
        TEST_DATABASES =2
    ;

    protected static $names = array(
        /**
         * Добавляем имя для созданного линка
         * пример self::TEST = 'test'
         */
        self::DEFAULT_DATABASES => 'default',
        self::TEST_DATABASES => 'test'
    );

    /**
     * Создаем метод
     * public static function databasesTest()
     * {
     *   return new self(self::TEST);
     * }
     */

    /**
     * Дефолтное соединение
     *
     * @return PlatformDatabasesEnum
     */
    public static function databasesDefault()
    {
        return new self(self::DEFAULT_DATABASES);
    }

    public static function databasesTest()
    {
        return new self(self::TEST_DATABASES);
    }
}
