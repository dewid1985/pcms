<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-01-28 08:56:49                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class ModuleArticleSaveOperationResponse extends AutoModuleArticleSaveOperationResponse implements Prototyped
	{
		/**
		 * @return ModuleArticleSaveOperationResponse
		**/
		public static function create()
		{
			return new self;
		}
		
		
		/**
		 * @return ProtoModuleArticleSaveOperationResponse
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoModuleArticleSaveOperationResponse');
		}
		
		// your brilliant stuff goes here
	}
?>