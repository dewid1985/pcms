<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-09 10:42:04                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformCommonNewsPublished extends AutoPlatformCommonNewsPublished implements Prototyped, DAOConnected
	{
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return PlatformCommonNewsPublishedDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('PlatformCommonNewsPublishedDAO');
		}
		
		/**
		 * @return ProtoPlatformCommonNewsPublished
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoPlatformCommonNewsPublished');
		}
		
		// your brilliant stuff goes here
	}
?>