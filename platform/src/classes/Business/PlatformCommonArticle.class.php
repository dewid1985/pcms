<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-01-26 12:46:59                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformCommonArticle extends AutoPlatformCommonArticle implements Prototyped, DAOConnected
	{
		/**
		 * @return PlatformCommonArticle
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return PlatformCommonArticleDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('PlatformCommonArticleDAO');
		}
		
		/**
		 * @return ProtoPlatformCommonArticle
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoPlatformCommonArticle');
		}
		
		// your brilliant stuff goes here
	}
?>