<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-09 11:45:16                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformUsersRole extends IdentifiableObject
	{
		protected $name = null;
		
		public function getName()
		{
			return $this->name;
		}
		
		/**
		 * @return PlatformUsersRole
		**/
		public function setName($name)
		{
			$this->name = $name;
			
			return $this;
		}
	}
?>