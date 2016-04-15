<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.12.14
 * Time: 11:53
 */
class PlatformCaptcha extends PlatformBase
{
    private $captchaPath;

    private $fontPath;

    private $font;

    private $width;

    private $height;

    private $img;

    private $urlDirectory;

    /**
     * Иницилизирую каптчу
     *
     * @param PlatformConfig $config
     * @return $this
     */
    public function init(PlatformConfig $config)
    {
        $config = $config->getItemConfig('captcha');
        $this->captchaPath = $config->getItem('captcha_path');
        $this->fontPath = $config->getItem('font_path');
        $this->font = $config->getItem('font');
        $this->width = $config->getItem('width');
        $this->height = $config->getItem('height');
        $this->urlDirectory = $config->getItem('captcha_url_image_directory');

        return $this;
    }

    /**
     * Открытие каптчи
     */
    private function __creationCaptcha()
    {
        $this->img = imagecreatetruecolor($this->width, $this->height);
    }


    /**
     * Генерирую каптчу
     *
     * @param $str
     * @return string
     */
    public function generateСaptcha($str)
    {
        $this->__creationCaptcha();
        imagesavealpha($this->img, TRUE);
        $color_text = imagecolorallocate($this->img, 47, 79, 79);
        $background = imagecolorallocate($this->img, 255, 255, 255);
        imagefilledrectangle($this->img, 0, 0, $this->width, $this->height, $background);
        $font = $this->fontPath . $this->font;
        imagettftext($this->img, 22, 0, 10, 26, $color_text, $font, $str);
        $image_name = date('YmdGis');
        imagepng($this->img, $this->captchaPath . "/" . $image_name . ".png");
        $this->_destroy();
        return "<img src= '" . $this->urlDirectory . "/" . $image_name . ".png" . "' class='img-thumbnail'>";
    }

    private function _destroy()
    {
        imagedestroy($this->img);
    }
}