<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-09 10:42:04                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformCommonNewsDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'common.news';
		}
		
		public function getObjectName()
		{
			return 'PlatformCommonNews';
		}
		
		public function getSequence()
		{
			return 'common.news_id';
		}
	}
?>