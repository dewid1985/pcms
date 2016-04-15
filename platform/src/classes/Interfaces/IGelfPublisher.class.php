<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.01.15
 * Time: 16:21
 */
interface IGelfPublisher
{
    /**
     * @param IGelfMessage $message
     * @return boolean
     */
    public function send(IGelfMessage $message);
}