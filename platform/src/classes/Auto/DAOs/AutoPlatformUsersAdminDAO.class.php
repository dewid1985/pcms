<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-09 09:45:08                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformUsersAdminDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'users.admin';
		}
		
		public function getObjectName()
		{
			return 'PlatformUsersAdmin';
		}
		
		public function getSequence()
		{
			return 'users.admin_id';
		}
	}
?>