<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-16 09:51:21                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoModuleRubricsSearchOperationsResponse extends ModuleRubricsResponse
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
		 * @return ModuleRubricsSearchOperationsResponse
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
		 * @return ModuleRubricsSearchOperationsResponse
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
		 * @return ModuleRubricsSearchOperationsResponse
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
		 * @return ModuleRubricsSearchOperationsResponse
		**/
		public function setData($data)
		{
			$this->data = $data;
			
			return $this;
		}
	}
?>