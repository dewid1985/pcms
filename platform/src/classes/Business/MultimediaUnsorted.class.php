<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-06-14 08:57:03                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class MultimediaUnsorted extends AutoMultimediaUnsorted implements Prototyped, DAOConnected
	{
		/**
		 * @return MultimediaUnsorted
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return MultimediaUnsortedDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('MultimediaUnsortedDAO');
		}
		
		/**
		 * @return ProtoMultimediaUnsorted
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoMultimediaUnsorted');
		}
		
		// your brilliant stuff goes here
	}
?>