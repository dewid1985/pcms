<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-13 09:36:08                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoModuleRubricsGetAllListOperationResponse extends ModuleRubricsRequest
	{
		protected $data = null;
		
		public function getData()
		{
			return $this->data;
		}
		
		/**
		 * @return ModuleRubricsGetAllListOperationResponse
		**/
		public function setData($data)
		{
			$this->data = $data;
			
			return $this;
		}
	}
?>