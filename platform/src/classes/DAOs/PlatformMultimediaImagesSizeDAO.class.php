<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-03-20 11:37:42                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformMultimediaImagesSizeDAO extends AutoPlatformMultimediaImagesSizeDAO
	{
		/**
		 * Получить статью по айди
		 *
		 * @param $id
		 * @param int $expires
		 * @return  PlatformMultimediaImagesSize
		 */
		public function getById($id, $expires = Cache::EXPIRES_MEDIUM)
		{
			return parent::getById($id, $expires);
		}

		/**
		 * Сиквенц
		 *
		 * @return string
		 */
		public function getSequence()
		{
			return parent::getSequence() . '_seq';
		}

		public function getAllImagesSizes()
		{
			return Criteria::create($this)
				->getCustomList();
		}

	}
?>