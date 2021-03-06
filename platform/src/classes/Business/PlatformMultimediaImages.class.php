<?php

/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-03-16 08:51:34                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/
class PlatformMultimediaImages extends AutoPlatformMultimediaImages implements Prototyped, DAOConnected
{
    /**
     * @return PlatformMultimediaImages
     **/
    public static function create()
    {
        return new self;
    }

    /**
     * @return PlatformMultimediaImagesDAO
     **/
    public static function dao()
    {
        return Singleton::getInstance('PlatformMultimediaImagesDAO');
    }

    /**
     * @return ProtoPlatformMultimediaImages
     **/
    public static function proto()
    {
        return Singleton::getInstance('ProtoPlatformMultimediaImages');
    }

    /**
     * return arrays object PlatformMultimediaCroppedImages
     *
     * @return array
     */
    public function getPreview()
    {
        return PlatformMultimediaCroppedImages::dao()->getByImages($this);
    }

    public function getSourceFile()
    {
        /**PlatformImagesTypeEnum**/
        return
            $this->getUploadedAt()->toFormatString('Y-m-d/His') . DIRECTORY_SEPARATOR .
            PlatformImagesTypeEnum::source()->getName() . '_' . $this->getUploadedAt()->toFormatString('His') . '.' .
            $this->getTypeFileByMimeType();
    }

    public function getPreparedFile()
    {
        /**PlatformImagesTypeEnum**/
        return
            $this->getUploadedAt()->toFormatString('Y-m-d/His') . DIRECTORY_SEPARATOR.
            PlatformImagesTypeEnum::prepared()->getName() . '_' . $this->getUploadedAt()->toFormatString('His') . '.' .
            $this->getTypeFileByMimeType();
    }

    public function getRootDirectory()
    {
        return $this->getUploadedAt()->toFormatString('Y-m-d/His') . DIRECTORY_SEPARATOR;
    }

    public function getIcoFile()
    {
        /**PlatformImagesTypeEnum**/


        return
            $this->getUploadedAt()->toFormatString('Y-m-d/His') . DIRECTORY_SEPARATOR .
            PlatformImagesTypeEnum::ico()->getName() . '_' . $this->getUploadedAt()->toFormatString('His') . '.' .
            $this->getTypeFileByMimeType();
    }

    public function getFilePath()
    {
        return $this->getUploadedAt()->toFormatString('Y-m-d/His');
    }

    private function getTypeFileByMimeType()
    {
        switch ($this->getMimeType()) {
            case 'image/jpeg':
                return 'jpeg';
                break;
            case 'image/gif':
                return 'gif';
                break;
            case 'image/png':
                return 'png';
                break;
        }
    }
    // your brilliant stuff goes here
}

?>