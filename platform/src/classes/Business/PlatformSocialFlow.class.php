<?php

/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-27 11:18:06                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/
class PlatformSocialFlow extends AutoPlatformSocialFlow implements Prototyped, DAOConnected
{
    /**
     * @return PlatformSocialFlow
     **/
    public static function create()
    {
        return new self;
    }

    /**
     * @return PlatformSocialFlowDAO
     **/
    public static function dao()
    {
        return Singleton::getInstance('PlatformSocialFlowDAO');
    }

    /**
     * @return ProtoPlatformSocialFlow
     **/
    public static function proto()
    {
        return Singleton::getInstance('ProtoPlatformSocialFlow');
    }

    /**
     * @return PlatformSocialFlowGroups[]
     */
    public function getGroups()
    {
			return  (new PlatformSocialFlowGroups)
                ->dao()->getByFlow($this);
    }

    /**
     * @return PlatformSocialFlowPages[]
     */
    public function getPages()
    {
        return (new PlatformSocialFlowPages())
            ->dao()->getByFlow($this);
    }


    public function updateAccessToken()
    {
        $accessToken = $this->accessToken;

        $this->setAccessToken(md5($accessToken));

        $this->dao()->save($this);
    }
    // your brilliant stuff goes here
}

?>