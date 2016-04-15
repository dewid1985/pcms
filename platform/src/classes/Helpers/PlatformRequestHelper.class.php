<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12.12.14
 * Time: 11:35
 */
class PlatformRequestHelper
{
    /**
     * @var PlatformRequestHelper
     */
    private static $instance = NULL;

    /**
     * @var HttpRequest
     */
    private  $httpRequest;

    /**
     * @var PlatformLogsAdminAuthLogsRequest
     */
    private static $adminAuthLogsRequest = NULL;

    function __construct()
    {
        $this->setAdminAuthLogsRequest(PlatformLogsAdminAuthLogsRequest::create());
    }


    /**
     * @return PlatformRequestHelper
     */
    public static function me()
    {
        if (!static::$instance)
            static::$instance = new static();

        return static::$instance;
    }

    /**
     * @param \HttpRequest $httpRequest
     */
    public function setHttpRequest(HttpRequest $httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }

    /**
     * @return \HttpRequest
     */
    public function getHttpRequest()
    {
        return $this->httpRequest;
    }

    /**
     * @param \PlatformLogsAdminAuthLogsRequest $adminAuthLogsRequest
     */
    public static function setAdminAuthLogsRequest(PlatformLogsAdminAuthLogsRequest $adminAuthLogsRequest)
    {
        self::$adminAuthLogsRequest = $adminAuthLogsRequest;
    }

    /**
     * @return \PlatformLogsAdminAuthLogsRequest
     */
    public function getAdminAuthLogsRequest()
    {
        return static::$adminAuthLogsRequest;
    }
}