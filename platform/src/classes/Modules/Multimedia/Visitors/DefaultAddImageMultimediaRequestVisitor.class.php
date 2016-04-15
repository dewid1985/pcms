<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 31.12.14
 * Time: 12:57
 */
class DefaultAddImageMultimediaRequestVisitor extends MultimediaVisitor implements IModuleVisitor
{
    function __construct()
    {
        parent::__construct();
    }


    /**
     * @return ModuleMultimediaAddImageOperationRequest
     */
    protected function getRequest()
    {
        return $this->getModuleObject()->getRequest();
    }

    /**
     * Выполнение визитера
     *
     * @return mixed
     */
    public function visit()
    {
            $image = PlatformImage::create();

            $image
                ->setPath($this->getRequest()->getUploadedAt()->toFormatString('Y-m-d/His'))
                ->setFileName($this->getRequest()->getUploadedAt()->toFormatString('His'))
                ->setMimeType($this->getRequest()->getImages()['type'])
                ->setImage($this->getRequest()->getImages()['tmp_name']);

            $this->getRequest()->setMimeType($this->getRequest()->getImages()['type']);

            $image = PlatformImageProcessor::create()
                ->upload($image);

            $this->getRequest()->setRootDirectory($image->getPath());
            $this->getRequest()->setSourceFile($image->getFile());

            $image->setPrefix(PlatformImagesTypeEnum::prepared());
            $this->getRequest()->setPreparedFile($image->getFile());

            PlatformImageProcessor::create()->resizeImage($image);

            $image
                ->setCompressedToHeight(140)
                ->setCompressedToWidth(140)
                ->setPrefix(PlatformImagesTypeEnum::ico());

            PlatformImageProcessor::create()->resizeImage($image);
            $this->getRequest()->setIcoFile($image->getFile());
    }
}