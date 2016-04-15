<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.01.15
 * Time: 18:14
 */
class GraylogMessage extends GELFMessage implements IGelfMessage
{
    /**
     * @return GELFMessage
     */
    public static function create()
    {
        return new static();
    }
}