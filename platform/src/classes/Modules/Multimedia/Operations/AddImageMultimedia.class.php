<?php

/**
 * Сохранение черновика
 *
 * Created by PhpStorm.
 * User: root
 * Date: 09.02.15
 * Time: 11:32
 */
class AddImageMultimedia extends MultimediaOperation implements IModuleOperation
{
    /**
     * __construct
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleMultimediaAddImageOperationRequest
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
        $this->getRequest()
            ->setId(
                PlatformMultimediaImages::dao()
                    ->add(
                        PlatformMultimediaImages::create()
                            ->setName($this->getRequest()->getName())
                            ->setTitle($this->getRequest()->getTitle())
                            ->setDescription($this->getRequest()->getDescription())
                            ->setTags($this->getRequest()->getTags())
                            ->setSourceFile($this->getRequest()->getSourceFile())
                            ->setPreparedFile($this->getRequest()->getPreparedFile())
                            ->setIcoFile($this->getRequest()->getIcoFile())
                            ->setUploadedAt($this->getRequest()->getUploadedAt())
                            ->setRootDirectory($this->getRequest()->getRootDirectory())
                            ->setMimeType($this->getRequest()->getMimeType())
                    )
                    ->getId()
            );

        $this->getModuleObject()->setResponse(
            ModuleMultimediaAddImageOperationResponse::create()
                ->setIcoPath(
                    Helpers\Uploader\UpProvider::create()->getMultimediaHost() .
                    $this->getRequest()->getIcoFile()
                )
        );
    }
}