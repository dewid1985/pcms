<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-27 11:18:06                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformSocialFlowPages extends IdentifiableObject
	{
		protected $flow = null;
		protected $flowId = null;
		protected $page = null;
		protected $pageId = null;
		
		/**
		 * @return PlatformSocialFlow
		**/
		public function getFlow()
		{
			if (!$this->flow && $this->flowId) {
				$this->flow = PlatformSocialFlow::dao()->getById($this->flowId);
			}
			
			return $this->flow;
		}
		
		public function getFlowId()
		{
			return $this->flow
				? $this->flow->getId()
				: $this->flowId;
		}
		
		/**
		 * @return PlatformSocialFlowPages
		**/
		public function setFlow(PlatformSocialFlow $flow)
		{
			$this->flow = $flow;
			$this->flowId = $flow ? $flow->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return PlatformSocialFlowPages
		**/
		public function setFlowId($id)
		{
			$this->flow = null;
			$this->flowId = $id;
			
			return $this;
		}
		
		/**
		 * @return PlatformSocialFlowPages
		**/
		public function dropFlow()
		{
			$this->flow = null;
			$this->flowId = null;
			
			return $this;
		}
		
		/**
		 * @return PlatformSocialAppAdminPage
		**/
		public function getPage()
		{
			if (!$this->page && $this->pageId) {
				$this->page = PlatformSocialAppAdminPage::dao()->getById($this->pageId);
			}
			
			return $this->page;
		}
		
		public function getPageId()
		{
			return $this->page
				? $this->page->getId()
				: $this->pageId;
		}
		
		/**
		 * @return PlatformSocialFlowPages
		**/
		public function setPage(PlatformSocialAppAdminPage $page)
		{
			$this->page = $page;
			$this->pageId = $page ? $page->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return PlatformSocialFlowPages
		**/
		public function setPageId($id)
		{
			$this->page = null;
			$this->pageId = $id;
			
			return $this;
		}
		
		/**
		 * @return PlatformSocialFlowPages
		**/
		public function dropPage()
		{
			$this->page = null;
			$this->pageId = null;
			
			return $this;
		}
	}
?>