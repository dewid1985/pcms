<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-22 08:28:40                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PlatformUsersWhiteIpListDAO extends AutoPlatformUsersWhiteIpListDAO
	{
        public function getSequence()
        {
            return parent::getSequence() . '_seq';
        }

        /**
         * @param $ip
         * @param bool $active
         * @return PlatformUsersBlackIpList
         */
        public function getByIpAndActive($ip, $active = true)
        {
            return Criteria::create($this)
                ->setSilent(false)
                ->add(
                    Expression::eq(
                        DBField::create('ip_address'),
                        DBValue::create($ip)
                    )
                )
                ->add(
                    Expression::eq(
                        DBField::create('active'),
                        DBValue::create($active)
                    )
                )
                ->get();
        }

        /**
         * @param $ip
         * @return PlatformUsersBlackIpList
         */
        public function getByIp($ip)
        {
            return Criteria::create($this)
                ->setSilent(false)
                ->add(
                    Expression::eq(
                        DBField::create('ip_address'),
                        DBValue::create($ip)
                    )
                )
                ->get();
        }
	}
?>