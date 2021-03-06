<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-09 11:45:16                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformUsersRoleDAO extends AutoPlatformUsersRoleDAO
	{
        /**
         * @param $id
         * @param int $expires
         * @return  PlatformUsersRole
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
         * @param $name
         * @return PlatformUsersRole
         */
        public function getByName($name)
        {
            return Criteria::create($this)
                ->setSilent(FALSE)
                ->add(
                    Expression::eq(
                        DBField::create('name'),
                        DBValue::create($name)
                    )
                )
                ->get();
        }

    }
?>