<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.03.15
 * Time: 16:39
 */
class GetImageMultimedia extends MultimediaOperation implements IModuleOperation
{
    /**
     * __construct
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleMultimediaGetImageOperationRequest
     */
    private function getRequest()
    {
        return $this->getModuleObject()->getRequest();
    }

    /**
     * Выполнение операции
     *
     * @return mixed
     */
    public function operation()
    {
        $response = ModuleMultimediaGetImageOperationResponse::create();
        $image = PlatformMultimediaImages::dao()->getById($this->getRequest()->getId());

        $response
            ->setImagesSizes(PlatformMultimediaImagesSize::dao()->getAllImagesSizes())
            ->setId($image->getId())
            ->setName($image->getName())
            ->setTitle($image->getTitle())
            ->setDescription($image->getDescription())
            ->setTags($image->getTags())
            ->setSourceFile($image->getSourceFile())
            ->setPreparedFile($image->getPreparedFile())
            ->setIcoFile($image->getIcoFile())
            ->setUploadedAt($image->getUploadedAt())
            ->setRootDirectory($image->getRootDirectory());

        if($this->getRequest()->getSizesId()){
            $response->setImagesPreviewSizes(
                PlatformMultimediaImagesSize::dao()
                    ->getById($this->getRequest()->getSizesId())
            );
        };

        $response->setMultimediaHost(Helpers\Uploader\UpProvider::create()->getMultimediaHost());

        $this->getModuleObject()->setResponse(
            $response
        );
    }
}