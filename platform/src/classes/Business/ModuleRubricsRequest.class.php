<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-12 16:21:58                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class ModuleRubricsRequest extends AutoModuleRubricsRequest implements Prototyped
	{
		/**
		 * @return ModuleRubricsRequest
		**/
		public static function create()
		{
			return new self;
		}
		
		
		/**
		 * @return ProtoModuleRubricsRequest
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoModuleRubricsRequest');
		}
		
		// your brilliant stuff goes here
	}
?>