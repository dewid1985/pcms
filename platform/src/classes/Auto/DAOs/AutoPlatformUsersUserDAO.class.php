<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-08 10:10:45                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformUsersUserDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'users.user';
		}
		
		public function getObjectName()
		{
			return 'PlatformUsersUser';
		}
		
		public function getSequence()
		{
			return 'users.user_id';
		}
	}
?>