<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-16 09:51:21                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class ModuleRubricsSearchOperationsResponse extends AutoModuleRubricsSearchOperationsResponse implements Prototyped
	{
		/**
		 * @return ModuleRubricsSearchOperationsResponse
		**/
		public static function create()
		{
			return new self;
		}
		
		
		/**
		 * @return ProtoModuleRubricsSearchOperationsResponse
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoModuleRubricsSearchOperationsResponse');
		}
		
		// your brilliant stuff goes here
	}
?>