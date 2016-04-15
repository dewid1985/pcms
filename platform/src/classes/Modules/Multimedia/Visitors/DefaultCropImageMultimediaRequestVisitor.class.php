<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 24.03.15
 * Time: 11:24
 */
class DefaultCropImageMultimediaRequestVisitor extends MultimediaVisitor implements IModuleVisitor
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleMultimediaCropImageOperationRequest
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


        $time = TimestampTZ::makeNow();

            \Helpers\Uploader\UpProvider::create()->getFile(
                PlatformFile::create()
                    ->setFileNameAndPath($this->getRequest()->getImages()->getPreparedFile())
                    ->setUploadingPath($this->getRequest()->getImages()->getRootDirectory())
                    ->setFile($this->getRequest()->getImages()->getPreparedFile())
            );


            $image
                ->setCoordinateX($this->getRequest()->getCoordinateX())
                ->setCoordinateY($this->getRequest()->getCoordinateY())
                ->setCompressedToHeight($this->getRequest()->getImagesSize()->getHeight())
                ->setCompressedToWidth($this->getRequest()->getImagesSize()->getWidth())
                ->setHeight($this->getRequest()->getHeight())
                ->setWith($this->getRequest()->getWidth())
                ->setSourceFile($this->getRequest()->getImages()->getPreparedFile())
                ->setMimeType($this->getRequest()->getImages()->getMimeType())
                ->setPath($this->getRequest()->getImages()->getRootDirectory())
                ->setFileName($time->toFormatString('YmdHis'));


            PlatformImageProcessor::create()->resizeAndCropImage($image);

        $this->getRequest()
            ->setPath($image->getCroppedFile())
            ->setCroppedAt($time)
        ;

    }
}