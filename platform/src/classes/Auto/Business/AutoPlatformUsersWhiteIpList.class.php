<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-22 08:28:40                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformUsersWhiteIpList extends IdentifiableObject
	{
		protected $ipAddress = null;
		protected $active = true;
		
		public function getIpAddress()
		{
			return $this->ipAddress;
		}
		
		/**
		 * @return PlatformUsersWhiteIpList
		**/
		public function setIpAddress($ipAddress)
		{
			$this->ipAddress = $ipAddress;
			
			return $this;
		}
		
		public function getActive()
		{
			return $this->active;
		}
		
		public function isActive()
		{
			return $this->active;
		}
		
		/**
		 * @return PlatformUsersWhiteIpList
		**/
		public function setActive($active = null)
		{
			Assert::isTernaryBase($active);
			
			$this->active = $active;
			
			return $this;
		}
	}
?>