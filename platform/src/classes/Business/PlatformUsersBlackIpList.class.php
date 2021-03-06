<?php

/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-12 11:36:30                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/
class PlatformUsersBlackIpList extends AutoPlatformUsersBlackIpList implements Prototyped, DAOConnected
{
    /**
     * @return PlatformUsersBlackIpList
     **/
    public static function create()
    {
        return new self;
    }

    /**
     * @return PlatformUsersBlackIpListDAO
     **/
    public static function dao()
    {
        return Singleton::getInstance('PlatformUsersBlackIpListDAO');
    }

    /**
     * @return ProtoPlatformUsersBlackIpList
     **/
    public static function proto()
    {
        return Singleton::getInstance('ProtoPlatformUsersBlackIpList');
    }

    // your brilliant stuff goes here
    public static function isBlackListIp($ip)
    {

        try {
            if (
                TimestampTZ::compare(
                    TimestampTZ::makeNow(),
                    self::dao()->getByIpAndActive($ip)->getExpires()
                ) < 0
            ) {
                return true;
            };

            self::dao()->save(
                self::dao()->getByIpAndActive($ip)->setActive(FALSE)
            );

            return false;

        } catch (ObjectNotFoundException $e) {
            /**  */
        }
        return false;
    }

    public static function getIdByIp($ip)
    {
        try {
            return self::dao()->getByIpAndActive($ip)->getId();
        } catch (ObjectNotFoundException $e) {
            /**  */
        }
        return null;
    }

    public static function addIp($ip, TimestampTZ $expires, $active = TRUE)
    {
        try {
            self::dao()->add(
                self::create()
                    ->setActive($active)
                    ->setExpires($expires)
                    ->setIpAddress($ip)
            );
        } catch (BaseException $e) {
            /**  */
        }
    }
}

?>