<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-09 11:24:40                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformUsersAdminRoleDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'users.admin_role';
		}
		
		public function getObjectName()
		{
			return 'PlatformUsersAdminRole';
		}
		
		public function getSequence()
		{
			return 'users.admin_role_id';
		}
	}
?>