<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-03-23 14:04:39                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformMultimediaImages extends IdentifiableObject
	{
		protected $name = null;
		protected $title = null;
		protected $description = null;
		protected $tags = null;
		protected $mimeType = null;
		protected $sourceFile = null;
		protected $preparedFile = null;
		protected $icoFile = null;
		protected $uploadedAt = null;
		protected $rootDirectory = null;
		
		public function getName()
		{
			return $this->name;
		}
		
		/**
		 * @return PlatformMultimediaImages
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
		 * @return PlatformMultimediaImages
		**/
		public function setTitle($title)
		{
			$this->title = $title;
			
			return $this;
		}
		
		public function getDescription()
		{
			return $this->description;
		}
		
		/**
		 * @return PlatformMultimediaImages
		**/
		public function setDescription($description)
		{
			$this->description = $description;
			
			return $this;
		}
		
		public function getTags()
		{
			return $this->tags;
		}
		
		/**
		 * @return PlatformMultimediaImages
		**/
		public function setTags($tags)
		{
			$this->tags = $tags;
			
			return $this;
		}
		
		public function getMimeType()
		{
			return $this->mimeType;
		}
		
		/**
		 * @return PlatformMultimediaImages
		**/
		public function setMimeType($mimeType)
		{
			$this->mimeType = $mimeType;
			
			return $this;
		}
		
		public function getSourceFile()
		{
			return $this->sourceFile;
		}
		
		/**
		 * @return PlatformMultimediaImages
		**/
		public function setSourceFile($sourceFile)
		{
			$this->sourceFile = $sourceFile;
			
			return $this;
		}
		
		public function getPreparedFile()
		{
			return $this->preparedFile;
		}
		
		/**
		 * @return PlatformMultimediaImages
		**/
		public function setPreparedFile($preparedFile)
		{
			$this->preparedFile = $preparedFile;
			
			return $this;
		}
		
		public function getIcoFile()
		{
			return $this->icoFile;
		}
		
		/**
		 * @return PlatformMultimediaImages
		**/
		public function setIcoFile($icoFile)
		{
			$this->icoFile = $icoFile;
			
			return $this;
		}
		
		/**
		 * @return TimestampTZ
		**/
		public function getUploadedAt()
		{
			return $this->uploadedAt;
		}
		
		/**
		 * @return PlatformMultimediaImages
		**/
		public function setUploadedAt(TimestampTZ $uploadedAt = null)
		{
			$this->uploadedAt = $uploadedAt;
			
			return $this;
		}
		
		/**
		 * @return PlatformMultimediaImages
		**/
		public function dropUploadedAt()
		{
			$this->uploadedAt = null;
			
			return $this;
		}
		
		public function getRootDirectory()
		{
			return $this->rootDirectory;
		}
		
		/**
		 * @return PlatformMultimediaImages
		**/
		public function setRootDirectory($rootDirectory)
		{
			$this->rootDirectory = $rootDirectory;
			
			return $this;
		}
	}
?>