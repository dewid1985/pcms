<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 09.01.16
 * Time: 12:53
 */
class ServiceExceptionEnum extends Enum
{
    const
        NO_ACCESS_TOKEN = 1,
        NO_GROUP_ID = 2,
        NO_SUPPORT_MIME = 3,
        NO_SAVED_FILE = 4,
        NO_SAVED_WALL_FILE = 5,
        NO_WALL_MESSAGES = 6;

    protected static $names = [
        self::NO_ACCESS_TOKEN => 'No access token',
        self::NO_GROUP_ID => 'No group please set group id',
        self::NO_SUPPORT_MIME => 'Does not support mime type',
        self::NO_SAVED_FILE => 'File has not been saved to the server',
        self::NO_SAVED_WALL_FILE => 'Not preserved on the wall',
        self::NO_WALL_MESSAGES => 'No message for wall'
    ];

    public static function noAccessToken()
    {
        return new self(self::NO_ACCESS_TOKEN);
    }

    public static function noGroup()
    {
        return new self(self::NO_GROUP_ID);
    }

    public static function noSaveFile()
    {
        return new self(self::NO_SAVED_FILE);
    }

    public static function noSavedWallFile()
    {
        return new self(self::NO_SAVED_WALL_FILE);
    }

    public static function noSupportMime()
    {
        return new self(self::NO_SUPPORT_MIME);
    }

    public static function noWallMessages()
    {
        return new self(self::NO_WALL_MESSAGES);
    }

    public function getErrorMsg()
    {
        return parent::getName();
    }

    public function getErrorCode()
    {
        return parent::getId();
    }

}