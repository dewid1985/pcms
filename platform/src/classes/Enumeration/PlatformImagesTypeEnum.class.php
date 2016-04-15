<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.03.15
 * Time: 14:22
 */
class PlatformImagesTypeEnum extends Enum
{
    const
        IMAGE_SOURCE = 1,
        IMAGE_PREPARED = 2,
        IMAGE_ICO = 3
    ;

    protected static $names = array(
        self::IMAGE_SOURCE => 'source',
        self::IMAGE_PREPARED => 'prepared',
        self::IMAGE_ICO => 'ico'
    );


    public static function prepared()
    {
        return new self(self::IMAGE_PREPARED);
    }

    public static function source()
    {
        return new self(self::IMAGE_SOURCE);
    }

    public static function ico()
    {
        return new self(self::IMAGE_ICO);
    }
}