<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-08 11:57:41                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformUsersAuthType extends AutoPlatformUsersAuthType implements Prototyped, DAOConnected
	{
		/**
		 * @return PlatformUsersAuthType
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return PlatformUsersAuthTypeDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('PlatformUsersAuthTypeDAO');
		}
		
		/**
		 * @return ProtoPlatformUsersAuthType
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoPlatformUsersAuthType');
		}
		
		// your brilliant stuff goes here
	}
?>