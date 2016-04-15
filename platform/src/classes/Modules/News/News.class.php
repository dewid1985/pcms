<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 29.12.14
 * Time: 17:39
 */
class News extends BaseModule
{
    /**
     * @return News
     */
    public static function me()
    {
        return Singleton::getInstance(__CLASS__);
    }

    /**
     * @return
     */
    public function getResponse()
    {
        return parent::getResponse();
    }

}



