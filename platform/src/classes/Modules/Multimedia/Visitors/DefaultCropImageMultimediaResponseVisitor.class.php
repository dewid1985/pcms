<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 24.03.15
 * Time: 11:25
 */
class DefaultCropImageMultimediaResponseVisitor extends MultimediaVisitor implements IModuleVisitor
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
        \Helpers\Uploader\UpProvider::create()
            ->uploadFile(
                PlatformFile::create()
                    ->setFileNameAndPath(
                        $this->getRequest()->getPath()
                    )
                    ->setUploadingPath(
                        PlatformMultimediaImages::dao()
                            ->getById($this->getRequest()->getImagesId())
                            ->getRootDirectory()
                    )
                    ->setFile(
                        $this->getRequest()->getPath()
                    )
            );
    }
}