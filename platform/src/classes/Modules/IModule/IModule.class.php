<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 10:11
 */
interface IModule
{
    public function setResponse($response);
    public function getResponse();
    public function setRequest($request);
    public function getRequest();
    public static function me();
}