<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-23 11:20:04                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformUsersAdminCodeTypeEnum extends Enum
	{
        const
            SMS_SERVICES  = 1,
            XMPP_SERVICES =2
        ;

		// implement me!
		protected static $names = array(
            self::SMS_SERVICES => 'PlatformSendSmsProcessor'
        );

        public static function smsServices()
        {
            return new self(self::SMS_SERVICES);
        }
	}
?>