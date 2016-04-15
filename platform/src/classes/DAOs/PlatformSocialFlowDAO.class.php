<?php

/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-27 11:18:06                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/
class PlatformSocialFlowDAO extends AutoPlatformSocialFlowDAO
{
    // your brilliant stuff goes here

    public function getSequence()
    {
        return parent::getSequence() . '_seq'; // TODO: Change the autogenerated stub
    }

    /**
     * @param $id
     * @param int $expires
     * @return PlatformSocialFlow
     */
    public function getById($id, $expires = Cache::EXPIRES_MEDIUM)
    {
        return parent::getById($id, $expires); // TODO: Change the autogenerated stub
    }

    public function listFlows($start, $limit)
    {
        $criteria = (new Criteria($this))->setSilent(true);

        $criteria
            ->addProjection(new PropertyProjection(new PlatformDialectString('count(*) OVER ()')))
            ->addProjection(new PropertyProjection('id'))
            ->addProjection(new PropertyProjection('name'))
            ->addOrder((new OrderBy('id'))->desc())
            ->add(Expression::isFalse('deleted'))
            ->setOffset($start)
            ->setLimit($limit)
        ;

        return $criteria
            ->getCustomList();
    }

    /**
     * @param $code
     * @return PlatformSocialFlow
     * @throws ObjectNotFoundException
     */
    public function getBySecretCode($code)
    {
        return (new Criteria($this))
            ->setSilent(false)
            ->add(Expression::eq('secretKey', $code))
            ->get();
    }
}

?>