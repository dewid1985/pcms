<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-28 13:42:23                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformSocialPublishedLink extends AutoPlatformSocialPublishedLink implements Prototyped, DAOConnected
	{
		/**
		 * @return PlatformSocialPublishedLink
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return PlatformSocialPublishedLinkDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('PlatformSocialPublishedLinkDAO');
		}
		
		/**
		 * @return ProtoPlatformSocialPublishedLink
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoPlatformSocialPublishedLink');
		}
		
		// your brilliant stuff goes here
	}
?>