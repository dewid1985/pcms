<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 12:01
 */
class MultimediaOperationEnum extends OperationEnum
{
    const
        ADD_IMAGE = 201,
        SEARCH_IMAGES = 202,
        GET_IMAGE = 203,
        CROP_IMAGE = 204,
        GET_PREVIEW = 205;

    protected static $operation = array(
        self::ADD_IMAGE => 'addImage',
        self::SEARCH_IMAGES => 'searchImages',
        self::GET_IMAGE => 'getImage',
        self::CROP_IMAGE => 'cropImage',
        self::GET_PREVIEW => 'getPreview'
    );

    public static function addImage()
    {
        return new self(self::ADD_IMAGE);
    }

    public static function searchImages()
    {
        return new self(self::SEARCH_IMAGES);
    }

    public static function getImage()
    {
        return new self(self::GET_IMAGE);
    }

    public static function cropImage()
    {
        return new self(self::CROP_IMAGE);
    }

    public static function getPreview()
    {
        return new self(self::GET_PREVIEW);
    }
}