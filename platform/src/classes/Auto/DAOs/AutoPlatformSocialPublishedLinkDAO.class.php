<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-28 13:42:23                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformSocialPublishedLinkDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'social.published_link';
		}
		
		public function getObjectName()
		{
			return 'PlatformSocialPublishedLink';
		}
		
		public function getSequence()
		{
			return 'social.published_link_id';
		}
	}
?>