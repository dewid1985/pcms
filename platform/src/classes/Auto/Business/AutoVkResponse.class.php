<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-11 09:20:59                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoVkResponse
	{
		protected $method = null;
		protected $postId = null;
		
		public function getMethod()
		{
			return $this->method;
		}
		
		/**
		 * @return VkResponse
		**/
		public function setMethod($method)
		{
			$this->method = $method;
			
			return $this;
		}
		
		public function getPostId()
		{
			return $this->postId;
		}
		
		/**
		 * @return VkResponse
		**/
		public function setPostId($postId)
		{
			$this->postId = $postId;
			
			return $this;
		}
	}
?>