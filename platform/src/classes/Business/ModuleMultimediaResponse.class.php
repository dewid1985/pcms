<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-03-11 11:20:41                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class ModuleMultimediaResponse extends AutoModuleMultimediaResponse implements Prototyped
	{
		/**
		 * @return ModuleMultimediaResponse
		**/
		public static function create()
		{
			return new self;
		}
		
		
		/**
		 * @return ProtoModuleMultimediaResponse
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoModuleMultimediaResponse');
		}
		
		// your brilliant stuff goes here
	}
?>