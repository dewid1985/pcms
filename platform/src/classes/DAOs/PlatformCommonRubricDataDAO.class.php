<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-01-15 10:16:42                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformCommonRubricDataDAO extends AutoPlatformCommonRubricDataDAO
	{
        public function getSequence()
        {
            return parent::getSequence() . '_seq';
        }

        /**
         * @param $id
         * @param int $expires
         * @return  PlatformCommonRubricData
         */
        public function getById($id, $expires = Cache::EXPIRES_MEDIUM)
        {
            return parent::getById($id, $expires);
        }
	}
?>