<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-09 10:42:04                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformCommonNewsPublished extends IdentifiableObject
	{
		protected $admin = null;
		protected $adminId = null;
		protected $title = null;
		protected $anons = null;
		protected $text = null;
		protected $metaDescription = null;
		protected $metaKeywords = null;
		protected $rubrics = null;
		protected $modifiedAt = null;
		protected $preview = null;
		
		/**
		 * @return PlatformUsersAdmin
		**/
		public function getAdmin()
		{
			if (!$this->admin && $this->adminId) {
				$this->admin = PlatformUsersAdmin::dao()->getById($this->adminId);
			}
			
			return $this->admin;
		}
		
		public function getAdminId()
		{
			return $this->admin
				? $this->admin->getId()
				: $this->adminId;
		}
		
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public function setAdmin(PlatformUsersAdmin $admin = null)
		{
			$this->admin = $admin;
			$this->adminId = $admin ? $admin->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public function setAdminId($id = null)
		{
			$this->admin = null;
			$this->adminId = $id;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public function dropAdmin()
		{
			$this->admin = null;
			$this->adminId = null;
			
			return $this;
		}
		
		public function getTitle()
		{
			return $this->title;
		}
		
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public function setTitle($title)
		{
			$this->title = $title;
			
			return $this;
		}
		
		public function getAnons()
		{
			return $this->anons;
		}
		
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public function setAnons($anons)
		{
			$this->anons = $anons;
			
			return $this;
		}
		
		public function getText()
		{
			return $this->text;
		}
		
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public function setText($text)
		{
			$this->text = $text;
			
			return $this;
		}
		
		public function getMetaDescription()
		{
			return $this->metaDescription;
		}
		
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public function setMetaDescription($metaDescription)
		{
			$this->metaDescription = $metaDescription;
			
			return $this;
		}
		
		public function getMetaKeywords()
		{
			return $this->metaKeywords;
		}
		
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public function setMetaKeywords($metaKeywords)
		{
			$this->metaKeywords = $metaKeywords;
			
			return $this;
		}
		
		/**
		 * @return Hstore
		**/
		public function getRubrics()
		{
			return $this->rubrics;
		}
		
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public function setRubrics(Hstore $rubrics = null)
		{
			$this->rubrics = $rubrics;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public function dropRubrics()
		{
			$this->rubrics = null;
			
			return $this;
		}
		
		/**
		 * @return TimestampTZ
		**/
		public function getModifiedAt()
		{
			return $this->modifiedAt;
		}
		
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public function setModifiedAt(TimestampTZ $modifiedAt = null)
		{
			$this->modifiedAt = $modifiedAt;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public function dropModifiedAt()
		{
			$this->modifiedAt = null;
			
			return $this;
		}
		
		public function getPreview()
		{
			return $this->preview;
		}
		
		/**
		 * @return PlatformCommonNewsPublished
		**/
		public function setPreview($preview)
		{
			$this->preview = $preview;
			
			return $this;
		}
	}
?>