<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-01-26 12:46:59                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformCommonArticlePublished extends AutoPlatformCommonArticlePublished implements Prototyped, DAOConnected
	{
		/**
		 * @return PlatformCommonArticlePublished
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return PlatformCommonArticlePublishedDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('PlatformCommonArticlePublishedDAO');
		}
		
		/**
		 * @return ProtoPlatformCommonArticlePublished
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoPlatformCommonArticlePublished');
		}
		
		// your brilliant stuff goes here
	}
?>