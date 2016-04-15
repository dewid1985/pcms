<?php

/**
 * Базовые операции модуля
 *
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 11:01
 */
class BaseOperationEnum
    extends Enum
    implements Named, Stringable, Serializable, Identifiable, DialectString, IModuleOperationEnum
{
    const
        ADD = 101,
        SAVE = 102,
        DELETE = 103,
        GET = 104;
    /**
     * @var array
     */
    protected static $names = array(
        self::ADD => 'add',
        self::SAVE => 'save',
        self::DELETE => 'delete',
        self::GET => 'get'
    );

    /**
     * Добавить
     * @return BaseOperationEnum
     */
    public static function add()
    {
        return new self(self::ADD);
    }

    /**
     * Обновить - Сохранить
     * @return BaseOperationEnum
     */
    public static function save()
    {
        return new self(self::SAVE);
    }

    /**
     * Удалить
     * @return BaseOperationEnum
     */
    public static function delete()
    {
        return new self(self::DELETE);
    }

    /**
     * Получить
     * @return BaseOperationEnum
     */
    public static function get()
    {
        return new self(self::GET);
    }
}