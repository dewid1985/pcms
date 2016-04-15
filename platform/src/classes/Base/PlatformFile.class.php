<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 03.04.15
 * Time: 18:28
 */
class PlatformFile extends PlatformBase
{
    private $file;

    /** @var  resource */
    private $openFile;

    private $mimeType;

    private $size;

    private $uploadingPath;

    private $fileName;

    private $fileSize = null;

    /**
     * @return mixed
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @param mixed $fileSize
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
    }


    /**
     * @return mixed
     */
    public function getUploadingPath()
    {
        return $this->uploadingPath;
    }

    /**
     * @return resource
     */
    public function getOpenFile()
    {
        return $this->openFile;
    }

    /**
     * @param resource $openFile
     */
    public function setOpenFile($openFile)
    {
        $this->openFile = $openFile;
    }


    /**
     * @param $uploadingPath
     * @return $this
     */
    public function setUploadingPath($uploadingPath)
    {
        $this->uploadingPath = $uploadingPath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @deprecated
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @deprecated
     * @param $fileName
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }


    /**
     * @param $file
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;
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
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    public function fileOpenTmp()
    {
        $this->setOpenFile(
            fopen(
                \Helpers\Uploader\UpProvider::create()->getTmpStore()->getPath() . $this->getFileName(), 'r'
            )
        );

        $this->setFileSize(
            filesize(
                \Helpers\Uploader\UpProvider::create()->getTmpStore()->getPath() . $this->getFileName())

        );
        return $this;
    }

    public function fileCloseTmp()
    {
        fclose(
            $this->getOpenFile()
        );

        $this->setOpenFile(null);
    }

    public function setFileNameAndPath($fileNameAndPath)
    {
        return $this->setFileName($fileNameAndPath);
    }

    public function getFileNameAndPath()
    {
        return $this->getFileName();
    }
}
