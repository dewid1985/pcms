<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11.02.15
 * Time: 16:37
 */
class PlatformRubricErrorEnum extends Enum
{
    const
        ERROR_REQUIRED_SHORT_NAME = 1,
        ERROR_REQUIRED_NAME = 2,
        ERROR_LATIN_ALPHABET_NAME = 3,
        ERROR_REQUIRED_DESCRIPTION = 4,
        ERROR_REQUIRED_META_DESCRIPTION = 5,
        ERROR_REQUIRED_META_KEYWORDS = 6,
        ERROR_REQUIRED_PARENT = 7,
        THERE_IS_A_RUBRIC = 8,
        FAILURE_SAVE = 9
    ;


    protected static $names = [
        self::ERROR_REQUIRED_SHORT_NAME => 'Поле `Название рубрики` обязательно для заполнения',
        self::ERROR_REQUIRED_NAME => 'Поле `Псевдоним` обязательно для заполнения',
        self::ERROR_LATIN_ALPHABET_NAME => 'Поле `Псевдоним` должно состоять только из букв латинского алфавита',
        self::ERROR_REQUIRED_DESCRIPTION => 'Поле `Описание` обязательно для заполнения',
        self::ERROR_REQUIRED_META_DESCRIPTION => 'Поле `Ключевая фраза` обязательно для заполнения',
        self::ERROR_REQUIRED_META_KEYWORDS => 'Поле `Ключевые слова` обязательно для заполнения',
        self::ERROR_REQUIRED_PARENT => 'Не выбранно поле `Родительская рубрика`',
        self::THERE_IS_A_RUBRIC => 'Рубрика уже существует',
        self::FAILURE_SAVE => "Текущию рубрику нельзя сохранить в подрубрике!!!"
    ];

    public static function getErrorRequiredShortName()
    {
        return new self(self::ERROR_REQUIRED_SHORT_NAME);
    }

    public static function getErrorRequiredName()
    {
        return new self (self::ERROR_REQUIRED_NAME);
    }

    public static function getErrorLatinAlphabetName()
    {
        return new self(self::ERROR_LATIN_ALPHABET_NAME);
    }

    public static function getErrorRequiredDescription()
    {
        return new self(self::ERROR_REQUIRED_DESCRIPTION);
    }

    public static function getErrorRequiredMetaDescription()
    {
        return new self(self::ERROR_REQUIRED_META_DESCRIPTION);
    }

    public static function getErrorRequiredMetaKeywords()
    {
        return new self(self::ERROR_REQUIRED_META_KEYWORDS);
    }

    public static function getErrorRequiredParent()
    {
        return new self(self::ERROR_REQUIRED_PARENT);
    }

    public static function thereIsRubric()
    {
        return new self(self::THERE_IS_A_RUBRIC);
    }

    public static function failure()
    {
        return new self(self::FAILURE_SAVE);
    }
}