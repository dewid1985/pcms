<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-01-27 11:24:06                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformCommonArticle extends IdentifiableObject
	{
		protected $project = null;
		protected $projectId = null;
		protected $articleDraft = null;
		protected $articleDraftId = null;
		protected $articlePublished = null;
		protected $articlePublishedId = null;
		protected $createdAt = null;
		protected $publishedAt = null;
		protected $published = null;
		
		/**
		 * @return PlatformCommonProject
		**/
		public function getProject()
		{
			if (!$this->project && $this->projectId) {
				$this->project = PlatformCommonProject::dao()->getById($this->projectId);
			}
			
			return $this->project;
		}
		
		public function getProjectId()
		{
			return $this->project
				? $this->project->getId()
				: $this->projectId;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function setProject(PlatformCommonProject $project)
		{
			$this->project = $project;
			$this->projectId = $project ? $project->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function setProjectId($id)
		{
			$this->project = null;
			$this->projectId = $id;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function dropProject()
		{
			$this->project = null;
			$this->projectId = null;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonArticleDraft
		**/
		public function getArticleDraft()
		{
			if (!$this->articleDraft && $this->articleDraftId) {
				$this->articleDraft = PlatformCommonArticleDraft::dao()->getById($this->articleDraftId);
			}
			
			return $this->articleDraft;
		}
		
		public function getArticleDraftId()
		{
			return $this->articleDraft
				? $this->articleDraft->getId()
				: $this->articleDraftId;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function setArticleDraft(PlatformCommonArticleDraft $articleDraft = null)
		{
			$this->articleDraft = $articleDraft;
			$this->articleDraftId = $articleDraft ? $articleDraft->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function setArticleDraftId($id = null)
		{
			$this->articleDraft = null;
			$this->articleDraftId = $id;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function dropArticleDraft()
		{
			$this->articleDraft = null;
			$this->articleDraftId = null;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonArticlePublished
		**/
		public function getArticlePublished()
		{
			if (!$this->articlePublished && $this->articlePublishedId) {
				$this->articlePublished = PlatformCommonArticlePublished::dao()->getById($this->articlePublishedId);
			}
			
			return $this->articlePublished;
		}
		
		public function getArticlePublishedId()
		{
			return $this->articlePublished
				? $this->articlePublished->getId()
				: $this->articlePublishedId;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function setArticlePublished(PlatformCommonArticlePublished $articlePublished = null)
		{
			$this->articlePublished = $articlePublished;
			$this->articlePublishedId = $articlePublished ? $articlePublished->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function setArticlePublishedId($id = null)
		{
			$this->articlePublished = null;
			$this->articlePublishedId = $id;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function dropArticlePublished()
		{
			$this->articlePublished = null;
			$this->articlePublishedId = null;
			
			return $this;
		}
		
		/**
		 * @return TimestampTZ
		**/
		public function getCreatedAt()
		{
			return $this->createdAt;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function setCreatedAt(TimestampTZ $createdAt = null)
		{
			$this->createdAt = $createdAt;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function dropCreatedAt()
		{
			$this->createdAt = null;
			
			return $this;
		}
		
		/**
		 * @return TimestampTZ
		**/
		public function getPublishedAt()
		{
			return $this->publishedAt;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function setPublishedAt(TimestampTZ $publishedAt = null)
		{
			$this->publishedAt = $publishedAt;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function dropPublishedAt()
		{
			$this->publishedAt = null;
			
			return $this;
		}
		
		public function getPublished()
		{
			return $this->published;
		}
		
		public function isPublished()
		{
			return $this->published;
		}
		
		/**
		 * @return PlatformCommonArticle
		**/
		public function setPublished($published = null)
		{
			Assert::isTernaryBase($published);
			
			$this->published = $published;
			
			return $this;
		}
	}
?>