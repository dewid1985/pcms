<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-03-20 11:37:42                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformMultimediaImagesSize extends IdentifiableObject
	{
		protected $name = null;
		protected $title = null;
		protected $width = null;
		protected $height = null;
		
		public function getName()
		{
			return $this->name;
		}
		
		/**
		 * @return PlatformMultimediaImagesSize
		**/
		public function setName($name)
		{
			$this->name = $name;
			
			return $this;
		}
		
		public function getTitle()
		{
			return $this->title;
		}
		
		/**
		 * @return PlatformMultimediaImagesSize
		**/
		public function setTitle($title)
		{
			$this->title = $title;
			
			return $this;
		}
		
		public function getWidth()
		{
			return $this->width;
		}
		
		/**
		 * @return PlatformMultimediaImagesSize
		**/
		public function setWidth($width)
		{
			$this->width = $width;
			
			return $this;
		}
		
		public function getHeight()
		{
			return $this->height;
		}
		
		/**
		 * @return PlatformMultimediaImagesSize
		**/
		public function setHeight($height)
		{
			$this->height = $height;
			
			return $this;
		}
	}
?>