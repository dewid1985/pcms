<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-12 16:19:56                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class ModuleRubricsResponse extends AutoModuleRubricsResponse implements Prototyped
	{
		/**
		 * @return ModuleRubricsResponse
		**/
		public static function create()
		{
			return new self;
		}
		
		
		/**
		 * @return ProtoModuleRubricsResponse
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoModuleRubricsResponse');
		}
		
		// your brilliant stuff goes here
	}
?>