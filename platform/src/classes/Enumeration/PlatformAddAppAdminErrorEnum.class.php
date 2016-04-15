<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 18.01.16
 * Time: 14:35
 */
class  PlatformAddAppAdminErrorEnum extends Enum
{
    const
        ERROR_REQUIRED_NAME = 1,
        ERROR_NAME = 2,
        ERROR_REQUIRED_ACCESS_TOKEN = 3,
        ERROR_ACCESS_TOKEN = 4,
        ERROR_REQUIRED_SOCIAL_ADMIN = 5,
        ERROR_SOCIAL_ADMIN = 6;

    protected static $names = [
        self::ERROR_REQUIRED_NAME => 'Имя администратора обязательно для заполнения',
        self::ERROR_NAME => 'Не правильно введено имя администратора',
        self::ERROR_REQUIRED_ACCESS_TOKEN => 'Access token обязательно для заполнения',
        self::ERROR_ACCESS_TOKEN => 'Не правильно введно поле access token',
        self::ERROR_REQUIRED_SOCIAL_ADMIN => 'ID пользователя (администратора приложения) обязательно для заполнения',
        self::ERROR_SOCIAL_ADMIN => 'ID пользоветеля не правильно'
    ];

    public static function getErrorRequiredName()
    {
        return new self(self::ERROR_REQUIRED_NAME);
    }

    public static function getErrorName()
    {
        return new self(self::ERROR_NAME);
    }

    public static function getErrorRequiredAccessToken()
    {
        return new self(self::ERROR_REQUIRED_ACCESS_TOKEN);
    }

    public static function getErrorAccessToken()
    {
        return new self(self::ERROR_ACCESS_TOKEN);
    }

    public static function getErrorRequiredSocialAdmin()
    {
        return new self(self::ERROR_REQUIRED_SOCIAL_ADMIN);
    }

    public static function getErrorSocialAdmin()
    {
        return new self(self::ERROR_SOCIAL_ADMIN);
    }

    public function getError()
    {
        return parent::getName();
    }
}