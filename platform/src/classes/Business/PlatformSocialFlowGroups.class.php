<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-27 11:18:06                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformSocialFlowGroups extends AutoPlatformSocialFlowGroups implements Prototyped, DAOConnected
	{
		/**
		 * @return PlatformSocialFlowGroups
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return PlatformSocialFlowGroupsDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('PlatformSocialFlowGroupsDAO');
		}
		
		/**
		 * @return ProtoPlatformSocialFlowGroups
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoPlatformSocialFlowGroups');
		}
		
		// your brilliant stuff goes here
	}
?>