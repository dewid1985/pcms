<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-17 09:58:59                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoModuleRubricsGetOperationResponse extends ModuleRubricsResponse
	{
		protected $parentRubricName = null;
		
		public function getParentRubricName()
		{
			return $this->parentRubricName;
		}
		
		/**
		 * @return ModuleRubricsGetOperationResponse
		**/
		public function setParentRubricName($parentRubricName)
		{
			$this->parentRubricName = $parentRubricName;
			
			return $this;
		}
	}
?>