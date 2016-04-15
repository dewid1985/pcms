<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 10.03.15
 * Time: 18:30
 */
class PlatformImageProcessor extends PlatformBaseProcessor
{
    /** @var null */
    public $fileMimeType = null;

    /** @var null */
    private $width = null;

    /** @var null */
    private $height = null;

    /** @var null */
    private $percent = null;

    /**
     * @return null
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param null $percent
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
    }

    /**
     * @return null
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param null $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return null
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param null $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }


    /**
     * @param $imageUploadPath
     * @return $this
     */
    public function setImageUploadPath($imageUploadPath)
    {
        $this->imageUploadPath = $imageUploadPath;
        return $this;
    }

    /**
     * @param PlatformImage $image
     * @return PlatformImage
     */
    public function upload(PlatformImage $image)
    {

        \Helpers\Uploader\UpProvider::create()->uploadTmp(
            PlatformFile::create()
                ->setFile($image->getImage())
                ->setFileNameAndPath($image->getFile())
                ->setUploadingPath($image->getPath())
        );

        return $image;
    }

    /**
     * @param PlatformImage $image
     */
    public function resizeImage(PlatformImage $image)
    {
        $source = $this->prepareImage($image);

        $thumb = imagecreatetruecolor($this->getWidth() * $this->getPercent(), $this->getHeight() * $this->getPercent());

        switch ($image->getMimeType()) {
            case 'image/png':
                imagealphablending($thumb, false);
                imagesavealpha($thumb, true);
                break;
        }

        imagecopyresized($thumb, $source, 0, 0, 0, 0,
            $this->getWidth() * $this->getPercent(),
            $this->getHeight() * $this->getPercent(),
            $this->getWidth(),
            $this->getHeight()
        );

        switch ($image->getMimeType()) {
            case 'image/jpeg':
                imagejpeg($thumb, Helpers\Uploader\UpProvider::create()->getTmpStore()->getPath() . $image->getFile());
                break;
            case 'image/gif':
                imagegif($thumb, Helpers\Uploader\UpProvider::create()->getTmpStore()->getPath() . $image->getFile());
                break;
            case 'image/png':
                imagepng($thumb, Helpers\Uploader\UpProvider::create()->getTmpStore()->getPath() . $image->getFile());
                break;
        }
    }

    /**
     * @param PlatformImage $image
     * @return resource
     */
    private function prepareImage(PlatformImage $image)
    {
        list($width, $height) = getimagesize(
            \Helpers\Uploader\UpProvider::create()->getTmpStore()->getPath() . $image->getSourceFile()
        );
        $this->setHeight($height);
        $this->setWidth($width);

        $aspectRatio = round($this->getWidth() / $this->getHeight(), 2);

        if ($aspectRatio < 1.33)
            $this->setPercent($image->getCompressedToWidth() / $this->getWidth(), 2);
        else
            $this->setPercent($image->getCompressedToHeight() / $this->getHeight(), 2);

        switch ($image->getMimeType()) {
            case 'image/jpeg':
                return imagecreatefromjpeg(
                    Helpers\Uploader\UpProvider::create()->getTmpStore()->getPath() . $image->getSourceFile()
                );
            case 'image/gif':
                return imagecreatefromgif(
                    Helpers\Uploader\UpProvider::create()->getTmpStore()->getPath() . $image->getSourceFile()
                );
            case 'image/png':
                return imagecreatefrompng(
                    Helpers\Uploader\UpProvider::create()->getTmpStore()->getPath() . $image->getSourceFile()
                );
        }
    }

    /**
     * @param PlatformImage $image
     * @return bool
     */
    public function resizeAndCropImage(PlatformImage $image)
    {

        $source = $this->prepareImageResizeAndCrop($image);
        $thumb = imagecreatetruecolor((integer)$image->getCompressedToWidth(), (integer)$image->getCompressedToHeight());

        imagecopyresampled(
            $thumb,
            $source,
            0,
            0,
            $image->getCoordinateX(),
            $image->getCoordinateY(),
            (integer)$image->getCompressedToWidth(),
            (integer)$image->getCompressedToHeight(),
            $image->getWidth(),
            $image->getHeight()
        );

        switch ($image->getMimeType()) {
            case 'image/jpeg':
                return imagejpeg($thumb, \Helpers\Uploader\TmpStore::create()->getPath() . $image->getCroppedFile());
            case 'image/gif':
                return imagegif($thumb, \Helpers\Uploader\TmpStore::create()->getPath() . $image->getCroppedFile());
            case 'image/png':
                return imagepng($thumb, \Helpers\Uploader\TmpStore::create()->getPath() . $image->getCroppedFile());
        }
    }


    /**
     * @param PlatformImage $image
     * @return resource
     */
    private function prepareImageResizeAndCrop(PlatformImage $image)
    {
        switch ($image->getMimeType()) {
            case 'image/jpeg':
                return imagecreatefromjpeg(\Helpers\Uploader\TmpStore::create()->getPath() . $image->getSourceFile());
            case 'image/gif':
                return imagecreatefromgif(\Helpers\Uploader\TmpStore::create()->getPath() . $image->getSourceFile());
            case 'image/png':
                return imagecreatefrompng(\Helpers\Uploader\TmpStore::create()->getPath() . $image->getSourceFile());
        }
    }

}