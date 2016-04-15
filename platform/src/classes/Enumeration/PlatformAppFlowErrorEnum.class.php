<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27.01.16
 * Time: 16:11
 */
class PlatformAppFlowErrorEnum extends Enum
{
    const REQUIRED_NAME = 1;


    protected static $names = [
        self::REQUIRED_NAME => 'Поле `Название потока` обязательно для заполнения'
    ];

    public static function requiredName()
    {
        return new self(self::REQUIRED_NAME);
    }

    public function getError()
    {
        return parent::getName();
    }
}