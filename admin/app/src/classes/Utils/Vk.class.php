<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.15
 * Time: 16:35
 */
class Vk
{

    public $accessToken;

    public $url = "https://api.vk.com/method/";

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param $accessToken
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * Vk constructor.
     * @param $accessToken
     */
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getUrl()
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


    final public function method($method, array $params = null)
    {

        $request = "";
        if ($params && is_array($params)) {
            foreach ($params as $key => $param) {
                $request .= ($request == "" ? "" : "&") . $key . "=" . $param;
            }
        }


        $curl = curl_init(
            (new GenericUri())
                ->parse($this->url . $method . "?" . ($request ? $request . "&" : "") . "access_token=" . $this->accessToken, true)
                ->normalize()
                ->toString()
        );

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);


        curl_close($curl);


        if ($response) {
            return json_decode($response);
        }

        return false;
    }

    public function getServer($method, array $params = null)
    {
        $request = "";
        if ($params && is_array($params)) {
            foreach ($params as $key => $param) {
                $request .= ($request == "" ? "" : "&") . $key . "=" . $param;
            }
        }


        $curl = curl_init(
            (new GenericUri())
                ->parse($this->url . $method . "?" . ($request ? $request . "&" : "") . "access_token=" . $this->accessToken, true)
                ->normalize()
                ->toString()
        );


        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);


        curl_close($curl);


        if ($response) {
            return json_decode($response);
        }

        return false;
    }

    public function uploadFile(array $photo)
    {
        //$img_src = getcwd().'/images/upload/2015-04-08/134405/prepared_134405.jpeg';

        // file_put_contents($name, file_get_contents(getcwd() . '/images/upload/2015-04-08/134405/prepared_134405.jpeg'));

        $file = '/srv/admin/admin/web/images/captcha/20150311174915.png';
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file);
        $curlFile = (function_exists('curl_file_create') ? curl_file_create($file, $mime, '20150311174915.png') : '@' . realpath($file)); //Имя

        //$file = '1.jpg'; //наш файл
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $this->getUrl(),
            CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'),
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array(
                'photo' => $curlFile, //допустим что в форме для выбора файла name=file. Также можно указать дополнительно тип('@'.$file.';type=image/jpeg'
            ),
            CURLOPT_POST => false
        ));
        $response = curl_exec($ch);

        $ch = curl_init();

        if ($response)
            return json_decode($response);


        return $response;
    }

}
