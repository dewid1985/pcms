<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-03-16 08:51:34                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformMultimediaCroppedImages extends AutoPlatformMultimediaCroppedImages implements Prototyped, DAOConnected
	{
		/**
		 * @return PlatformMultimediaCroppedImages
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return PlatformMultimediaCroppedImagesDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('PlatformMultimediaCroppedImagesDAO');
		}
		
		/**
		 * @return ProtoPlatformMultimediaCroppedImages
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoPlatformMultimediaCroppedImages');
		}
		
		// your brilliant stuff goes here
	}
?>