<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-09 09:15:21                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformCommonProjectModuleDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'common.project_module';
		}
		
		public function getObjectName()
		{
			return 'PlatformCommonProjectModule';
		}
		
		public function getSequence()
		{
			return 'common.project_module_id';
		}
	}
?>