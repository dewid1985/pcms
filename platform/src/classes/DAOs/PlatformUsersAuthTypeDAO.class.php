<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-08 11:57:41                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformUsersAuthTypeDAO extends AutoPlatformUsersAuthTypeDAO
	{
        /**
         * Получить по $id
         *
         * @param $id
         * @param int $expires
         * @return PlatformUsersAuthType
         */
        public function getById($id, $expires = Cache::EXPIRES_MEDIUM)
        {
            return parent::getById($id, $expires);
        }

        /**
         * @return string
         */
        public function getSequence()
        {
            return parent::getSequence() . '_seq';
        }
	}
?>