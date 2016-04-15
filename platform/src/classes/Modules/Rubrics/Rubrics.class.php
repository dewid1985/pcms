<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 29.12.14
 * Time: 17:39
 */
class Rubrics extends BaseModule
{
    /**
     * @return Article
     */
    public static function me()
    {
        return Singleton::getInstance(__CLASS__);
    }

}



