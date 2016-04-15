<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 31.12.14
 * Time: 13:07
 */
class DefaultAddImageMultimediaResponseVisitor extends MultimediaVisitor implements IModuleVisitor
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
        $image = PlatformMultimediaImages::dao()
            ->getById($this->getRequest()->getId());

            \Helpers\Uploader\UpProvider::create()
                ->uploadFile(
                    PlatformFile::create()
                        ->setFileNameAndPath($image->getSourceFile())
                        ->setUploadingPath($image->getFilePath())
                        ->setFile($image->getSourceFile())
                );

            \Helpers\Uploader\UpProvider::create()->uploadFile(
                PlatformFile::create()
                    ->setFileNameAndPath($image->getPreparedFile())
                    ->setUploadingPath($image->getFilePath())
                    ->setFile($image->getPreparedFile())
            );

            \Helpers\Uploader\UpProvider::create()->uploadFile(
                PlatformFile::create()
                    ->setFileNameAndPath($image->getIcoFile())
                    ->setUploadingPath($image->getFilePath())
                    ->setFile($image->getIcoFile())
            );
    }
}