<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-01-26 15:09:04                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class ModuleArticleSaveOperationRequest extends AutoModuleArticleSaveOperationRequest implements Prototyped
	{
		/**
		 * @return ModuleArticleSaveOperationRequest
		**/
		public static function create()
		{
			return new self;
		}
		
		
		/**
		 * @return ProtoModuleArticleSaveOperationRequest
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoModuleArticleSaveOperationRequest');
		}
		
		// your brilliant stuff goes here
	}
?>