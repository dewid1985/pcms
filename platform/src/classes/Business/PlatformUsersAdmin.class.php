<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-09 09:45:08                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformUsersAdmin extends AutoPlatformUsersAdmin implements Prototyped, DAOConnected
	{
		/**
		 * @return PlatformUsersAdmin
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return PlatformUsersAdminDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('PlatformUsersAdminDAO');
		}
		
		/**
		 * @return ProtoPlatformUsersAdmin
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoPlatformUsersAdmin');
		}
		
		// your brilliant stuff goes here
	}
?>