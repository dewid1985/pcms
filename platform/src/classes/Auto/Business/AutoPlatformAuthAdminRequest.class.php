<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-16 07:20:34                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformAuthAdminRequest extends PlatformBaseRequest
	{
		protected $login = null;
		protected $md5Password = null;
		protected $userIp = null;
		
		public function getLogin()
		{
			return $this->login;
		}
		
		/**
		 * @return PlatformAuthAdminRequest
		**/
		public function setLogin($login)
		{
			$this->login = $login;
			
			return $this;
		}
		
		public function getMd5Password()
		{
			return $this->md5Password;
		}
		
		/**
		 * @return PlatformAuthAdminRequest
		**/
		public function setMd5Password($md5Password)
		{
			$this->md5Password = $md5Password;
			
			return $this;
		}
		
		public function getUserIp()
		{
			return $this->userIp;
		}
		
		/**
		 * @return PlatformAuthAdminRequest
		**/
		public function setUserIp($userIp)
		{
			$this->userIp = $userIp;
			
			return $this;
		}
	}
?>