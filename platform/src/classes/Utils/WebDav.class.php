<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 03.04.15
 * Time: 15:39
 */
class WebDav extends PlatformBase
{
    private $user;

    private $password;

    private $host;

    private $curl;

    /** @var array */
    private $options = array();

    private $url;

    /**
     * @return mixed
     */
    private function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }


    /**
     * @return mixed
     */
    protected function getUser()
    {
        return $this->user;
    }


    /**
     * @return array
     */
    protected function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
        return $this;
    }


    /**
     * @param $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function getCurl()
    {
        return $this->curl;
    }

    /**
     * @param mixed $curl
     */
    protected function setCurl($curl)
    {
        $this->curl = $curl;
    }

    /**
     * @return mixed
     */
    protected function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function getHost()
    {
        return $this->host;
    }

    /**
     * @param $host
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    public function init($auth = false)
    {
        $this->setCurl(curl_init());

        if ($auth)
            $this->auth();

        $this->setOption(CURLOPT_URL, $this->getUrl());

        curl_setopt_array($this->getCurl(), $this->getOptions());

        $data = curl_exec($this->getCurl());

        if (!$data) {
            throw new BaseException (curl_error($this->getCurl()));
        };

        curl_close($this->getCurl());

        $this->setCurl(null);

        return $data;
    }

    public function getInfo()
    {
        return curl_getinfo($this->getCurl());
    }

    protected function auth()
    {
        $this
            ->setOption(CURLOPT_HTTPAUTH, CURLAUTH_BASIC)
            ->setOption(CURLOPT_USERPWD, $this->getUser() . ':' . $this->getPassword());
    }


}