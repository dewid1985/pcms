<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-01-26 12:46:59                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformCommonArticleDraft extends AutoPlatformCommonArticleDraft implements Prototyped, DAOConnected
	{
		/**
		 * @return PlatformCommonArticleDraft
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return PlatformCommonArticleDraftDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('PlatformCommonArticleDraftDAO');
		}
		
		/**
		 * @return ProtoPlatformCommonArticleDraft
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoPlatformCommonArticleDraft');
		}
		
		// your brilliant stuff goes here
	}
?>