<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-01-29 12:25:59                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoModuleArticleSearchOperationResponse extends ModuleArticleResponse
	{
		protected $draw = null;
		protected $recordsTotal = null;
		protected $recordsFiltered = null;
		protected $data = null;
		
		public function getDraw()
		{
			return $this->draw;
		}
		
		/**
		 * @return ModuleArticleSearchOperationResponse
		**/
		public function setDraw($draw)
		{
			$this->draw = $draw;
			
			return $this;
		}
		
		public function getRecordsTotal()
		{
			return $this->recordsTotal;
		}
		
		/**
		 * @return ModuleArticleSearchOperationResponse
		**/
		public function setRecordsTotal($recordsTotal)
		{
			$this->recordsTotal = $recordsTotal;
			
			return $this;
		}
		
		public function getRecordsFiltered()
		{
			return $this->recordsFiltered;
		}
		
		/**
		 * @return ModuleArticleSearchOperationResponse
		**/
		public function setRecordsFiltered($recordsFiltered)
		{
			$this->recordsFiltered = $recordsFiltered;
			
			return $this;
		}
		
		public function getData()
		{
			return $this->data;
		}
		
		/**
		 * @return ModuleArticleSearchOperationResponse
		**/
		public function setData($data)
		{
			$this->data = $data;
			
			return $this;
		}
	}
?>