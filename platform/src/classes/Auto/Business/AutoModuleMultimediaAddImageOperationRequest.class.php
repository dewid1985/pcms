<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-03-17 13:14:01                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoModuleMultimediaAddImageOperationRequest extends ModuleMultimediaRequest
	{
		protected $images = null;
		
		public function getImages()
		{
			return $this->images;
		}
		
		/**
		 * @return ModuleMultimediaAddImageOperationRequest
		**/
		public function setImages($images)
		{
			$this->images = $images;
			
			return $this;
		}
	}
?>