<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-08 12:16:28                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformUsersAuthCommonDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'users.auth_common';
		}
		
		public function getObjectName()
		{
			return 'PlatformUsersAuthCommon';
		}
		
		public function getSequence()
		{
			return 'users.auth_common_id';
		}
	}
?>