<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-03-17 13:14:01                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class ModuleMultimediaSearchOperationRequest extends AutoModuleMultimediaSearchOperationRequest implements Prototyped
	{
		/**
		 * @return ModuleMultimediaSearchOperationRequest
		**/
		public static function create()
		{
			return new self;
		}
		
		
		/**
		 * @return ProtoModuleMultimediaSearchOperationRequest
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoModuleMultimediaSearchOperationRequest');
		}
		
		// your brilliant stuff goes here
	}
?>