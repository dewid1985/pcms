<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.03.15
 * Time: 11:59
 */
class PlatformImage extends PlatformBase
{
    protected $width;

    protected $height;

    protected $coordinateX;

    protected $coordinateY;

    protected $image;

    protected $compressedToWidth = 800;

    protected $compressedToHeight = 600;

    protected $path;

    protected $fileName;

    protected $prefix = null;

    protected $sourceFile;

    protected $mimeType;

    protected $fileType;

    /**
     * @return string
     */
    public function getPrefix()
    {
        if (is_null($this->prefix)) {
            $this->prefix = PlatformImagesTypeEnum::source()->getName();
            $this->setSourceFile(
                $this->getPath() . DIRECTORY_SEPARATOR . PlatformImagesTypeEnum::source()->getName() . '_' .
                $this->getFileName() . '.' . $this->getFileType()
            );
        }
        return $this->prefix;
    }

    /**
     * @return mixed
     */
    public function getCoordinateX()
    {
        return $this->coordinateX;
    }

    /**
     * @param $coordinateX
     * @return $this
     */
    public function setCoordinateX($coordinateX)
    {
        $this->coordinateX = $coordinateX;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoordinateY()
    {
        return $this->coordinateY;
    }

    /**
     * @param $coordinateY
     * @return $this
     */
    public function setCoordinateY($coordinateY)
    {
        $this->coordinateY = $coordinateY;
        return $this;
    }


    /**
     * @param $prefix
     * @return $this
     */
    public function setPrefix(PlatformImagesTypeEnum $prefix)
    {
        $this->prefix = $prefix->getName();
        return $this;
    }


    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param $width
     * @return $this
     */
    public function setWith($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
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
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param $fileName
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @return int
     */
    public function getCompressedToWidth()
    {
        return $this->compressedToWidth;
    }

    /**
     * @param $compressedToWidth
     * @return $this
     */
    public function setCompressedToWidth($compressedToWidth)
    {
        $this->compressedToWidth = $compressedToWidth;
        return $this;
    }

    /**
     * @return int
     */
    public function getCompressedToHeight()
    {
        return $this->compressedToHeight;
    }

    /**
     * @param $compressedToHeight
     * @return $this
     */
    public function setCompressedToHeight($compressedToHeight)
    {
        $this->compressedToHeight = $compressedToHeight;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSourceFile()
    {
        return $this->sourceFile;
    }

    /**
     * @param $sourceFile
     * @return $this
     */
    public function setSourceFile($sourceFile)
    {
        $this->sourceFile = $sourceFile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param $mimeType
     * @return $this
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFileType()
    {
        return $this->fileType;
    }

    /**
     * @param $fileType
     * @return $this
     */
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getFile()
    {
        $this->preparedFileType();
        return $this->getPath() . DIRECTORY_SEPARATOR . $this->getPrefix() . '_' . $this->getFileName() . '.' . $this->getFileType();
    }


    private function preparedFileType()
    {
        $type = ['image/jpeg' => 'jpeg', 'image/gif' => 'gif', 'image/png' => 'png'];

        $this->setFileType($type[$this->getMimeType()]);
    }

    public function getCroppedFile()
    {
        $this->preparedFileType();
        return $this->getPath() . $this->getFileName() . '.' . $this->getFileType();
    }

}