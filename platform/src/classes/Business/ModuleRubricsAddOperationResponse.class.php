<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-12 16:31:04                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class ModuleRubricsAddOperationResponse extends AutoModuleRubricsAddOperationResponse implements Prototyped
	{
		/**
		 * @return ModuleRubricsAddOperationResponse
		**/
		public static function create()
		{
			return new self;
		}
		
		
		/**
		 * @return ProtoModuleRubricsAddOperationResponse
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoModuleRubricsAddOperationResponse');
		}
		
		// your brilliant stuff goes here
	}
?>