<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-11 13:06:50                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformAuthAdminResponse extends PlatformBaseResponse
	{
		protected $result = false;
		
		public function getResult()
		{
			return $this->result;
		}
		
		public function isResult()
		{
			return $this->result;
		}
		
		/**
		 * @return PlatformAuthAdminResponse
		**/
		public function setResult($result = false)
		{
			$this->result = ($result === true);
			
			return $this;
		}
	}
?>