<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-08 13:25:11                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformUsersUserRegistrationFactsDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'users.user_registration_facts';
		}
		
		public function getObjectName()
		{
			return 'PlatformUsersUserRegistrationFacts';
		}
		
		public function getSequence()
		{
			return 'users.user_registration_facts_id';
		}
	}
?>