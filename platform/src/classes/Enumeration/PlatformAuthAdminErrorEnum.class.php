<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11.12.14
 * Time: 10:27
 */
class PlatformAuthAdminErrorEnum extends Enum
{
    const
        ERROR_LOGIN = 1,
        ERROR_PASSWORD = 2,
        ERROR_REQUIRED_LOGIN = 3,
        ERROR_REQUIRED_PASSWORD = 4,
        ERROR_NO_AUTH = 5,
        ERROR_NO_USER = 6,
        ERROR_IP_ADDRESS_IN_BLACK_LIST = 7,
        ERROR_CAPTCHA = 8,
        ERROR_REQUIRED_CAPTCHA = 9,
        ERROR_CAPTCHA_NOTEQ_IMAGES = 10,
        ERROR_CODE = 11,
        ERROR_REQUIRED_CODE = 12
    ;


    protected static $names = array(
        self::ERROR_LOGIN => 'Поле `login`  заполненно не верно минимальное значение 5 символов максимальное 32.',
        self::ERROR_PASSWORD => 'Поле `login`  заполненно не верно минимальное значение 5 символов максимальное 32.',
        self::ERROR_CAPTCHA => 'Поле `captcha`  заполненно не верно, длина поля 5 символов',

        self::ERROR_REQUIRED_LOGIN => 'Поле `login` не заполнено.',
        self::ERROR_REQUIRED_PASSWORD => 'Поле `password` не заполнено.',
        self::ERROR_REQUIRED_CAPTCHA => 'Поле `captcha` не заполнено.',

        self::ERROR_NO_AUTH => 'Авторизоваться не удалось. Проверьте раскладку клавиатуры, не нажата ли клавиша «Caps Lock» и попробуйте ввести логин и пароль еще раз!',
        self::ERROR_NO_USER => 'Данный пользователь не зарегистрирован в системе!',
        self::ERROR_IP_ADDRESS_IN_BLACK_LIST => 'Данный ip адресс находится в черном списке обратитесь к администраторам!',
        self::ERROR_CAPTCHA_NOTEQ_IMAGES => 'Введенное поле `captcha` не соответствует изображению!',

        self::ERROR_CODE => 'Поле `code`  заполненно не верно!',
        self::ERROR_REQUIRED_CODE => 'Поле `code` не заполнено.'

    );

    public static function getErrorLogin()
    {
        return new self(self::ERROR_LOGIN);
    }

    public static function getErrorPassword()
    {
        return new self(self::ERROR_PASSWORD);
    }

    public static function getErrorRequiredLogin()
    {
        return new self(self::ERROR_REQUIRED_LOGIN);
    }

    public static function getErrorRequiredPassword()
    {
        return new self(self::ERROR_REQUIRED_PASSWORD);
    }

    public static function getErrorNoAuth()
    {
        return new self(self::ERROR_NO_AUTH);
    }

    public static function gerErrorNoUser()
    {
        return new self(self::ERROR_NO_USER);
    }

    public static function getErrorIpAddressInBlackList()
    {
        return new self(self::ERROR_IP_ADDRESS_IN_BLACK_LIST);
    }

    public static function getErrorCaptcha()
    {
        return new self(self::ERROR_CAPTCHA);
    }

    public static function getErrorRequiredCaptcha()
    {
        return new self(self::ERROR_REQUIRED_CAPTCHA);
    }

    public static function getErrorCaptchaNoEqImages()
    {
        return new self(self::ERROR_CAPTCHA_NOTEQ_IMAGES);
    }

    public static function getErrorCode()
    {
        return new self(self::ERROR_CODE);
    }

    public static function getErrorRequiredCode()
    {
        return new self(self::ERROR_REQUIRED_CODE);
    }
}