<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-08 12:16:28                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformUsersAuthCommonDAO extends AutoPlatformUsersAuthCommonDAO
	{

        /**
         * Получить по $id
         *
         * @param $id
         * @param int $expires
         * @return PlatformUsersAuthCommon
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

        /**
         * Получить инфо пользователя по id
         *
         * @param $id
         * @return PlatformUsersAuthCommon
         */
        public function getByUserInfoId($id)
        {
            return Criteria::create($this)
                ->setSilent(FALSE)
                ->add(
                    Expression::eq(
                        DBField::create('user_info_id'),
                        DBValue::create($id)
                    )
                )
                ->get();
        }
	}
?>