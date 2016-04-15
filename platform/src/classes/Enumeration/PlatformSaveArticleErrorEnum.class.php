<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.01.15
 * Time: 11:34
 */
class PlatformSaveArticleErrorEnum extends Enum
{
    const
        ERROR_REQUIRED_TITLE = 1,
        ERROR_REQUIRED_ANONS = 2,
        ERROR_REQUIRED_TEXT = 3,
        ERROR_REQUIRED_PUBLISHED_AT = 4,
        ERROR_REQUIRED_RUBRIC = 5,
        ERROR_META_DESCRIPTION = 6,
        ERROR_REQUIRED_META_DESCRIPTION = 7,
        ERROR_META_KEYWORDS = 8,
        ERROR_REQUIRED_META_KEYWORDS = 9,
        ERROR_REQUIRED_AUTHOR = 10
    ;

    protected static $names = array(
        self::ERROR_REQUIRED_TITLE => "Не заполненно поле `title`",
        self::ERROR_REQUIRED_ANONS => "Не заполненно поле `anons`",
        self::ERROR_REQUIRED_TEXT => "Не заполненно поле `Содержимое статьи`",
        self::ERROR_REQUIRED_PUBLISHED_AT => "Не заполненно поле `Время публикации статьи`",
        self::ERROR_REQUIRED_RUBRIC => "Статья должна быть привязанна хотя бы к одной рубрики",
        self::ERROR_META_DESCRIPTION => "Поле `description` не должно превышать 256 символов",
        self::ERROR_REQUIRED_META_DESCRIPTION => "Поле `description` обязательно для заполнения",
        self::ERROR_META_KEYWORDS => "Поле `meta_keywords` не должно превышать 256 символов",
        self::ERROR_REQUIRED_META_KEYWORDS => "Поле `meta_keywords` обязательно для заполнения",
        self::ERROR_REQUIRED_AUTHOR => "Полей `author` обязательно для заполнения"

    );

    public static function getErrorRequiredTitle()
    {
        return new self(self::ERROR_REQUIRED_TITLE);
    }

    public static function getErrorRequiredAnons()
    {
        return new self(self::ERROR_REQUIRED_ANONS);
    }

    public static function getErrorRequiredText()
    {
        return new self(self::ERROR_REQUIRED_TEXT);
    }

    public static function getErrorRequiredPublishedAt()
    {
        return new self(self::ERROR_REQUIRED_PUBLISHED_AT);
    }

    public static function getErrorRequiredRubric()
    {
        return new self(self::ERROR_REQUIRED_RUBRIC);
    }

    public static function getErrorMetaDescription()
    {
        return new self(self::ERROR_META_DESCRIPTION);
    }

    public static function getErrorRequiredMetaDescription()
    {
        return new self(self::ERROR_REQUIRED_META_DESCRIPTION);
    }

    public static function getErrorMetaKeywords()
    {
        return new self(self::ERROR_META_KEYWORDS);
    }

    public static function getErrorRequiredMetaKeywords()
    {
        return new self(self::ERROR_REQUIRED_META_KEYWORDS);
    }

    public static function getErrorRequiredAuthor()
    {
        return new self(self::ERROR_REQUIRED_AUTHOR);
    }

}