<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-17 14:57:10                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoModuleRubricsSaveOperationRequest extends ModuleRubricsRequest
	{
		protected $parent = null;
		
		public function getParent()
		{
			return $this->parent;
		}
		
		/**
		 * @return ModuleRubricsSaveOperationRequest
		**/
		public function setParent($parent)
		{
			$this->parent = $parent;
			
			return $this;
		}
	}
?>