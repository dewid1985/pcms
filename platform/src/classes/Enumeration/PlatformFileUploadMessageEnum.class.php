<?php

class PlatformFileUploadMessageEnum extends Enum
{
    const
        ERROR_IMAGE_MIME_TYPE = 1,
        ERROR_REQUIRED_IMAGE = 2,
        ERROR_REQUIRED_NAME = 3,
        ERROR_REQUIRED_DESCRIPTION = 4,
        ERROR_REQUIRED_TAGS = 5,
        ERROR_UPLOAD_IMAGE = 6
        ;

    protected static $names = array(
        self::ERROR_IMAGE_MIME_TYPE => 'Не изображение, изображение должно быть расширением `gif`, `jpeg`, `png`',
        self::ERROR_REQUIRED_IMAGE => 'Не выбранно изображение',
        self::ERROR_REQUIRED_NAME => 'Не заполненно поле `Название фото`',
        self::ERROR_REQUIRED_DESCRIPTION => 'Не заполнено поле `Описание`',
        self::ERROR_REQUIRED_TAGS => 'Не заполненно поле `Теги`',
        self::ERROR_UPLOAD_IMAGE=> 'Ошибка загрузки изображения'

    );

    public static function getErrorRequiredImage()
    {
        return new self(self::ERROR_REQUIRED_IMAGE);
    }

    public static function getErrorImageMimeType()
    {
        return new self(self::ERROR_IMAGE_MIME_TYPE);
    }

    public static function getErrorRequiredName()
    {
        return new self(self::ERROR_REQUIRED_NAME);
    }

    public static function getErrorRequiredDescription()
    {
        return new self(self::ERROR_REQUIRED_DESCRIPTION);
    }

    public static function getErrorRequiredTags()
    {
        return new self(self::ERROR_REQUIRED_TAGS);
    }

    public static function getErrorUploadImage()
    {
        return new self(self::ERROR_UPLOAD_IMAGE);
    }

    public function getMessage()
    {
        return parent::getName();
    }
}