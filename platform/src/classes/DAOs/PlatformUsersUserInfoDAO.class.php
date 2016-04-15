<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-08 10:10:45                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformUsersUserInfoDAO extends AutoPlatformUsersUserInfoDAO
	{
        /**
         * @param $id
         * @param int $expires
         * @return PlatformUsersUserInfo
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
         * @param $id
         * @return PlatformUsersUserInfo
         */
        public function getByUserId($id)
        {
            return Criteria::create($this)
                ->setSilent(FALSE)
                ->add(
                    Expression::eq(
                        DBField::create('user_id'),
                        DBValue::create($id)
                    )
                )
                ->get();
        }
	}
?>