<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-09 08:36:02                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformCommonModuleDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'common.module';
		}
		
		public function getObjectName()
		{
			return 'PlatformCommonModule';
		}
		
		public function getSequence()
		{
			return 'common.module_id';
		}
	}
?>