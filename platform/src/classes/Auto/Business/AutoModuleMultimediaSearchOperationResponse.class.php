<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-03-17 13:31:11                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoModuleMultimediaSearchOperationResponse extends ModuleMultimediaResponse
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
		 * @return ModuleMultimediaSearchOperationResponse
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
		 * @return ModuleMultimediaSearchOperationResponse
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
		 * @return ModuleMultimediaSearchOperationResponse
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
		 * @return ModuleMultimediaSearchOperationResponse
		**/
		public function setData($data)
		{
			$this->data = $data;
			
			return $this;
		}
	}
?>