<?php

/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-13 11:44:57                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/
class PlatformSocialAppDAO extends AutoPlatformSocialAppDAO
{
    // your brilliant stuff goes here
    public function getSequence()
    {
        return parent::getSequence() . '_seq';
    }

    /**
     * @param $id
     * @param int $expires
     * @return PlatformSocialApp
     */
    public function getById($id, $expires = Cache::EXPIRES_MEDIUM)
    {
        return parent::getById($id, $expires); // TODO: Change the autogenerated stub
    }

    /**
     * @param $start
     * @param $limit
     * @return array
     * @throws ObjectNotFoundException
     */
    public function listApps($start, $limit)
    {
        $criteria = (new Criteria($this))->setSilent(true);

        $criteria
            ->addProjection(new PropertyProjection(new PlatformDialectString('count(*) OVER ()')))
            ->addProjection(new PropertyProjection('id'))
            ->addProjection(new PropertyProjection('appId'))
            ->addProjection(new PropertyProjection('name'))
            ->addProjection(new PropertyProjection('socialNetwork'))
            ->addOrder((new OrderBy('id'))->desc())
            ->setOffset($start)
            ->setLimit($limit)
        ;

        return $criteria
            ->getCustomList();
    }

    /**
     * @return PlatformSocialApp[]
     * @throws ObjectNotFoundException
     */
    public function getList()
    {
        return (new Criteria($this))->getList();
    }
}

?>