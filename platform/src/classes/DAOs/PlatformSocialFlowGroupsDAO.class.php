<?php

/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-27 11:18:06                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/
class PlatformSocialFlowGroupsDAO extends AutoPlatformSocialFlowGroupsDAO
{
    // your brilliant stuff goes here
    public function getSequence()
    {
        return parent::getSequence() . '_seq'; // TODO: Change the autogenerated stub
    }

    public function getByFlow(PlatformSocialFlow $flow)
    {
        return (new Criteria($this))
            ->setSilent(true)
            ->add(Expression::eq('flow', $flow))
            ->getList();
    }
}

?>