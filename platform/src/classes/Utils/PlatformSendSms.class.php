<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 22.12.14
 * Time: 17:44
 */
class PlatformSendSms
{
    protected $senderName = '74996414169';
    protected $telNumber = 0;

    protected $host = NULL;
    protected $port = NULL;
    protected $path = NULL;
    protected $login = NULL;
    protected $password = NULL;

    protected $phone = NULL;
    protected $message = '';

    /**
     * @param $host
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return null
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param $login
     * @return $this
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return null
     */
    public function getLogin()
    {
        return $this->login;
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
     * @return null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return null
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = preg_replace('/[^\d]/', '', $phone);
        return $this;
    }

    /**
     * @return null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param $port
     * @return $this
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return null
     */
    public function getPort()
    {
        return $this->port;
    }


    /**
     * @return PlatformSendSms
     */
    public static function create()
    {
        return new static();
    }


    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getTelNumber()
    {
        return $this->telNumber;
    }

    public function getSenderName()
    {
        return $this->senderName;
    }

    public function send()
    {
        $xml = $this->buildXml();

        $requestString = "POST " . $this->getPath() . " HTTP/1.1
Host: " . $this->getHost() . "
Accept: */*
Content-Type:text/plain;charset=UTF-8
Cache-Control:no-cache
Content-Length: " . (strlen($xml)) . "
Connection: Close\r\n\r\n" . $xml;

        try {
            $socket = @fsockopen($this->getHost(), $this->getPort(), $errno, $errstr, 60);
            PlatformAssert::isResource($socket, 'no resource');

            fwrite($socket, $requestString);
            $message = '';

            while (!feof($socket)) {
                $message .= fgets($socket, 4096);
            }

            fclose($socket);

            PlatformAssert::isStripos('error', $message);

            return TRUE;

        } catch (WrongArgumentException $e) {
            throw new PlatformSendSmsException(
                $e->getMessage()
            );
        }
    }

    protected function buildXml()
    {
        $xml =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <package login=\"" . $this->getLogin() . "\" password=\"" . $this->getPassword() . "\">
                <message>
                    <default sender=\"" . $this->getSenderName() . "\" />
                    <msg id=\"" . time() . "\" recipient=\"" . $this->getPhone() . "\" sender=\"" .
            $this->getSenderName() . "\" date_beg=\"" . date("Y-m-d") . "T" . date("H:i") .
            "\" type=\"0\">{$this->getMessage()}</msg>
                </message>
            </package>";

        return $xml;
    }
}

?>
