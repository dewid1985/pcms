<?php
/**
 * Базовый Модуль
 *
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 14:46
 */
class BaseModule extends Singleton implements IModule
{
    public $request = NULL;

    public $response = NULL;

    /**
     * @param null $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param null $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @return null
     */
    public function getResponse()
    {
        return $this->response;
    }


    /**
     * @return BaseModule
     */
    public static function me()
    {
        return Singleton::getInstance(__CLASS__);
    }

}